@extends('layouts.app-new')

@section('content')
    <div class="page-content-container">
        <a href="/">&lt;&lt;&lt;Go back</a>
        <h3 class="card-title">Edit product</h3>
        <form enctype="multipart/form-data" method="POST">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="form-group-row">
                <label for="name">Name</label>
                <input type="text" title="Name" id="name" value="{{$product->name}}" minlength="2" name="name">
            </div>
            <div class="form-group-row">
                <label for="price">Price</label>
                <input type="text" title="Price" id="price" value="{{$product->price}}" minlength="1" name="price">
            </div>
            <div class="form-group-row">
                <label for="phone">Discount price</label>
                <input type="text" title="discount_price" id="discount_price" value="{{$product->discount_price}}" name="discount_price">
            </div>

            <div class="form-group-row">
                <p>Short description:</p>
                <textarea rows="4" type="edit" id="description_short" name="description_short" minlength="1" title="description_short" >{{$product->description_short}}</textarea>
            </div>
            <div class="form-group-row">
                <p>Full description:</p>
                <textarea rows="4" type="edit" id="description_full" name="description_full" title="description_full" >{{$product->description_full}}</textarea>
            </div>
            <div class="form-group-row">
                <p>Specifications (json):</p>
                <textarea rows="4" type="edit" id="specifications" name="specifications" title="specification" >{{$product->specifications}}</textarea>
            </div>
            <div class="form-group-row">
                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                    @if($product->is_active) checked @endif
                />
                <label for="is_active">Active</label>
            </div>

            <br><br><button type="submit" class="submit-order-btn">Submit</button>
            <input type="hidden" title="ID" id="product_id" name="product_id" value="{{ $product->id }}">

            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </form>
    </div>
@endsection

