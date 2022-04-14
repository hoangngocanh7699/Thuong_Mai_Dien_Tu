<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    
    public function index()
    {
        
    }
    public function categoryid($categoryid){
        $category = Category::find($categoryid);
        $products = array();
        foreach ($category->categoryChildren as $key => $category) {
            foreach ($category->products as $key => $product) {
                array_push($products, $product);
            }
        }
        return $products;
    }

    public function detailsimg($product_id){
        $product = Product::find($product_id);
        $images = array();
        foreach($product->images as $img){
            array_push($images, $img);
        }
        return $images;
    }

   
}
