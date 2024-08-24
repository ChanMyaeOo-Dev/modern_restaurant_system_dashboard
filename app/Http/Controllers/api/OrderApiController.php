<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderApiResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    public function allOrders()
    {
        $orders = Order::where('is_completed', '0')->latest()->get();
        $orders = OrderApiResource::collection($orders);
        return response()->json([
            "success" => true,
            "orders" => $orders
        ]);
    }
    public function orderDone(Request $request)
    {
        $order = Order::find($request->order_id);
        // return $order;
        $order->is_completed = "1";
        $order->save();
        return response()->json([
            "success" => true,
            "order" => $order
        ]);
    }
    public function index(Request $request)
    {
        $orders = Order::where('is_completed', '0')->where('table_id', $request->table_id)->get();
        $orders = OrderApiResource::collection($orders);
        return response()->json([
            "success" => true,
            "orders" => $orders
        ]);
    }
    public function store(Request $request)
    {
        $rules = [
            'table_id' => 'required|integer|min:1',
        ];
        $request->validate($rules, [
            'table_id.required' => 'Need to choose the table.',
            'table_id.integer' => 'Need to choose the table.',
            'table_id.min' => 'Need to choose the table.',
        ]);
        $order = new Order();
        $table_id = $request->table_id;
        $all_carts = Cart::where('table_id', $table_id)->with('item')->get();
        $total = $all_carts->sum(function ($cart) {
            return $cart->item->price * $cart->quantity;
        });
        $order->table_id = $table_id;
        $order->total_price = $total;
        $order->save();
        foreach ($all_carts as $ind_cart) {
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->item_id = $ind_cart->item->id;
            $order_item->quantity = $ind_cart->quantity;
            $order_item->price = $ind_cart->item->price;
            $order_item->special_request = $ind_cart->special_request;
            $order_item->save();
        }
        //Delete all user carts
        Cart::where('table_id', $table_id)->delete();
        return response()->json([
            "success" => true,
            "order" => $order
        ]);
    }
}
