<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function dashboard(){
        return view('customer.dashboard');
    }

    public function products()
    {
        $products = Product::paginate(10);
        return view('customer.products',compact('products'));
        
    }
}
