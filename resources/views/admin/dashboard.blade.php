<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    @include('admin.sidebar')
<div class="main-content">
    <h4>Welcome to Admin Dashboard </h4>
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
 
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="bi bi-box-seam"></i>
        </div>
        <h3></h3>
        <p>Total Products</p>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="bi bi-cart"></i>
        </div>
        <h3></h3>
        <p>Total Orders</p>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="bi bi-currently-dollar"></i>
        </div>
        <h3>Rp</h3>
        <p>Total Revenue</p>
    </div>
    <div class="quick-actions">
        <h3>Quick Actions</h3>
        <a href="{{route('products.index')}}" class="action-btn">
         <i class="bi bi-box-seam"></i> Manage Products
         </a> 
         <a href="{{route('products.create')}}" class="action-btn">
         <i class="bi bi-plus-circle"></i> Add New Product
         </a> 
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>