@extends('layouts.app-new')

@section('content')
    <div class="page-content-container">
        <a href="/">&lt;&lt;&lt;Go back</a>
        <h3 class="card-title">Order a product</h3>
        <h4 class="card-title">{{ $product->name }}</h4>
        <form enctype="multipart/form-data" method="POST">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="form-group-row">
                <label for="phone">Name</label>
                <input type="text" title="Name" id="name" name="name" pattern="[a-zA-Z\'а-яіІґҐА-Я ]{2,9}" minlength="2" autofocus required>
            </div>
            <div class="form-group-row">
                <label for="email">Email</label>
                <input type="text" title="Email" id="email" name="email" pattern="^[іІїЇґА-я\w-\.]+@([іІїЇґА-я\w-]+\.)+[іІїЇґА-я\w-]{2,15}$" minlength="5">
            </div>
            <div class="form-group-row">
                <label for="phone">Phone:</label>
                <span for="phone" class="text-color-light-grey">+380</span>
                <input type="tel" title="Telephone" id="phone" name="phone" pattern="[0-9]{9}" minlength="9" maxlength="9" placeholder="501234567" required class="input-tel">
            </div>
            <div class="form-group-row">
                <p>Comment:</p>
                <textarea type="edit" id="customer_comment" name="customer_comment" rows="4" title="Comment"></textarea>
            </div>
            <br><br><button type="submit" class="submit-order-btn">Submit</button>
            <input type="hidden" title="Price" id="product_id" name="product_id" value="{{ $product->id }}">
            <input type="hidden" title="Price" id="price" name="price" value="{{ $product->discount_price ?? $product->price }}">
            @auth
                <input type="hidden" title="UserId" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
            @endauth

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
