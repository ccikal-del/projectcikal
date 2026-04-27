<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Orders -Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('admin.sidebar')
<div class="main-content">
    <h3 class="mb-4">Manage Orders</h3>
    <div class="card">
        <div class="card-header">
            <h5>Order List</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success">{{session('success')}} </div>  
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Order Id</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->order_number}}</td>
                            <td>{{$order->created_at->format('d M Y')}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>Rp{{number_format($order->total_amount,2,',','.')}}</td>
                            <td class="text-uppercase">{{str_replace('-','',$order->payment_methode)}}</td>
                            <td>
                                <span class="badge-status status-{{$order->status}}">
                                    {{ucfirst ($order->status)}}
                                </span>
                            </td>
                       
                        <td>
                                <span class="badge-status status-{{$order->payment_status}}">
                                    {{ucfirst ($order->payment_status)}}
                                </span>
                            </td>
                            <td>
                                <a href="" class="btn btn-sm btn-primary"> View & Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>   
                </table>
            </div>
            <div class="mt-3">
                {{$orders->links()}}
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>