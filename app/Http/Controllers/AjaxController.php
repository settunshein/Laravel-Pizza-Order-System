<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // Return Product List
    public function getAllProducts(Request $request)
    {
        if( $request->status == 'desc' ){
            $data = Product::orderBy('created_at', 'desc')->get();
        }else{
            $data = Product::orderBy('created_at', 'asc')->get();
        }
        
        return $data;
    }

    // Return Product List
    public function addToCart(Request $request)
    {
        Cart::create([
            'user_id'    => $request['user_id'],
            'product_id' => $request['product_id'],
            'qty'        => $request['count'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $cart_count = Cart::where('user_id', $request['user_id'])->count();

        return response()->json([
            'status'     => 'success',
            'cart_count' => $cart_count,
            'message'    => 'Item Added to Cart Successfully' 
        ], 200);
    }

    // Submit Order
    public function order(Request $request)
    {
        $total_price = 0;
        foreach($request->all() as $item){
            $order_item = OrderItem::create($item);
            $total_price += $order_item->total;
        }

        Cart::where('user_id', auth()->id())->delete();

        Order::create([
            'user_id'     => auth()->id(),
            'order_code'  => $order_item->order_code,
            'total_price' => $total_price,
        ]);

        $request->session()->flash('success', 'Your Pizza Ordered Successfully ');

        return response()->json([
            'status'  => true,
            'message' => 'Order Completed'
        ], 200);
    }

    // Remove Cart
    public function removeCart(Request $request)
    {
        $cart = Cart::where([ ['user_id', Auth::id()], ['product_id', $request->product_id], ['id', $request->cart_id] ])->delete();
        
        return response()->json([
            'message' => 'SUCCESS'
        ]);
    }

    // Clear Cart
    public function clearCart()
    {
        Cart::where('user_id', Auth::id())->delete();

        return response()->json([
            'message' => 'SUCCESS'
        ]);
    }
}
