<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $productCount = Product::count();
        $orderCount = Order::count();
        $revenue = Order::where('status','!=','cancelled')->sum('total_amount');
        
        return view('admin.dashboard', compact('productCount','orderCount','revenue'));
    }

    public function salesReport(Request $request)
    {
        $query = Order::query();
        $period = $request->get('period','all');
        $date = $request->get('date',now()->format('Y-m-d'));

        switch($period){
            case 'daily':
                $query->whereDate('created_at',$date);
                $title="Daily Report(".Carbon::parse($date)->format('Y-m-d').")";
                break;
            case 'weekly':
                $startOfWeek = Carbon::parse($date)->startOfWeek();
                $endOfWeek = Carbon::parse($date)->endOfWeek();
                $query->whereBetween('created_at',[$startOfWeek, $endOfWeek]);
                $title="Weekly Report(".$startOfWeek->format('Y-m-d')."-".
                $endOfWeek->format('Y-m-d').")";
                break;
            case 'monthly':
                $query->whereMonth('created_at',Carbon::parse($date)->month)
                ->whereYear('created_at',Carbon::parse($date)->year);
                $title="Monthly Report(".Carbon::parse($date)->format('F Y').")";
                break;
            default:
            $title=" All Time Report";
            break;
        }

        $orders =$query->orderBy('created_at', 'desc')->get();

        $totalOrders = $orders->count();
        $totalRevenue = $orders->where('status','!=','cancelled')->sum('total_amount');
        $successfulOrders =$orders->where('status','!=','cancelled')->count();

        return view('admin.sales.index',compact(
            'orders',
            'totalOrders',
            'totalRevenue',
            'successfulOrders',
            'period',
            'date',
            'title'
        ));
        
    }
}
