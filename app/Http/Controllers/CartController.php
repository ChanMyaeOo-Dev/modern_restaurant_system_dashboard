<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(StoreCartRequest $request)
    {
        $new_item_id = $request->item_id;
        $cart = Cart::where('item_id', $new_item_id)->first();
        if ($cart) {
            $cart->quantity = $cart->quantity + 1;
            $cart->update();
            return redirect()->back();
        }
        $cart = new Cart();
        $cart->item_id = $request->item_id;
        $cart->user_id = "1";
        $cart->quantity = 1;
        $cart->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        $current_qty = $cart->quantity;
        $action = $request->action;
        if ($cart) {
            if ($action == "add") {
                $cart->quantity = $current_qty + 1;
            } else if ($current_qty > 1) {
                $cart->quantity = $current_qty - 1;
            }
            $cart->update();
            return response()->json(['success' => true, 'quantity' => $cart->quantity]);
        }
        return response()->json(['success' => false]);
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
