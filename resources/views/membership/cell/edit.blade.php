@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('showCell', $cell->church, $cell) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <h5 class="element-header">
                    แก้ไขกลุ่มแคร์ {{ $cell->name }}
                </h5>
                <div class="element-box">
                    <form action="{{ route('membership.cell.update', $cell) }}" method="POST">
                        @csrf

                        {{ method_field('PUT') }}

                        @include('components.selections.church-structure', [
                            'old' => [
                                'province_id' => old('province_id', $cell->church->district->province->id),
                                'district_id' => old('district_id', $cell->church->district->id),
                                'church_id' => old('church_id', $cell->church_id),
                            ],
                            'excepts' => ['cell']
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
