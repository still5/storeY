@extends('layouts.app-new')

@section('content')
    <div class="page-content-container">
        <a href="/">&lt;&lt;&lt;Go back</a>
        <h3 class="card-title">Edit order</h3>
        <p class="card-title">Order ID: {{ $data['order']->id }}</p>
        <form enctype="multipart/form-data" method="POST">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="form-group-row">
                <span>Product: </span>
                <span><b>{{$data['product']->name}}</b></span>
            </div>
            <div class="form-group-row">
                <span>Sum: ₴{{$data['product']->price}}</span>
            </div>
            <div class="form-group-row">
                <label for="phone">Name</label>
                <input type="text" title="Name" id="name" value="{{$data['order']->user_name}}" readonly name="name">
            </div>

            <div class="form-group-row">
                <label for="email">Email</label>
                <input type="text" title="Email" id="email" value="{{$data['order']->user_email}}" name="email" pattern="^[іІїЇґА-я\w-\.]+@([іІїЇґА-я\w-]+\.)+[іІїЇґА-я\w-]{2,15}$" minlength="5" @if(Auth::user()->id != $data['order']->user_id) readonly @endif>
            </div>
            <div class="form-group-row">
                <label for="phone">Phone:</label>
                <span for="phone" class="text-color-light-grey">+380</span>
                <input type="tel" title="Telephone" id="phone" name="phone" value="{{$data['order']->user_phone}}" pattern="[0-9]{9}" minlength="9" maxlength="9" placeholder="501234567" required class="input-tel" @if(Auth::user()->id != $data['order']->user_id) readonly @endif>
            </div>
            <div class="form-group-row">
                <p>Customer's comment:</p>
                <textarea rows="4" type="edit" id="customer_comment" name="customer_comment" title="Comment" @if(Auth::user()->id != $data['order']->user_id) readonly @endif>{{$data['order']->customer_comment}}</textarea>
            </div>
            @if(Auth::user()->is_admin)
            <div class="form-group-row">
                <p>Comment:</p>
                <textarea rows="4" type="edit" id="comment" name="comment" title="Comment">{{$data['order']->comment}}</textarea>
            </div>
            @endif
            <div class="form-group-row">
                <label for="status">Status:</label>
                @if(!Auth::user()->is_admin)
                    <span><b>{{$data['order']->status}}</b></span>
                @else
                    <select name="status">
                        @foreach(App\Enums\OrderStatusEnum::values() as $key=>$value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
            <br><br><button type="submit" class="submit-order-btn">Submit</button>
            <input type="hidden" title="Price" id="product_id" name="product_id" value="{{ $data['product']->id }}">
            <input type="hidden" title="Price" id="id" name="id" value="{{ $data['order']->id }}">
            <input type="hidden" title="Price" id="price" name="price" value="{{ $data['product']->price }}">
            @if(!Auth::user()->is_admin)
                <input type="hidden" title="Status" id="status" name="status" value="{{ $data['order']->status }}">
            @endif

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

