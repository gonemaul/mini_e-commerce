<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function order_list(){
        return view('orders.index')->with([
            'title' => 'Orders',
            'data' => Order::latest()->with('user')->get()
        ]);
    }

    public function order_detail($id){
        return view('orders.detail')->with([
            'title' => 'Order Detail',
            'data' => Order::with(['user','orderItems.product'])->findOrFail($id)
        ]);
    }
}
