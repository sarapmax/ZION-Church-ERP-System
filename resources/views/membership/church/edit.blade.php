@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <h5 class="element-header">
                    แก้ไขคริสตจักร
                </h5>
                <div class="element-box">
                    <form action="{{ route('membership.church.update', $church) }}" method="POST">
                        @csrf

                        {{ method_field('PUT') }}

                        @include('components.geolocation', [
                            'old' => setGeolocationOldData(
                                $church->district->province->id,
                                $church->district->id
                                ),
                            'excepts' => ['church', 'cell']
                        ])

                        <div class="form-group">
                            <label for="name">ชื่อคริสตจักร </label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name" value="{{ old('name', $church->name) }}">

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
