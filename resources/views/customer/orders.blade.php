<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
        <h4>Welcome to Customer Orders </h4>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{route('customer.dashboard')}}" class="nav-link active">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>
             <li class="nav-item">
                <a href="{{route('customer.products')}}" class="nav-link">
                    <i class="bi bi-bag-check"></i>
                   Browser Product
                </a>
            </li>
             <li class="nav-item">
                <a href="{{ route('customer.cart') }}" class="nav-link">
                    <i class="bi bi-cart3"></i>
                    My Cart
                </a>
            </li>
             <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="bi bi-receipt"></i>
                    My Orders
                </a>
            </li>
        </ul>
    </div>
<div class="main-content">
    <div class="top-bar">
        <h4>Order History</h4>
       <div class="user-info">
        <div class="user-avatar">
            {{strtoupper(substr(Auth::user()->name,0,1)) }}
        </div>
        <div>
            <strong>{{ Auth::user()->name}}</strong>
            <form action="{{route('logout')}}" method="POST"
            style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
        </div>
    </div>
    </div>
   @if($orders->count() > 0)
   <div class="orders-table">
    <div class="table table-hover">
       <table>
        <thead>
            <tr>
                <th>Order Id</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{$order->order_number}}</td>
                <td>{{$order->created_at->format('d M Y')}}</td>
                <td>Rp{{number_format($order->total_amount,2,',','.')}}</td>
                <td>{{str_replace('-','',$order->payment_method)}}</td>
                <td>
                    <span class="badge-status status-{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{('customer.order.show',$order->id)}}" class="btn-view">
                        View Details
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
       </table>
       <div class="d-flex justify-content-center mt-3">
        {{ $ordets->links() }}
       </div>
    </div>
    @else
    <div class="empty-state">
        <i class="bi bi-clipboard-x"></i>
        <h4>No Orders</h4>
        <a href="{{ route('costumer.products') }}" class="btn btn-success mt-3">Start Shopping</a>
    </div>
    @endif
   </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
