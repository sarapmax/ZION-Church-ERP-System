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
                <div class="card-header">
                    <h2 class="card-header-title">ข้อมูลรอบนมัสการ</h2>
                </div>
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-sm-3 py-3"><span class="text-muted">วันที่</span></div>
                        <div class="col-sm-9 py-3">{{ defaultDateFormat($serviceRound->date) }}</div>
                    </div>
                    <div class="row border-bottom">
                        <div class="col-sm-3 py-3"><span class="text-muted">ลำดับของสัปดาห์/ปี</span></div>
                        <div class="col-sm-9 py-3">{{ $serviceRound->weekOfYear }}</div>
                    </div>
                    <div class="row border-bottom">
                        <div class="col-sm-3 py-3"><span class="text-muted">พยานช่วยนับเงิน</span></div>
                        <div class="col-sm-9 py-3">{{ $serviceRound->financial_witnesses }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
