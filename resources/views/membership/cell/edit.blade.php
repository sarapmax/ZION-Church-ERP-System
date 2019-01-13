@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <h5 class="element-header">
                    แก้ไขกลุ่มแคร์
                </h5>
                <div class="element-box">
                    <form action="{{ route('membership.cell.update', $cell) }}" method="POST">
                        @csrf

                        {{ method_field('PUT') }}

                        @include('components.geolocation', [
                            'old' => setGeolocationOldData(
                                $cell->church->district->province->region->id,
                                $cell->church->district->province->id,
                                $cell->church->district->id,
                                $cell->church_id
                                ),
                            'excepts' => []
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
