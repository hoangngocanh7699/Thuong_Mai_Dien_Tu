<?php

namespace App\Http\Controllers\Search;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductSearchBar extends Controller
{

    public $product;

    public function __construct(Product $product)
    {

        $this->product = $product;
    }

    public function ProductSearch(Request $request)
    {
        $output = '';

        $products = $this->product->where('name', 'like', '%' . $request->keyword . '%')->get();

        foreach ($products as $product) {
            $output .= '
            <a href="">' . $product->name . '</a>
            ';
        }
        if (empty($output)){
            $output = '<a href="#">No result</a>';
        }
        return response()->json($output);
    }
}
