@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('createCell') }}
@endsection

@section('content')
<div class="header mt-3">
    <div class="header-body">
        <h1 class="header-title">เพิ่มกลุ่มแคร์</h1>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('membership.cell.store') }}" method="POST">
                    @csrf

                    @include('components.selections.church-structure', [
                        'old' => [
                            'province_id' => old('province_id'),
                            'district_id' => old('district_id'),
                            'church_id' => old('church_id'),
                            'area_id' => old('area_id'),
                        ],
                        'excepts' => ['cell', 'shepard']
                    ])

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
                        <button type="submit" class="btn btn-primary" name="submit_type" value="{{ SubmissionType::ADD }}"><i class="fas fa-check"></i> บันทึก</button>
                        <button type="submit" class="btn btn-primary" name="submit_type" value="{{ SubmissionType::ADD_AND_ADD_ANOTHER }}"><i class="fas fa-check-double"></i> บันทึก & บันทึกอันต่อไป</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
