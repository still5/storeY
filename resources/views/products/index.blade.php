@extends('layouts.app-new')

@section('content')
    <div class="page-content-container">
            @foreach ($products as $product)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="product-image-container">
                                @if(isset($product->image_name))
                                    <img src="{{ asset("storage/img/Products/$product->image_name") }}" alt="product-image-{{$product->id}}">
                                @else
                                    <img src="{{ asset("/img/default-travolta-confused.png") }}" alt="product-image-{{$product->id}}">
                                @endif
                            </div>
                            <h4 class="card-title">{{ $product->name }}</h4>
                            @if(isset($product->discount_price))
                                <span class="card-text">Price: </span>
                                <span class="card-text old-price">{{ $product->price }} ₴</span>
                                <span class="card-text new-price"> {{ $product->discount_price }} ₴</span>
                            @else
                                <span class="card-text" >Price: {{ $product->price }} ₴</span>
                            @endif
                            <p class="card-text">Description: {{ $product->description_short }}</p>
                            <!-- Add more fields here as needed -->
                            <a href="/product/{{ $product->id }}" class="btn btn-primary">
                                <button class="open-product-btn">
                                    View Product
                                </button>
                            </a>
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
                                        <form action="{{ route('product.delete', ['productId' => $product->id]) }}" method="POST"
                                            class="products-delete-form-container"
                                              onclick="return confirm('Are you sure you want to archive product?');"
                                            id="product-delete" name="product-delete">
                                            @csrf
                                            @method('POST')
                                                <a href="/product/delete/{{ $product->id }}" class="btn btn-primary">
                                                    <button type="submit" class="delete-product-btn ml-40">
                                                        Delete Product
                                                    </button>
                                                </a>
                                        </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        <div class="pagination justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection
