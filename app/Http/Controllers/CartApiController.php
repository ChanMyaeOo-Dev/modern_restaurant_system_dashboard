<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartApiResource;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartApiController extends Controller
{
    public function index(Request $request)
    {
        $carts = Cart::where('table_id', "=", $request->table_id)->get();
        $all_carts = Cart::where('table_id', $request->table_id)->with('item')->get();
        $total_price = $all_carts->sum(function ($cart) {
            return $cart->item->price * $cart->quantity;
        });
        $carts = CartApiResource::collection($carts);
        return response()->json([
            "success" => true,
            "total_price" => $total_price,
            "carts" => $carts
        ]);
    }
    public function store(Request $request)
    {
        $new_item_id = $request->item_id;
        $table_id = $request->table_id;
        $quantity = $request->quantity;
        $special_request = $request->special_request;
        $cart = Cart::where('item_id', $new_item_id)
            ->where('table_id', $table_id)
            ->first();
        if ($cart) {
            $cart->quantity = $cart->quantity + 1;
            $cart->update();
            return response()->json([
                "success" => true,
                "cart" => $cart
            ]);
        }
        $cart = new Cart();
        $cart->item_id = $request->item_id;
        $cart->table_id = $table_id;
        $cart->quantity = $quantity;
        $cart->special_request = $special_request;
        $cart->save();
        return response()->json([
            "success" => true,
            "cart" => $cart
        ]);
    }
    public function update(Request $request)
    {
        $cart = Cart::find($request->id);
        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->update();
            return response()->json(['success' => true, 'cart' => $cart]);
        }
        return response()->json(['success' => false]);
    }
    public function destroy(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        if ($cart) {
            $cart->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
