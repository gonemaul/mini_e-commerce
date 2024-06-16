<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductDetailResource;
use App\Http\Resources\CategoryResourceCollection;

class ProductController extends Controller
{
    public function show_products(){
        $products = Product::latest()->with('category')->get();

        return ProductResource::collection($products);
    }

    public function show_product_details($id){
        $product = Product::where('id',$id)->with('category')->first();

        return new ProductDetailResource($product);
    }
}
