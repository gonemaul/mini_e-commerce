<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_to_cart(Request $request){
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        $cartItem = CartItem::where('user_id',$user->id)
                                    ->where('product_id',$product->id)
                                    ->first();

        if($cartItem){
            $cartItem->quantity += $quantity;
            $cartItem->save();
        }
        else{
            $cartItem = CartItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product add to cart successfully',
        ]);
    }

    public function update_quantity(Request $request,$productID){
        $request->validate([
            'quantity' =>'required',
        ]);
        $user = Auth::user();
        $cartItem = CartItem::where('user_id',$user->id)
                                    ->where('product_id',$productID)
                                    ->firstOrFail();

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product quantity updated successfully',
        ]);
    }

    public function remove_from_cart($productID){
        $user = Auth::user();
        $cartItem = CartItem::where('user_id',$user->id)
                                    ->where('product_id',$productID)
                                    ->firstOrFail()->delete();

        return response()->json([
           'status' =>'success',
           'message' => 'Product removed from cart successfully',
        ]);
    }
}
