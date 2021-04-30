<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Order extends Component
{
    public $orders, $products = [], $product_code, $message = '', $productInCart;
    public $pay_money, $balance;

    public function mount()
    {
        $this->products = Product::all();
        $this->productInCart = Cart::all();
    }

    public function insertToCart()
    {
        $countProduct = Product::where('id', $this->product_code)->first();

        if (!$countProduct) {
            $this->message = "Product not found!";
        }

        $countCartProduct = Cart::where('product_id', $this->product_code)->count();

        if ($countCartProduct > 0) {
            $this->message = "Product $countProduct->product_name already exist please add another product";
        } else {

            $cart = new Cart();
            $cart->product_id = $countProduct->id;
            $cart->product_qty = 1;
            $cart->product_price = $countProduct->price;
            $cart->user_id = Auth::user()->id;
            $cart->save();

            $this->productInCart->prepend($cart);

            $this->product_code = '';
            $this->message = 'Product added successfully ):';
            // dd($countProduct);

        }
    }

    public function removeProductCart($id)
    {
        $data = Cart::find($id);
        $data->delete();

        $this->message = 'Product remove from cart!';
        $this->productInCart = $this->productInCart->except($id);
    }

    public function increment($id)
    {
        $data = Cart::find($id);
        $data->increment('product_qty', 1);
        $update_price = $data->product_qty * $data->product->price;
        $data->update(['product_price' => $update_price]);
        $this->mount();
    }

    public function decrement($id)
    {
        $data = Cart::find($id);
        if ($data->product_qty == 0) {
            return redirect()->back()->with('info', 'Product quantity not be less than 1, please increase product quantity');
        } else {
            $data->decrement('product_qty', 1);
            $update_price = $data->product_qty * $data->product->price;
            $data->update(['product_price' => $update_price]);
            $this->mount();
        }
    }

    public function render()
    {
        if ($this->pay_money != '') {
            $totalAmount = $this->pay_money - $this->productInCart->sum('product_price');
            $this->balance = $totalAmount;
        }
        return view('livewire.order');
    }
}
