<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $orders   = Order::all();
        //last order list
        $orderID = Order_Detail::max('order_id');
        $order_receipts = Order_Detail::where('order_id', $orderID)->get();
        return view('orders.index', [
            'products'         => $products,
            'orders'           => $orders,
            'order_receipts'   => $order_receipts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            //orders
            $orders = new Order();
            $orders->customer_name = $request->customer_name;
            $orders->customer_phone = $request->customer_phone;
            $orders->save();

            //order_details
            for ($i = 0; $i < count($request->product_id); $i++) {
                $order_details = new Order_Detail();
                $order_details->order_id = $orders->id;
                $order_details->product_id = $request->product_id[$i];
                $order_details->quantity = $request->quantity[$i];
                $order_details->unitprice = $request->price[$i];
                $order_details->amount = $request->total_amount[$i];
                $order_details->discount = $request->discount[$i];
                $order_details->save();
            }

            //transactions
            $transaction = new Transaction();
            $transaction->order_id = $orders->id;
            $transaction->paid_amount = $request->paid_amount;
            $transaction->balance = $request->balance;
            $transaction->payment_method = $request->payment_method;
            $transaction->user_id = Auth::user()->id;
            $transaction->transac_date = date('Y-m-d');
            $transaction->transac_amount = $order_details->amount;
            $transaction->save();

            //remove insert cart
            Cart::where('id', Auth::user()->id)->delete();

            //last order history
            $products = Product::all();
            $order_details = Order_Detail::where('order_id', $orders->id)->get();
            $orderedBy = Order::where('id', $orders->id)->get();

            return view('orders.index', [
                'products'      => $products,
                'order_details' => $order_details,
                'orderedBy'     => $orderedBy,
            ]);
        });

        return back()->with("success", 'Product order faield to inserted! please check input!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
