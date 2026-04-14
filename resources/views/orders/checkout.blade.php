@extends('layouts.app')

@section('title', 'Checkout - Online Bookstore')

@section('content')
<h1 class="mb-4">Checkout</h1>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Shipping Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="shipping_address" class="form-label">Shipping Address</label>
                        <textarea class="form-control @error('shipping_address') is-invalid @enderror" 
                                  id="shipping_address" name="shipping_address" rows="4" required
                                  placeholder="Enter your full shipping address">{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" required placeholder="e.g., +60 1234 5678"
                               value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg">Place Order</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card sticky-top" style="top: 20px;">
            <div class="card-header">
                <h5 class="mb-0">Order Summary</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6>Items in Order:</h6>
                    @php $totalPrice = 0 @endphp
                    @foreach($cart as $item)
                        @php $subtotal = $item['price'] * $item['quantity']; $totalPrice += $subtotal; @endphp
                        <div class="d-flex justify-content-between mb-2">
                            <small>{{ $item['title'] }} x {{ $item['quantity'] }}</small>
                            <small><strong>RM {{ number_format($subtotal, 2) }}</strong></small>
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <h5>Total:</h5>
                    <h5 class="text-primary">RM {{ number_format($total, 2) }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
