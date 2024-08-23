<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(StoreCartRequest $request)
    {
        $table_id = $request->table_id;
        $new_item_id = $request->item_id;
        $cart = Cart::where('item_id', $new_item_id)->first();
        if ($cart) {
            $cart->quantity = $cart->quantity + 1;
            $cart->update();
            return redirect()->back();
        }
        $cart = new Cart();
        $cart->item_id = $request->item_id;
        $cart->table_id = $table_id;
        $cart->quantity = 1;
        $cart->save();
        return redirect()->back();
    }
    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        $current_qty = $cart->quantity;
        $action = $request->action;
        if ($cart) {
            if ($action == "add") {
                $new_qty = $current_qty + 1;
                $cart->quantity = $new_qty;
            } else if ($current_qty > 1) {
                $new_qty = $current_qty - 1;
                $cart->quantity = $new_qty;
            }
            $cart->update();
            // Replae With Current User Id
            $all_carts = Cart::where('table_id', "=", "1")->get();
            $total = 0;
            foreach ($all_carts as $ind_cart) {
                $total += $ind_cart->item->price * $ind_cart->quantity;
            }
            return response()->json(['success' => true, 'quantity' => $cart->quantity, "total" => $total, "all_carts" => $all_carts]);
        }
        return response()->json(['success' => false]);
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cartLength = Cart::where('table_id', "=", "1")->count();
        if ($cart) {
            $cart->delete();
            return response()->json(['success' => true, "cartLength" => $cartLength]);
        }
        return response()->json(['success' => false]);
    }
}
