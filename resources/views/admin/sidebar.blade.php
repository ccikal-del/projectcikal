<div class="sidebar">
    <div class="sidebar-header">
        <h4>Panel Admin</h4>
        <p>Management System</p>
    </div>
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="{{ route ('admin.dashboard')}}" class="nav-link {{request()-> 
                routeIs('admin.dashboard') ? 'active':''}}">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('products.index')}}" class="nav-link {{request()-> 
                routeIs('products.*') ? 'active':''}}">
                <i class="bi bi-box-seam"></i>
                Product Management
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.orders.index')}}" class="nav-link {{request()-> 
                routeIs('admin.orders.*') ? 'active':''}}">
                <i class="bi bi-cart-check"></i>
                Manage Orders
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.sales')}}" class="nav-link {{request()-> 
                routeIs('admin.sales') ? 'active':''}}">
                <i class="bi bi-graph-up"></i>
                Sales Report
            </a>
        </li>
    </ul>
</div>