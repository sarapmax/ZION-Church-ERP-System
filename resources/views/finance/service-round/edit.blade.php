@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('showServiceRound', $serviceRound) }}
@endsection

@section('content')
    <div class="header mt-3">
        <div class="header-body">
            <h1 class="header-title">แก้ไขรอบนมัสการ</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('finance.service-round.update', $serviceRound) }}" method="POST">
                        @csrf

                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label for="date">วันที่ </label>
                            <input id="date"
                                   type="date"
                                   class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                   name="date" value="{{ old('date', defaultDateFormat($serviceRound->date)) }}">

                            @if ($errors->has('date'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="financial_witnesses">พยานช่วยนับเงิน </label>
                            <textarea id="financial_witnesses"
                                      name="financial_witnesses"
                                      class="form-control{{ $errors->has('financial_witnesses') ? ' is-invalid' : '' }}"
                                      rows="2">{{ old('financial_witnesses', $serviceRound->financial_witnesses) }}
                            </textarea>

                            @if ($errors->has('financial_witnesses'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('financial_witnesses') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
