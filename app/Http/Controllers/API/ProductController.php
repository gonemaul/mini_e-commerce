<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function show_products(){
        $products = Product::latest()->with('category')->get();

        return ProductResource::collection($products);
    }

    public function show_product_details($id){
        $product = Product::find($id)->with('category')->get();

        return response()->json([
            'product' => $product
        ]);
    }
}
