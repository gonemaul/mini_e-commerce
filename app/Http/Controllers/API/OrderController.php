<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout_orders(){
        $user = Auth::user();

        $cartItems = CartItem::where('user_id', $user->id)->with('product');
        if($cartItems->get()->isEmpty()){
            return response()->json(['message' => 'Cart is empty'], 400);
        }
        else{
            $total = 0;
            foreach ($cartItems->get() as $cartItem) {
                $total += $cartItem->product->price * $cartItem->quantity;
            }

            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
               'status' => 'pending',
            ]);

            foreach ($cartItems->get() as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);
            }

            $cartItems->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Checkout successfully',
            ]);
        }
    }

    public function order_history(){
        $history = Order::where('user_id', auth()->user()->id)->with('orderItems.product')->get();

        foreach ($history as $item){
            foreach ($item->orderItems as $orderItem){
                $order_items[] = [
                    'product_name' => $orderItem->product->product_name,
                    'category' => $orderItem->product->category->category_name,
                    'quantity' => $orderItem->quantity,
                    'price' => $orderItem->price
                ];
            }
            $order_history[] = [
                'id' => $item->id,
                'status' => $item->status,
                'total' => $item->total,
                'order_items' => $order_items       
            ];
        }

        return response()->json([
            'status' => 'success',
            'order_history' => $order_history
        ]);
    }
}
