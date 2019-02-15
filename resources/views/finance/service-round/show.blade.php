@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('showServiceRound', $serviceRound) }}
@endsection

@section('content')
    <div class="header">
        <div class="header-body">
            <div class="row align-items-end">
                <div class="col"><h1 class="header-title">ข้อมูลรอบนมัสการ {{ defaultDateFormat($serviceRound->date) }}</h1></div>
                <div class="col-auto">
                    @include('components.actions.delete', [
                            'type' => 'button',
                            'route' => route('finance.service-round.destroy', $serviceRound)
                        ])
                    <a href="{{ route('finance.service-round.edit', $serviceRound) }}" class="btn btn-primary"><i class="fe fe-edit"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-sm-3 py-3"><span class="text-muted">วันที่</span></div>
                        <div class="col-sm-9 py-3">{{ defaultDateFormat($serviceRound->date) }}</div>
                    </div>
                    <div class="row border-bottom">
                        <div class="col-sm-3 py-3"><span class="text-muted">ลำดับของสัปดาห์/ปี</span></div>
                        <div class="col-sm-9 py-3">{{ $serviceRound->weekOfYear }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 py-3"><span class="text-muted">พยานช่วยนับเงิน</span></div>
                        <div class="col-sm-9 py-3">{{ $serviceRound->financial_witnesses }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="header-body">
            <div class="row align-items-end">
                <div class="col"><h1 class="header-title">ข้อมูลเงินถวาย</h1></div>
                <div class="col-auto">
                    <a href="{{ route('finance.offering.index', ['service_round_date' => defaultDateFormat($serviceRound->date)]) }}" class="btn btn-primary"> บันทึกเงินถวาย</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($churchBankAccounts as $churchBankAccount)
        <div class="col-md-4 col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title text-uppercase text-muted mb-2">
                                {{ __('church-bank-account.' . $churchBankAccount['name']) }}
                            </h4>
                            <span class="h2 mb-0">฿{{ number_format($churchBankAccount['total_offering_amount']) }}</span>
                        </div>
                        <div class="col-auto">
                            <span class="h2 fe fe-{{ __('church-bank-account.' . $churchBankAccount['name'] .  '_ICON') }} text-muted mb-0"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('finance.partials.offering-listing', [
                'offeringRecords' => $offeringRecords,
                'pagination' => true
            ])
        </div>
    </div>
@endsection
