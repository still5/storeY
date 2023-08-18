@extends('layouts.app-new')
{{--@props(['text'])--}}

@section('content')
    <div class="container">
            <a href="/">&lt;&lt;&lt;Go back</a>
            @isset($text)
                <h4 class="card-title">{{$text}}</h4>
            @endif
    </div>
@endsection
