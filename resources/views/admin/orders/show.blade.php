<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Details - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
@include('admin.sidebar')
<div class="main-content">
    <div class="d-flex align-items-center mb-4 gap-3">
        <a href="{{route('admin.orders.index')}}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>Back
        </a>
    </div>
    <h2> Order Details #{{$order->order_number}}</h2>
    @if (session('success'))
            <div class="alert alert-success">{{session('success')}} </div>  
     @endif
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Order Items</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->$orderItems as $item)
                        <tr> 
                        <td>
                            <div class="d-flex align-items-center mb-4 gap-3">
                                 <img src="{{asset('/storage/products/'.$item->product->image)}}" 
                                     width="50" class="rounded" alt=""> 
                                     <span>{{ $item->product->title}}</span>
                            </div>
                        </td>
                        <td>Rp{{number_format($item->price,2,',','.')}}</td>
                        <td{{$item->quantity}}</td>
                        <td>Rp{{number_format($item->price * $item->quantity,2,',','.' )}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td> <strong> Grand Total</strong></td>
                            <td>Rp{{number_format($order->total_amount,2,',','.' )}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4> Update Order Status</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.orders.update',$order->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Order Status</label>
                            <select name="status" class="form-select">
                                <option value="pending" {{$order->status == 'pending' ? 'selected':''}}>Pending</option>
                                <option value="processing" {{$order->status == 'processing' ? 'selected':''}}>Processing</option>
                                <option value="completed" {{$order->status == 'completed' ? 'selected':''}}>Completed</option>
                                <option value="cancelled" {{$order->status == 'cancelled' ? 'selected':''}}>Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Payment Status</label>
                            <select name="payment_status" class="form-select">
                                <option value="paid" {{$order->payment_status == 'paid' ? 'selected':''}}>Paid</option>
                                <option value="unpaid" {{$order->payment_status == 'unpaid' ? 'selected':''}}>Unpaid</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Status</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Customer Info</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4 gap-3">
                        <div class="bg-light rounded-circle p-2 d-flex align-items-center
                        justify-content-center" style="width:40px; height:40px;">
                        <i class="bi bi-person fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold">{{$order->user->name}}</div>
                            <div class="text-muted small">{{$order->user->email}}</div>
                        </div>
                    </div>
                     <div class="text-muted small">
                        Joined:{{$order->user->created_at->format('d M Y')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>   
</body>
</html>