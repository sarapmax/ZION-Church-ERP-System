@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="element-wrapper">
            <h5 class="element-header">
                เพิ่มคริสจักร
            </h5>
            <div class="element-box">
                <form action="{{ route('membership.church.store') }}" method="POST">
                    @csrf

                    @include('components.selection.geolocation', [
                        'name' => [],
                        'old' => [
                            'province_id' => old('province_id'),
                            'district_id' => old('district_id')
                        ],
                        'excepts' => ['subDistrict']
                    ])

                    <div class="form-group">
                        <label for="name">ชื่อคริสตจักร </label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ old('name') }}">

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="submit_type" value="{{ \App\Enums\SubmissionTypeEnum::ADD }}"><i class="fas fa-check"></i> บันทึก</button>
                        <button type="submit" class="btn btn-primary" name="submit_type" value="{{ \App\Enums\SubmissionTypeEnum::ADD_AND_ADD_ANOTHER }}"><i class="fas fa-check-double"></i> บันทึก & บันทึกอันต่อไป</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
