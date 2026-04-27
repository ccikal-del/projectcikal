<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <h4>My Cart</h4>
    </div>

    <ul class="nav-menu">
        <li class="nav-item">
            <a href="{{ route('customer.dashboard') }}" class="nav-link">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('customer.products') }}" class="nav-link">
                <i class="bi bi-bag-check"></i> Browse Product
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('customer.cart') }}" class="nav-link active">
                <i class="bi bi-cart3"></i> My Cart
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('customer.orders') }}" class="nav-link">
                <i class="bi bi-receipt"></i> My Orders
            </a>
        </li>
    </ul>
</div>

<div class="main-content">
    <div class="top-bar">
        <h4>My Cart</h4>

        <div class="user-info">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name,0,1)) }}
            </div>
            <div>
                <strong>{{ Auth::user()->name }}</strong>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="alert alert-success mt-3">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Cart Items --}}
    @if ($cartItems->count() > 0)
    <div class="cart-container mt-4">

        @foreach ($cartItems as $item)
        <div class="cart-item mb-3 p-3 border rounded d-flex align-items-center">

            <img src="{{ asset('storage/products/'.$item->product->image) }}"
                 alt="{{ $item->product->title }}"
                 width="80"
                 class="me-3">

            <div class="flex-grow-1">
                <div class="fw-bold">{{ $item->product->title }}</div>
                <div>Rp{{ number_format($item->product->price,2,',','.') }}</div>
            </div>

            <div class="me-3">
                <form action="{{ route('cart.update',$item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="number"
                           name="quantity"
                           value="{{ $item->quantity }}"
                           min="1"
                           class="form-control"
                           style="width:80px"
                           onchange="this.form.submit()">
                </form>
            </div>

            <form action="{{ route('cart.remove',$item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i>
                </button>
            </form>

        </div>
        @endforeach

        {{-- Summary --}}
        <div class="cart-summary mt-4 p-3 border rounded">
            <h5>Order Summary</h5>
            <div class="d-flex justify-content-between">
                <span>Subtotal</span>
                <span>Rp{{ number_format($total,2,',','.') }}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between fw-bold">
                <span>Total</span>
                <span>Rp{{ number_format($total,2,',','.') }}</span>
            </div>

            <button class="btn btn-primary w-100 mt-3">
                Proceed to Checkout
            </button>
        </div>

    </div>

    @else
    <div class="empty-cart text-center mt-5">
        <i class="bi bi-cart-x fs-1"></i>
        <h4>Your cart is empty</h4>
        <a href="{{ route('customer.products') }}" class="btn btn-primary mt-3">
            Browse Products
        </a>
    </div>
    @endif

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
