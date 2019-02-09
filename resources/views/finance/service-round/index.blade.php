@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('serviceRound') }}
@endsection

@section('content')
    <div class="header">
        <div class="header-body">
            <div class="row align-items-end">
                <div class="col"><h1 class="header-title">{{ __('global.service_round') }}</h1></div>
                <div class="col-auto">
                    <a href="{{ route('finance.service-round.create') }}" class="btn btn-primary">{{ __('global.create_service_round') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive mb-0">
                    <table class="table table-nowrap card-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>วันที่</th>
                            <th>ลำดับของสัปดาห์/ปี</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($serviceRounds as $serviceRound)
                            <tr>
                                <td>{{ $serviceRound->id }}</td>
                                <td>{{ defaultDateFormat($serviceRound->date) }}</td>
                                <td>{{ $serviceRound->weekOfYear }}</td>
                                <td class="link-action">
                                    <a href="{{ route('finance.service-round.show', $serviceRound) }}"><i class="fe fe-eye"></i></a>
                                    <a href="{{ route('finance.service-round.edit', $serviceRound) }}"><i class="fe fe-edit"></i></a>

                                    @include('components.actions.delete', [
                                        'type' => 'link',
                                        'route' => route('finance.service-round.destroy', $serviceRound)
                                    ])
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No matching records found!.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{ $serviceRounds->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
