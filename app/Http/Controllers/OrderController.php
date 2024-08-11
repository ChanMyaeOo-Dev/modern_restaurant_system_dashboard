<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
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
        return view('order.create', compact('items', 'carts'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
        ];
        $request->validate($rules);
        $order = new Order();
        $order->name = $request->name;
        $order->save();
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
