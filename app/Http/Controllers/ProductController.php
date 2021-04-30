<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Picqer;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::paginate(5);
        return view('products.index', [
            'all_data' => $data,
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
        $this->validate($request, [
            'product_name' => 'required',
            'brand'        => 'required',
            'price'        => 'required',
            'quantity'     => 'required',
            'alert_stock'  => 'required',
            'description'  => 'required',
        ]);

        //html barcode genarate
        // $product_code = rand(000000000, 999999999);
        // $redColor = [255, 0, 0];

        // $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        // $barcode = $generator->getBarcode($product_code, $generator::TYPE_STANDARD_2_5, 2, 60);

        //product image
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $unique_image = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products/images/'), $unique_image);
        }

        //image barcode genarate
        $product_code = $request->product_code;

        $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
        file_put_contents(
            'products/barcodes/' . $product_code . '.jpg',
            $generator->getBarcode(
                $product_code,
                $generator::TYPE_CODE_128,
                3,
                50
            )
        );

        Product::create([
            'product_name' => $request->product_name,
            'brand'        => $request->brand,
            'price'        => $request->price,
            'quantity'     => $request->quantity,
            'alert_stock'  => $request->alert_stock,
            'description'  => $request->description,
            'product_code' => $product_code,
            'product_image' => $unique_image,
            'barcode'      => $product_code . '.jpg',
        ]);

        return redirect()->route('product.index')->with('success', 'Data added successfully ): ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = Product::find($product->id);
        if ($data != NULL) {
            $this->validate($request, [
                'product_name' => 'required',
                'brand'        => 'required',
                'price'        => 'required',
                'quantity'     => 'required',
                'alert_stock'  => 'required',
                'description'  => 'required',
            ]);

            //html barcode genarate
            // $product_code = rand(000000000, 999999999);
            // $redColor = [255, 0, 0];

            // $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
            // $barcode = $generator->getBarcode($product_code, $generator::TYPE_STANDARD_2_5, 2, 60);

            //product image
            $unique_image = '';
            if ($request->hasFile('product_image')) {
                $image = $request->file('product_image');
                $unique_image = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('products/images/'), $unique_image);
                if (file_exists('products/images/' . $data->product_image) && !empty($data->product_image)) {
                    unlink('products/images/' . $data->product_image);
                }
            } else {
                $unique_image = $data->product_image;
            }


            $product_code = '';
            if ($request->product_code != '' && $request->product_code != $data->product_code) {
                //image barcode genarate
                $product_code = $request->product_code;

                $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
                file_put_contents(
                    'products/barcodes/' . $product_code . '.jpg',
                    $generator->getBarcode(
                        $product_code,
                        $generator::TYPE_CODE_128,
                        3,
                        50
                    )
                );
                if (file_exists('products/barcodes/' . $data->barcode) && !empty($$data->barcode)) {
                    unlink('products/barcodes/' . $data->barcode);
                }
            } else {
                $product_code = $data->product_code;
            }



            $data->product_name = $request->product_name;
            $data->brand = $request->brand;
            $data->price = $request->price;
            $data->quantity = $request->quantity;
            $data->alert_stock = $request->alert_stock;
            $data->description = $request->description;
            $data->product_code = $product_code;
            $data->product_image = $unique_image;
            $data->barcode = $product_code . '.jpg';
            $data->update();

            return redirect()->route('product.index')->with('success', 'Data added successfully ): ');
        } else {
            return redirect()->back()->with('error', 'Sorry! data not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $data = Product::find($product->id);
        if ($data != NULL) {
            $data->delete();
            return redirect()->route('products.index')->with('success', 'Data deleted successfully ): ');
        } else {
            return redirect()->back()->with('error', 'Sorry! data not found.');
        }
    }

    public function getProductBarcode()
    {
        $data = Product::all();
        return view('products.barcodes.index', [
            'all_data' => $data,
        ]);
    }
}
