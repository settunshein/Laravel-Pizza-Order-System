<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Redirect Order List Page
    public function index()
    {
        $orders = Order::select('orders.*', 'users.name AS user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('orders.created_at', 'DESC')
            ->get();

        return view('admin.order.index', compact('orders'));
    }


    // Sort with AJAX
    public function getOrdersByStatus(Request $request)
    {
        $orders = Order::select('orders.*', 'users.name AS user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('orders.created_at', 'DESC');

        if( $request->status == null ){
            $orders = $orders->get();
        }else{
            $orders = $orders->where('orders.status', $request->status)->get();
        }

        return response()->json($orders);
    }


    // Change Order Status with AJAX
    public function changeOrderStatus(Request $request)
    {
        Order::where('id', $request->order_id)->update([
            'status' => $request->status
        ]);

        $orders = Order::select('orders.*', 'users.name AS user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('orders.created_at', 'DESC');
            
        if( $request->order_status == null ){
            $orders = $orders->get();
        }else{
            $orders = $orders->where('orders.status', $request->order_status)->get();
        }

        return response()->json($orders);
    }


    // Redirect Order Details Page
    public function showOrderDetailsPage($order_code)
    {
        $order       = Order::select('total_price', 'status')->where('order_code', $order_code)->first();
        $order_items = OrderItem::select('order_items.*', 'users.name AS user_name', 'users.email AS user_email', 'users.phone AS user_phone', 'users.address AS user_address', 'products.name AS product_name', 'products.image AS product_img', 'products.price AS unit_price')
            ->leftJoin('users', 'users.id', 'order_items.user_id')
            ->leftJoin('products', 'products.id', 'order_items.product_id')
            ->where('order_items.order_code', $order_code)
            ->get();
        return view('admin.order.details', compact('order_items', 'order'));
    }

}
