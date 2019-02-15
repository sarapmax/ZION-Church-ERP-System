@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('manageOfferingForm') }}
@endsection

@section('content')
    <div class="header">
        <div class="header-body">
            <div class="row align-items-end">
                <div class="col"><h1 class="header-title">{{ __('global.manage_offering') }}</h1></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('finance.offering.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="service_round">รอบนมัสการ </label>
                            <select id="service_round" name="service_round_id" class="form-control{{ $errors->has('service_round') ? ' is-invalid' : '' }}" required>
                                <option value="">-- Select --</option>
                                @foreach($serviceRounds as $serviceRound)
                                    <option value="{{ $serviceRound->id }}"
                                            @if(defaultDateFormat($serviceRound->date) == app('request')->service_round_date || old('service_round_id') == $serviceRound->id)
                                                selected
                                            @endif>
                                        {{ defaultDateFormat($serviceRound->date) }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('service_round'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('service_round') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="member_id">รหัสสมาชิก </label>
                            <input id="member_id" type="text"
                                   class="form-control{{ $errors->has('member_id') ? ' is-invalid' : '' }}"
                                   name="member_id" value="{{ old('member_id') }}" required>

                            @if ($errors->has('member_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('member_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="type">ประเภทเงินถวาย </label>
                            <select id="type" name="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
                                <option value="">-- Select --</option>
                                @foreach(OfferingType::toArray() as $key => $value)
                                    <option value="{{ $value }}" @if(old('type') == $value) selected @endif>{{ __('offering-type.' . $key) }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="amount">จำนวนเงินถวาย </label>
                            <input id="amount" type="text"
                                   class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                   name="amount" value="{{ old('amount') }}" required>

                            @if ($errors->has('amount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('amount') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="need_receipt" type="checkbox" name="need_receipt" value="1" @if(old('need_receipt') == 1) checked @endif>
                            <label for="need_receipt">ต้องการใบเสร็จ </label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @include('finance.partials.offering-listing', [
                'offeringRecords' => $offeringRecords,
                'pagination' => false
            ])
        </div>
    </div>
@endsection
