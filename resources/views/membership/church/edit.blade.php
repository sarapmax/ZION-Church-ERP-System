@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('showChurch', $church) }}
@endsection

@section('content')
<div class="header mt-3">
    <div class="header-body">
        <h1 class="header-title">แก้ไขคริสตจักร {{ $church->name }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('membership.church.update', $church) }}" method="POST">
                    @csrf

                    {{ method_field('PUT') }}

                    @include('components.selections.geolocation', [
                        'name' => [],
                        'old' => [
                            'province_id' => old('province_id', $church->district->province->id),
                            'district_id' => old('district_id', $church->district->id),
                        ],
                        'excepts' => ['subDistrict']
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
