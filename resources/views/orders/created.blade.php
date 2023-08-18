@extends('layouts.app-new')

@section('content')
    <div class="container">
            <a href="/">&lt;&lt;&lt;Main page</a>
            <h4 class="card-title">Thank you! Your order has been successfully saved.</h4>
            @if(session('orderId'))
{{--                <p>New entry ID: {{ session('entry_id') }}</p>--}}
                <h3 class="card-title">Order ID: {{ session('orderId') }}</h3>
            @endif
    </div>
@endsection
