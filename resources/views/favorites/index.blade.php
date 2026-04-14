@extends('layouts.app')

@section('title', 'My Favorites - Online Bookstore')

@section('content')
<h1 class="mb-4">❤️ My Favorite Books</h1>

@if($favorites->count() > 0)
    <div class="row">
        @foreach($favorites as $book)
            <div class="col-md-3 mb-4">
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
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-primary w-100 mb-1">
                            View Book
                        </a>
                        <form action="{{ route('favorites.remove', $book->id) }}" method="POST" class="d-inline w-100">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $favorites->links() }}
    </div>
@else
    <div class="alert alert-info">
        You haven't favorited any books yet. 
        <a href="{{ route('books.index') }}">Browse books</a>
    </div>
@endif
@endsection
