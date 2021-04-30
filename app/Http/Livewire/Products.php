<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $product_details = [];

    public function mount()
    {
    }

    public function getProductDetails($product_id)
    {
        $this->product_details = Product::where('id', $product_id)->get();
    }

    public function render()
    {
        return view('livewire.products', [
            'all_data' => Product::all(),
        ]);
    }
}
