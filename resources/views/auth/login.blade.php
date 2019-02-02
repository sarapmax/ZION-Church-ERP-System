<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>ZION SYSTEM</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="d-flex align-items-center bg-auth border-top border-top-2 border-primary">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-md-5 col-lg-6 col-xl-4 px-lg-6 my-5">
                <h1 class="display-4 text-center mb-3">ยินดีต้อนรับกลับมา!</h1>
                <p class="text-muted text-center mb-5">เข้าสู่ระบบ</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @include('layouts.flash-message')

                    <div class="form-group">
                        <label for="code">รหัสสมาชิก</label>
                        <input type="number"
                               id="code"
                               class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                               name="code" value="{{ old('code') }}"
                               placeholder="กรอบรหัสผ่าน"
                               required
                               autofocus>

                        @if ($errors->has('code'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="password">รหัสผ่าน</label>
                            </div>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password"
                                   id="password"
                                   class="form-control form-control-appended{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   placeholder="กรอบรหัสผ่าน"
                                   name="password"
                                   required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fe fe-eye"></i>
                                </span>
                            </div>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="checkbox"
                               name="remember"
                               id="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        จำฉันในครั้งต่อไป
                    </div>

                    <button class="btn btn-lg btn-block btn-primary mb-3">
                        <i class="fe fe-log-in"></i> เข้าสู่ระบบ
                    </button>
                </form>
            </div>
            <div class="col-12 col-md-7 col-lg-6 col-xl-8 d-none d-lg-block">
                <div class="bg-cover vh-100 mt-n1 mr-n3" style="background-image: url({{ asset('images/auth-side-cover.jpg') }});"></div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
