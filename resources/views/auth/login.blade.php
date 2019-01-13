<!DOCTYPE html>
<html>
<head>
    <title>ZION SYSTEM</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="auth-wrapper">
    <div class="all-wrapper menu-side with-pattern">
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

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="pre-icon os-icon os-icon-user-male-circle"></div>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
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
                <div class="buttons-w">
                    <button class="btn btn-primary">เข้าสู่ระบบ</button>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> จำฉันในครั้งต่อไป
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>