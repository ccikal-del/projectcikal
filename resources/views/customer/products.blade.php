<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
        <h4>Customer Portal </h4>
        <p> Shopping Dashboard</p>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{route('customer.dashboard')}}" class="nav-link active">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>
             <li class="nav-item">
                <a href="{{ route('customer.products') }}" class="nav-link">
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
                <a href="{{ route('customer.orders') }}" class="nav-link">
                    <i class="bi bi-receipt"></i>
                    My Orders
                </a>
            </li>
        </ul>
    </div>
<div class="main-content">
    <div class="top-bar">
        <h4>Product</h4>
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
   @if (session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>{{session('success')}}
            </div>
     @endif

     @if($products->count() > 0)
     <div class="product-grid">
        @foreach ($products as $product)
        <div class="product-card">
            <img src="{{asset('/storage/products/'.$product->image)}}"
            alt="{{$product->title}}" class="product-image">
            <div class="product-info">
                <div class="product-title">{{$product->title}}</div>
                <div class="product-price">Rp{{number_format($product->price,2,',','.')}}</div>
                 <div class="product-stock">
                    <span class="stock-badge">
                        <i class="bi bi-box-seam"></i> Stock:
                    {{$product->stock}}
                </span>
            </div>
            <form action="{{ route('cart.add',$product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-add-cart">
                    <i class="bi bi-cart-plus"></i>Add to Cart
                </button>
            </form>
            </div>
        </div>
        @endforeach
     </div>
     <div class="d-flex justify-content-center">
        {{$products->links()}}
     </div>
@else
<div class="empty-state">
    <i class="bi bi-inbox"></i>
    <h4> No Products Available</h4>
</div>
@endif
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
