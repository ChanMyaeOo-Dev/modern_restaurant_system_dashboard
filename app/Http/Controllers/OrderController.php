<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::all();
        return view('order.index', compact('orders'));
    }

    public function create()
    {
        $items = Item::all();
        $carts = Cart::all();
        // Replae With Current User Id
        $all_carts = Cart::where('user_id', "=", "1")->get();
        $cart_total = 0;
        foreach ($all_carts as $ind_cart) {
            $cart_total += $ind_cart->item->price * $ind_cart->quantity;
        }
        return view('order.create', compact('items', 'carts', 'cart_total'));
    }

    public function store(Request $request)
    {
        $order = new Order();
        // Replace Table Id From frontend
        $table_id = "1";
        // Replae With Current User Id
        $all_carts = Cart::where('user_id', 1)->with('item')->get();
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
            $order_item->save();
        }
        //Delete all user carts
        Cart::where('user_id', 1)->delete();
        return back()->with('success_message', 'New Order has been successfully saved.');
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function edit(Order $order)
    {
        return view(
            'order.edit',
            [
                'order' => (new OrderResource($order))->toArray(request())
            ]
        );
    }

    public function update(Request $request, Order $order)
    {
        $order->name = $request->name;
        $order->update();
        return back()->with('success_message', 'Order has been successfully updated.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success_message', 'Order has been successfully deleted.');
    }
}
