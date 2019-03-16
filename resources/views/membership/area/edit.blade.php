@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('showArea', $area->church, $area) }}
@endsection

@section('content')
<div class="header mt-3">
    <div class="header-body">
        <h1 class="header-title">แก้ไขเขต {{ $area->name }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('membership.area.update', $area) }}" method="POST">
                    @csrf

                    {{ method_field('PUT') }}

                    @include('components.selections.church-structure', [
                        'old' => [
                            'province_id' => old('province_id', $area->church->district->province->id),
                            'district_id' => old('district_id', $area->church->district->id),
                            'church_id' => old('church_id', $area->church_id),
                        ],
                        'excepts' => ['area', 'cell', 'shepard']
                    ])

                    <div class="form-group">
                        <label for="name">ชื่อเขต </label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ old('name', $area->name) }}">

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
