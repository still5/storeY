@extends('layouts.app')

@section('content')

<div class="page-content-container login-form">
{{--    <a href="javascript:window.history.go(-1);">&lt;&lt;Go back</a>--}}
    <!--        <form id="login-form" action="/5.2.php" method="POST">-->
    <form id="login-form" action="" method="POST">
        @csrf <!-- {{ csrf_field() }} -->
        <fieldset>
            <div class="form-group-row">
                <label for="username">Email</label>
                <input type="text" id="username" name="username"
{{--                       turned off to allow simple logins:--}}
{{--                       pattern="^[іІїЇґА-я\w-\.]+@([іІїЇґА-я\w-]+\.)+[іІїЇґА-я\w-]{2,15}$" --}}
                       required minlength="5" maxlength="32">
            </div>
            <div class="form-group-row">
                <label for="pwd">Password</label>
                <input type="password" id="pwd" name="pwd" required minlength="2" maxlength="64">
            </div>
            <div class="form-group-row">
{{--                <input type="submit" id="submitbutton" name="submitbutton">--}}
                <div><button type="button" class="login-btn" id="log-in">Login</button></div>
{{--                <input type="reset" id="resetbutton" name="resetb">--}}
            </div>
        </fieldset>
    </form>
</div>

@endsection
