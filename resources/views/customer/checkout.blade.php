<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
        <div class="container">
            <a href="{{ route('cutomer.cart') }}" class="back-link">
                <i class="bi-bi-arrow-left"></i>Back To Cart
            </a>
            <form action="{{ ('checkout.proses') }}" method="POST">
                @csrf
                <div class="checkout-grid">
                    <div class="form-section">
                        <div class="section-title">
                            <i class="bi bi-truck"></i>Shipping Information
                        </div>
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="shipping_name" class="form-control"
                            required value="{{ Auth::user->name }}">
                        </div>
                         </div>
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="shipping_phone" class="form-control"
                            required placeholder="09xxxxxxxxxx">
                        </div>
                         <div class="form-group">
                            <label class="form-label">Shipping Address</label>
                            <textarea name="shipping_address"  class="form-control" rows="4"
                            required placeholder="Complete Address including street,city,zip code">
                             </textarea>
                        </div>
                        <div class="section-title" style="margin-top:30px">
                            <i class="bi bi-credit-card"></i>Payment Method
                        </div>
                        <div class="payments-methods">
                            <label class="payment-option">
                            <input type="radio" name="payment_method" value="bank_transfer" required checked>
                            <div><i class="bi bi-bank"></i><br>Bank Transfer</div>
                            </label>

                            <label class="payment-option">
                            <input type="radio" name="payment_method" value="cod" required checked>
                            <div><i class="bi bi-cash"></i><br>COD</div>
                            </label>

                            <label class="payment-option">
                            <input type="radio" name="payment_method" value="e-wallet" required checked>
                            <div><i class="bi bi-wallet2"></i><br>E-Wallet</div>
                            </label>
                        </div>
                    </div>
                    <div class="order-summary">
                        <div class="section-title">Order Summary</div>
                        @foreach ($cartItems as $item)
                        <div class="summary-item">
                            <span>{{ $item->product->title }} x {{ $item->quantity }}</span>
                            <span>Rp{{number_format($item->product->price * $item->quantity,0,',','.')  }}</span>
                        </div>

                        @endforeach
                        <div class="total-row">
                            <span>Total Pay</span>
                            <span>Rp{{number_format($total,2,',','.')  }}</span>
                        </div>

                        <button type="submit" class="btn-confirm">
                            Place Order <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <script>
            const paymentOptions=documents.querySelectorAll('.payment-option');
            paymentOptions.forEach(option => {
                option.addEventListener('click',()=>{
                paymentOptions.forEach(opt.classList.remove('selected'));
                option.classList.add('selected');


                });
            });
            document.querySelector('input[name="payment_method"]:checked').closest('.payment-option').classList.add('selected');
        </script>
</body>
</html>
