<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
        <h4>Customer Portal</h4>
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
        <h4>Order Detail</h4>
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
    <a href="{{ route('customer.orders') }}" class="back-btn">
        <i class="bi bi-arrow-left"></i>Back To Orders
    </a>
<div class="content-card">
    <div class="section-header">Order Information</div>
    <div class="info-grid">
        <div>
            <div class="info-label">Order Number</div>
            <div class="info-value">{{ $order->order_number }}</div>0
        </div>
          <div>
            <div class="info-label">Date Placed</div>
            <div class="info-value">{{ $order->created_at->format('d M Y') }}</div>
        </div>
          <div>
            <div class="info-label">Status</div>
            <div class="info-value">
            <span class="badge-status status-{{ $order->status }}">
                {{ucfirst( $order->status) }}
            </span>
            </div>
        </div>
         <div>
            <div class="info-label">Payment Method</div>
            <div class="info-value text-uppercase">{{ str_replace('_',' ',$order->payment_method)}}</div>
        </div>
    </div>
</div>
<div class="content-card">
    <div class="section-header">Shipping Details</div>
    <div class="info-grid">

        <div class="info-label">Receipent Name</div>
        <div class="info-value">{{ $order->shipping_name }}</div>
    </div>

    <div>
        <div class="info-label">Phone Number</div>
        <div class="info-value">{{ $order->shipping_phone }}</div>
    </div>

    <div class="grid-column:span 2;">
        <div class="info-label">Shipping Address</div>
        <div class="info-value">{{ $order->shipping_address }}</div>
    </div>
</div>

<div class="content-card">
    <div class="section-header">Order Item</div>
    <table class="order-items-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th class="text-end">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>
                        <div class="item-row">
                            <img src="{{ asset('/storage/products/'.$item->product->image) }}"
                             alt="" class="item-image">
                        </div>
                    </td>
                    <td>Rp{{ number_format($item->price,2,',','.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td class="text-end" style="font-weight: 600;" Rp {{ number_format($item->price * $item->quantity,2,',','.') }}>

                    </td>
                </tr>
            @endforeach
            <tr>
                <td>Total Amount</td>
                    <td>Rp{{ number_format($item->total_amount,2,',','.') }}</td>

            </tr>
        </tbody>
    </table>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
