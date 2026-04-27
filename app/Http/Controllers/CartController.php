<?php

namespace App\Http\Controllers;

use  Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cartItems = Cart::Where('user_id', Auth::id())
        ->with('product')
        ->get();
        $total=$cartItems->sum(function($item)
        {
            return $item->product->price * $item->quantity;
        });
        return view('customer.cart', compact('cartItems','total'));
    }

    public function add(Request $request,$productId)
    {
        $product=Product::findOrFail($productId);

        $cartItem=Cart::where('user_id',Auth::id())
        ->where('product_id',$productId)
        ->first();

        if ($cartItem){
            $cartItem->quantity +=$request->input('quantity',1);
            $cartItem->save();
        }else{
            Cart::create([
                'user_id'=>Auth::id(),
                'product_id'=>$productId,
                'quantity'=>$request->input('quantity',1),
            ]);
        }
        return redirect()->back()->with('success','Product added to cart');
    }

    public function update(Request $request,$cartId)
    {
        $cartItem=Cart::where('id',$cartId)
        ->where('user_id',Auth::id())
        ->firstOrFail();

        $cartItem->quantity =$request->input('quantity');
        $cartItem->save();

        return redirect()->back()->with('success','Cart updated');
    }

    public function remove($cartId)
    {
        Cart::where('id',$cartId)
        ->where('user_id',Auth::id())
        ->delete();

         return redirect()->back()->with('success','Item removed from cart');
    }
}
