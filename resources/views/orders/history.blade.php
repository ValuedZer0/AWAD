@extends('layouts.app')

@section('title', 'Order History - Online Bookstore')

@section('content')
<h1 class="mb-4">My Orders</h1>

@forelse($orders as $order)
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="mb-0">{{ $order->order_number }}</h5>
                    <small class="text-muted">Ordered on {{ $order->ordered_at->format('d M Y, H:i') }}</small>
                </div>
                <div class="col-md-4 text-end">
                    <span class="badge 
                        {{ $order->status === 'delivered' ? 'bg-success' : 
                           ($order->status === 'cancelled' ? 'bg-danger' : 'bg-warning') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="mb-2">
                <strong>Total:</strong> RM {{ number_format($order->total_price, 2) }}
            </p>
            <p class="mb-2">
                <strong>Items:</strong> {{ $order->items->sum('quantity') }}
            </p>
            <p class="mb-0">
                <strong>Shipping:</strong> {{ Str::limit($order->shipping_address, 50) }}
            </p>
        </div>
        <div class="card-footer">
            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                View Details
            </a>
        </div>
    </div>
@empty
    <div class="alert alert-info">
        You haven't placed any orders yet. <a href="{{ route('books.index') }}">Start shopping</a>
    </div>
@endforelse

<div class="d-flex justify-content-center mt-4">
    {{ $orders->links() }}
</div>
@endsection
