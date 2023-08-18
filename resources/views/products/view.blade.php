@extends('layouts.app-new')

@section('content')
    <div class="page-content-container">
        <a href="{{ url()->previous() }}">&lt;&lt;&lt;Go back</a>
        <p class="card-text">Product ID: {{ $product->id }}</p>
        <div class="product-image-container">
            <img src="{{ asset("/img/Products/$product->id.jpg") }}" alt="product-image-{{$product->id}}">
        </div>
        <h4 class="card-title">{{ $product->name }}</h4>
        <div>
            @if(isset($product->discount_price))
                <span class="card-text">Price: </span>
                <span class="card-text old-price">{{ $product->price }} ₴</span>
                <span class="card-text new-price"> {{ $product->discount_price }} ₴</span>
            @else
                <span class="card-text" >Price: {{ $product->price }} ₴</span>
            @endif
        </div>
        <p class="card-text">Full description: {{ $product->description_full }}</p>
        <a href="/order?product={{ $product->id }}" class="btn btn-primary">
            <button class="order-product-btn">
                Make Order
            </button>
        </a>
        @auth
            @if(Auth::user()->is_admin)
                <a href="/product/edit/{{ $product->id }}" class="btn btn-primary">
                    <button class="open-product-btn ml-40">
                        Edit Product
                    </button>
                </a>
            @endif
        @endauth
    </div>
@endsection
