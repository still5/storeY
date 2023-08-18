@extends('layouts.app-new')

@section('content')
    <div class="page-content-container">
        <h4 class="card-title">Order No:{{ $data['order']->id }}</h4>
        <p class="card-text">Product: {{ $data['product']->name }}</p>
        <p class="card-text">Price: ₴{{ $data['order']->price }}</p>
        <p class="card-text">Description: {{ $data['order']->status }}</p>
        <!-- Add more fields here as needed -->
        <a href="/product/{{ $data['order']->product_id }}" class="btn btn-primary">
            <button class="open-product-btn">
                View Product
            </button>
        </a>
        @auth
            @if(Auth::user()->is_admin || (Auth::user()->id == $data['order']->user_id))
                <a href="/order/edit/{{ $data['order']->id }}" class="btn btn-primary">
                    <button class="open-product-btn ml-40">
                        Edit Order
                    </button>
                </a>
            <a href="{{ route('products.view', ['productId' => $data['product']->id]) }}" class="btn btn-primary">
                <button class="open-product-btn ml-40">
                    View Product
                </button>
            </a>
            @endif
        @endauth
    </div>
@endsection
