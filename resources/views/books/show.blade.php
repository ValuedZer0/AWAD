@extends('layouts.app')

@section('title', $book->title . ' - Online Bookstore')

@section('content')
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            @if($book->image_url)
                <img src="{{ $book->image_url }}" class="card-img-top" alt="{{ $book->title }}" style="height: 400px; object-fit: cover;">
            @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 400px;">
                    <span class="text-muted">📚 No Image</span>
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-8">
        <h1>{{ $book->title }}</h1>
        
        <p class="text-muted mb-2">
            <strong>Author:</strong> {{ $book->author }}
        </p>

        <p class="mb-2">
            <strong>Category:</strong> 
            <span class="badge bg-info">{{ $book->category->name }}</span>
        </p>

        <p class="mb-2">
            <strong>Rating:</strong>
            <span class="badge bg-warning text-dark">⭐ {{ $book->rating }}/5</span>
        </p>

        <div class="mb-3">
            <h3 class="text-primary">RM {{ number_format($book->price, 2) }}</h3>
        </div>

        <div class="mb-3">
            <strong>Stock:</strong>
            <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                {{ $book->stock > 0 ? $book->stock . ' Available' : 'Out of Stock' }}
            </span>
        </div>

        @if($book->isbn)
            <p class="mb-2">
                <strong>ISBN:</strong> {{ $book->isbn }}
            </p>
        @endif

        @if($book->pages)
            <p class="mb-2">
                <strong>Pages:</strong> {{ $book->pages }}
            </p>
        @endif

        @if($book->published_date)
            <p class="mb-3">
                <strong>Published:</strong> {{ $book->published_date->format('F Y') }}
            </p>
        @endif

        @if($book->description)
            <div class="mb-4">
                <h5>Description</h5>
                <p>{{ $book->description }}</p>
            </div>
        @endif

        @auth
            <div class="mb-3">
                @if($book->isFavoritedBy(auth()->user()))
                    <form action="{{ route('favorites.remove', $book->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">❤️ Remove from Favorites</button>
                    </form>
                @else
                    <form action="{{ route('favorites.toggle', $book->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">🤍 Add to Favorites</button>
                    </form>
                @endif
            </div>

            @if($book->stock > 0)
                <form action="{{ route('cart.add', $book->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" 
                               value="1" min="1" max="{{ $book->stock }}" style="width: 100px;">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">🛒 Add to Cart</button>
                </form>
            @else
                <button class="btn btn-secondary btn-lg" disabled>Out of Stock</button>
            @endif
        @else
            <div class="alert alert-info">
                <a href="{{ route('auth.login') }}">Login</a> or 
                <a href="{{ route('auth.register') }}">Register</a> to purchase books.
            </div>
        @endauth
    </div>
</div>

@if($relatedBooks->count() > 0)
    <div class="row mt-5">
        <div class="col-md-12">
            <h3>Related Books</h3>
            <div class="row">
                @foreach($relatedBooks as $relBook)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <div class="card-img-top bg-light" style="height: 200px; overflow: hidden;">
                                @if($relBook->image_url)
                                    <img src="{{ $relBook->image_url }}" alt="{{ $relBook->title }}" 
                                         class="w-100 h-100" style="object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 bg-secondary text-white">
                                        📚
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ Str::limit($relBook->title, 40) }}</h5>
                                <p class="card-text text-muted small">{{ $relBook->author }}</p>
                                <p class="card-text">
                                    <strong>RM {{ number_format($relBook->price, 2) }}</strong>
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('books.show', $relBook->id) }}" class="btn btn-sm btn-primary w-100">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@endsection
