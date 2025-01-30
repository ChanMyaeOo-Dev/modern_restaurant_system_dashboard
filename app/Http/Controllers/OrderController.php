<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Http\Resources\OrderItemResource;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::where('is_completed', '0')->latest()->get();
        return view('order.index', compact('orders'));
    }
    public function orderHistory()
    {
        $orders = Order::where('is_completed', '1')->latest()->get();
        return view('order.history', compact('orders'));
    }
    public function create()
    {
        $items = Item::all();
        $carts = Cart::all();
        $tables = Table::all();
        $table_id = Auth::id();
        $all_carts = Cart::where('table_id', "=", $table_id)->get();
        $cart_total = 0;
        foreach ($all_carts as $ind_cart) {
            $cart_total += $ind_cart->item->price * $ind_cart->quantity;
        }
        $items = ItemResource::collection($items);
        $items = $items->toArray(request());
        return view('order.create', compact('items', 'carts', 'cart_total', 'tables'));
    }

    public function store(Request $request)
    {
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
            $order_item->save();
        }
        //Delete all user carts
        Cart::where('table_id', 1)->delete();
        return back()->with('success_message', 'New Order has been successfully saved.');
    }

    public function show(Order $order)
    {
        $order_items =
            $order->order_items;;
        return view('order.show', compact('order_items', 'order'));
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

    public function update(Order $order)
    {
        $order->is_completed = "1";
        $order->update();
        return back()->with('success_message', 'Order has been successfully completed.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success_message', 'Order has been successfully deleted.');
    }
}
