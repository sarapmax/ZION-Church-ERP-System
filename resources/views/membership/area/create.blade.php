@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('createArea') }}
@endsection

@section('content')
<div class="header mt-3">
    <div class="header-body">
        <h1 class="header-title">เพิ่มหน่วย</h1>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('membership.area.store') }}" method="POST">
                    @csrf

                    @include('components.selections.church-structure', [
                        'old' => [
                            'province_id' => old('province_id'),
                            'district_id' => old('district_id'),
                            'church_id' => old('church_id'),
                        ],
                        'excepts' => ['area', 'cell', 'shepard']
                    ])

                    <div class="form-group">
                        <label for="name">ชื่อหน่วย </label>
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
