<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function categories_all(){
        $category = Category::all();

        return CategoryResource::collection($category);
    }

    public function products_by_category($category){
        $products = Product::where('category_id', $category)->get();

        return ProductResource::collection($products);
    }
}
