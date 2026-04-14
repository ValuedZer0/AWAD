@extends('layouts.app')

@section('title', 'Home - Online Bookstore')

@section('content')
<div class="row mb-4">
    <div class="col-lg-12">
        <div class="jumbotron bg-light p-4 rounded">
            <h1 class="display-4">Welcome to BookStore</h1>
            <p class="lead">Discover millions of books at great prices</p>
            <a class="btn btn-primary btn-lg" href="{{ route('books.index') }}" role="button">Start Shopping</a>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <h2>Featured Books</h2>
        <div class="row">
            @forelse($featuredBooks as $book)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="card-img-top bg-light" style="height: 250px; object-fit: cover;">
                            @if($book->image_url)
                                <img src="{{ $book->image_url }}" alt="{{ $book->title }}" class="w-100 h-100" style="object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 bg-secondary text-white">
                                    📚 No Image
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text text-muted">{{ $book->author }}</p>
                            <p class="card-text">
                                <strong>RM {{ number_format($book->price, 2) }}</strong>
                            </p>
                            <div class="mb-2">
                                <span class="badge bg-warning text-dark">⭐ {{ $book->rating }}</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">No featured books available.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <h2>New Arrivals</h2>
        <div class="row">
            @forelse($newBooks as $book)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="card-img-top bg-light" style="height: 250px; object-fit: cover;">
                            @if($book->image_url)
                                <img src="{{ $book->image_url }}" alt="{{ $book->title }}" class="w-100 h-100" style="object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 bg-secondary text-white">
                                    📚 No Image
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text text-muted">{{ $book->author }}</p>
                            <p class="card-text">
                                <strong>RM {{ number_format($book->price, 2) }}</strong>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">No new books available.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
