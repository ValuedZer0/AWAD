@extends('layouts.app')

@section('title', 'My Profile - Online Bookstore')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h1 class="mb-4">My Profile</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ $user->name }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ $user->email }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Account Type</label>
                        <input type="text" class="form-control" id="role" 
                               value="{{ ucfirst($user->role) }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="created_at" class="form-label">Member Since</label>
                        <input type="text" class="form-control" id="created_at" 
                               value="{{ $user->created_at->format('d M Y') }}" disabled>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('orders.history') }}" class="btn btn-outline-secondary">View Orders</a>
                        <a href="{{ route('favorites.view') }}" class="btn btn-outline-secondary">View Favorites</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
