@extends('layouts.app-new')

@section('content')
    <div class="page-content-container">
        <a href="/">&lt;&lt;&lt;Go back</a>
        <h3 class="card-title">Create product</h3>
        <form enctype="multipart/form-data" method="POST">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="form-group-row">
                <label for="name">Name</label>
                <input type="text" title="Name" id="name" value="" required minlength="2" name="name">
            </div>
            <div class="form-group-row">
                <label for="price">Price</label>
                <input type="text" title="Price" id="price" value="" minlength="1" required name="price">
            </div>
            <div class="form-group-row">
                <label for="phone">Discount price</label>
                <input type="text" title="discount_price" id="discount_price" value="" name="discount_price">
            </div>
            <div class="form-group-row">
                <label for="file">Product image</label>
                <input
                    type="file"
                    id="file"
                    name="file"
                    accept="image/png, image/jpeg, image/webp, image/jpg" />
            </div>

            <div class="form-group-row">
                <p>Short description:</p>
                <textarea rows="4" type="edit" id="description_short" name="description_short" required minlength="1" title="description_short" ></textarea>
            </div>
            <div class="form-group-row">
                <p>Full description:</p>
                <textarea rows="4" type="edit" id="description_full" name="description_full" title="description_full" ></textarea>
            </div>
            <div class="form-group-row">
                <p>Specifications (json):</p>
                <textarea rows="4" type="edit" id="specifications" name="specifications" title="specification" ></textarea>
            </div>
            <div class="form-group-row">
                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                />
                <label for="is_active">Active</label>
            </div>

            <br><br><button type="submit" class="submit-order-btn">Submit</button>
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

