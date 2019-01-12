@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <h6 class="element-header">
                    เพิ่มกลุ่มแคร์
                </h6>
                <div class="element-box">
                    <form action="{{ route('member.cell.store') }}" method="POST">
                        @csrf

                        @include('components.geolocation', ['old' => setGeolocationOldData(), 'excepts' => []])

                        <div class="form-group">
                            <label for="name">ชื่อกลุ่มแคร์ </label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name" value="{{ old('name') }}">

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
