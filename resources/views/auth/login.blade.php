<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>ZION SYSTEM</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="h-100">
    <div class="row h-100 justify-content-center align-items-center with-pattern">
        <div class="auth-box-w">
            <div class="logo-w">
                <img alt="" src="{{ asset('images/logo-big.png') }}">
                <h3 class="mt-4">ZION SYSTEM</h3>
            </div>
            <h4 class="auth-header">
                Welcome Back!
            </h4>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                @include('layouts.flash-message')
                <div class="form-group">
                    <label for="code">รหัสสมาชิก</label>
                    <input id="code" type="number" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}" required autofocus>
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>

                    @if ($errors->has('code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">รหัสผ่าน</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    <div class="pre-icon os-icon os-icon-fingerprint"></div>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> จำฉันในครั้งต่อไป
                </div>
                <div class="buttons-w">
                    <button class="btn btn-primary">เข้าสู่ระบบ</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
