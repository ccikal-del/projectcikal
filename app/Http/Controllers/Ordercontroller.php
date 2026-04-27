<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Ordercontroller extends Controller
{
    public function checkout()
    {
        $cartItems=Cart::where('user_id',Auth::id())
        ->with('product')
        ->get();

        if($cartItems->isEmpty()){
            return redirect()->route('customer.products')->with('error','Your cart is empty');
        }

    $total=$cartItems->sum(function($item){
        return $item->product->price *$item->quantity;
    });
    return view('customer.checkout',compact('cartItems','total'));
    }

    public function processCheckout(Request $request){
        $request->validate([

         'shipping_name'=>'required|string|max:225',
        'shipping_address'=>'required|string',
        'shipping_phone'=>'required|string|max:20',
        'payment_method'=>'required|in:bank_transfer,COD,e_wallet',
        ]);

          $cartItems=Cart::where('user_id',Auth::id())
        ->with('product')
        ->get();

        if($cartItems->isEmpty()){
            return redirect()->route('customer.products')->with('error','Your cart is empty');
        }

    $total=$cartItems->sum(function($item){
        return $item->product->price *$item->quantity;
    });

    DB::beginTransaction();
    try{
    $order =Order::create([
         'user_id'=>Auth::id(),
        'order_number'=> 'ORD-'.time(). '-' .Auth::id(),
        'total_number'=>$total,
        'status'=>'pending',
        'shipping_name'=>$request->shipping_name,
        'shipping_address'=>$request->shipping_address,
        'shipping_phone'=>$request->shpping_phone,
        'payment_method'=>$request->payment_method,
        'payment_status'=>'unpaid',
    ]);

    foreach($cartItems as $item){
        OrderItem::create([
        'order_id'=>$order->id,
        'product_id'=>$item->product_id,
        'quantity'=>$item->quantity,
        'price'=>$item->product->price,
        ]);

        $product = $item->product;
        $product ->stock -=$item->quantity;
        $product->save();
    }
    Cart::where('user_id',Auth::id())->delete();

    DB::commit();
    return redirect()->route('costumer.order.confirtmation',$order->id);
      }catch(\Exception $e){
        DB::rollBack();
        return redirect()->back()->with('error','Order failed.please try again');
      }

    }

    public function confirmation($orderId){
        $order = Order::where('id',$orderId)
        ->where('user_id',Auth::id())
        ->with('OrderItems.product')
        ->firstOrFail();

        return view('customer.order-confirmation',compact('order'));

    }

    public function orders()
    {
        $orders=Order::where('user_id',Auth::id())
        ->orderBy('created_at','desc')
        ->paginate(10);
         return view('customer.orders',compact('orders'));
    }

    public function orderDetail($orderId)
    {
         $order = Order::where('id',$orderId)
        ->where('user_id',Auth::id())
        ->with('OrderItems.product')
        ->firstOrFail();

         return view('customer.order-detail',compact('order'));
    }
}
