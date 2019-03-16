@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('showCell', $cell->area->church, $cell->area, $cell) }}
@endsection

@section('content')
<div class="header mt-3">
    <div class="header-body">
        <h1 class="header-title">แก้ไขกลุ่มแคร์ {{ $cell->name }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('membership.cell.update', $cell) }}" method="POST">
                    @csrf

                    {{ method_field('PUT') }}

                    @include('components.selections.church-structure', [
                        'old' => [
                            'province_id' => old('province_id', $cell->area->church->district->province->id),
                            'district_id' => old('district_id', $cell->area->church->district->id),
                            'church_id' => old('church_id', $cell->area->church->id),
                            'area_id' => old('area_id', $cell->area_id),
                        ],
                        'excepts' => ['cell', 'shepard']
                    ])

                    <div class="form-group">
                        <label for="name">ชื่อกลุ่มแคร์ </label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ old('name', $cell->name) }}">

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
