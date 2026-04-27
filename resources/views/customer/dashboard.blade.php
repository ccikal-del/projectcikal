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
        <h4>Welcome to Customer Dashboard </h4>
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
        <h4>Dashboard</h4>
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
    <div class="welcome-card">
        <h3>Welcome,{{Auth::user()->name}}!</h3>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
