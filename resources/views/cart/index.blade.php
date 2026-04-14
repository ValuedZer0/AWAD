@extends('layouts.app')

@section('title', 'Shopping Cart - Online Bookstore')

@section('content')
<h1 class="mb-4">Shopping Cart</h1>

@if(empty($cart))
    <div class="alert alert-info">
        Your cart is empty. <a href="{{ route('books.index') }}">Start shopping</a>
    </div>
@else
    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Book</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $bookId => $item)
                        <tr>
                            <td>
                                <a href="{{ route('books.show', $bookId) }}">
                                    {{ $item['title'] }}
                                </a>
                            </td>
                            <td>RM {{ number_format($item['price'], 2) }}</td>
                            <td>
                                <form action="{{ route('cart.update', $bookId) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="number" name="quantity" class="form-control" 
                                           style="width: 80px;" value="{{ $item['quantity'] }}" min="1">
                                    <button type="submit" class="btn btn-sm btn-secondary mt-1">Update</button>
                                </form>
                            </td>
                            <td>
                                <strong>RM {{ number_format($item['price'] * $item['quantity'], 2) }}</strong>
                            </td>
                            <td>
                                <form action="{{ route('cart.remove', $bookId) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Clear Cart</button>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                    <hr>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <strong>RM {{ number_format($total, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <strong>RM 0.00</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Tax:</span>
                            <strong>RM 0.00</strong>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <h5>Total:</h5>
                        <h5 class="text-primary">RM {{ number_format($total, 2) }}</h5>
                    </div>
                    <a href="{{ route('orders.checkout') }}" class="btn btn-primary w-100">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
