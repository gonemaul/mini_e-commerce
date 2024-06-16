<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $product = Product::latest();
        return view('home')->with([
            'title' => 'Dashboard',
            'product_count' => $product->count(),
            'product_new' => $product->limit(5)->with('category')->get(),
            'category' => Category::count(),
            'order' => Order::count(),
            'user' => User::count(),
        ]);
    }
}
