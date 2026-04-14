@extends('layouts.app')

@section('title', 'Books - Online Bookstore')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Books Catalog</h1>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Filter & Search</h5>
                <form action="{{ route('books.index') }}" method="GET">
                    <div class="mb-3">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               placeholder="Title or Author" value="{{ request('search') }}">
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category" name="category">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sort" class="form-label">Sort By</label>
                        <select class="form-control" id="sort" name="sort">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="row">
            @forelse($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-img-top bg-light" style="height: 250px; overflow: hidden;">
                            @if($book->image_url)
                                <img src="{{ $book->image_url }}" alt="{{ $book->title }}" 
                                     class="w-100 h-100" style="object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 bg-secondary text-white">
                                    📚 No Image
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($book->title, 50) }}</h5>
                            <p class="card-text text-muted small">{{ $book->author }}</p>
                            <p class="card-text">
                                <strong class="text-primary">RM {{ number_format($book->price, 2) }}</strong>
                            </p>
                            <div class="mb-2">
                                <span class="badge bg-warning text-dark">⭐ {{ $book->rating }}</span>
                                <span class="badge bg-info">{{ $book->category->name }}</span>
                            </div>
                            <p class="card-text">
                                <small class="text-muted">Stock: {{ $book->stock }}</small>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-primary w-100">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No books found. Try adjusting your filters.
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection
