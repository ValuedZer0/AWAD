@extends('layouts.app')

@section('title', 'Admin Dashboard - Online Bookstore')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Admin Dashboard</h1>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary">← Back to Store</a>
</div>

<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Books</h5>
                <h2>{{ $totalBooks }}</h2>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.books.list') }}" class="text-white">Manage Books →</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Total Orders</h5>
                <h2>{{ $totalOrders }}</h2>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.orders.list') }}" class="text-white">View Orders →</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Total Revenue</h5>
                <h2>RM {{ number_format($totalRevenue, 2) }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Quick Actions</h5>
                <a href="{{ route('admin.books.create') }}" class="btn btn-sm btn-light">Add Book</a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Recent Orders</h5>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>RM {{ number_format($order->total_price, 2) }}</td>
                        <td>
                            <span class="badge 
                                {{ $order->status === 'delivered' ? 'bg-success' : 
                                   ($order->status === 'cancelled' ? 'bg-danger' : 'bg-warning') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->ordered_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.list') }}" class="btn btn-sm btn-primary">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No orders yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
