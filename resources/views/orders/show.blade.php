@extends('layouts.app')

@section('title', 'Order Details - Online Bookstore')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <a href="{{ route('orders.history') }}" class="btn btn-outline-secondary mb-3">← Back to Orders</a>
        
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">{{ $order->order_number }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Order Information</h5>
                        <p>
                            <strong>Status:</strong>
                            <span class="badge 
                                {{ $order->status === 'delivered' ? 'bg-success' : 
                                   ($order->status === 'cancelled' ? 'bg-danger' : 'bg-warning') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        <p>
                            <strong>Ordered Date:</strong> {{ $order->ordered_at->format('d M Y, H:i') }}
                        </p>
                        <p>
                            <strong>Total Amount:</strong> <span class="text-primary">RM {{ number_format($order->total_price, 2) }}</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5>Shipping Details</h5>
                        <p>
                            <strong>Phone:</strong> {{ $order->phone }}
                        </p>
                        <p>
                            <strong>Address:</strong><br>
                            {{ $order->shipping_address }}
                        </p>
                    </div>
                </div>

                <hr>

                <h5>Order Items</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Book</th>
                            <th>Author</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('books.show', $item->book_id) }}">
                                        {{ $item->book->title }}
                                    </a>
                                </td>
                                <td>{{ $item->book->author }}</td>
                                <td>RM {{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>
                                    <strong>RM {{ number_format($item->price * $item->quantity, 2) }}</strong>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-end">
                    <h5>Total: <span class="text-primary">RM {{ number_format($order->total_price, 2) }}</span></h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
