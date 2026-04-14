@extends('layouts.app')

@section('title', 'Manage Books - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Manage Books</h1>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">+ Add New Book</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($books as $book)
            <tr>
                <td>{{ Str::limit($book->title, 40) }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category->name }}</td>
                <td>RM {{ number_format($book->price, 2) }}</td>
                <td>
                    <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                        {{ $book->stock }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.books.delete', $book->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this book?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted">No books found</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center mt-4">
    {{ $books->links() }}
</div>
@endsection
