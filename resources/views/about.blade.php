@extends('layouts.app')

@section('title', 'About Us - Online Bookstore')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1 class="mb-4">About Us</h1>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Welcome to Online Bookstore</h5>
                <p class="card-text">
                    Welcome to our Online Bookstore, your ultimate destination for discovering and purchasing quality books 
                    from around the world. We are committed to providing an excellent shopping experience for book lovers 
                    of all ages.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">📚 Our Mission</h5>
                        <p class="card-text">
                            To make quality books accessible to everyone by offering a wide selection of titles 
                            at competitive prices with convenient online shopping and fast delivery.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">🎯 Our Vision</h5>
                        <p class="card-text">
                            To be the most trusted and customer-friendly online bookstore in Southeast Asia, 
                            promoting literacy and a love for reading.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">✨ Why Choose Us?</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Wide selection of books across all genres</li>
                    <li class="list-group-item">Competitive prices and regular discounts</li>
                    <li class="list-group-item">Fast and reliable delivery</li>
                    <li class="list-group-item">Easy returns and customer support</li>
                    <li class="list-group-item">Secure online payment</li>
                    <li class="list-group-item">Personalized recommendations</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
