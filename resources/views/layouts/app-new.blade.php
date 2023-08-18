<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('img/storey-favicon.png') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<body class="antialiased">

<main class="main">
    <x-common.header/>
{{--    @include('components.common.header')--}}
    {{--    <h2>{{ asset('css/app.css') }}</h2>--}}



    <div class="page-container">
        <div class="flex flex-col items-center" id="page-content-wrapper">

        @yield('content')

        <!-- Scripts -->

        @yield('scripts')

        </div>

        <x-common.footer/>
    </div>
</main>

</body>
</html>
