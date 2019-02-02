@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('church') }}
@endsection

@section('content')
<div class="header">
    <div class="header-body">
        <div class="row align-items-end">
            <div class="col"><h1 class="header-title">คริสตจักร</h1></div>
            <div class="col-auto">
                <a href="{{ route('membership.church.create') }}" class="btn btn-primary">เพิ่มคริสตจักร</a>
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
                        <th>รหัส</th>
                        <th>จังหวัด</th>
                        <th>อำเภอ</th>
                        <th class="text-primary">คริสตจักร</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($churches as $church)
                        <tr>
                            <td>{{ $church->id }}</td>
                            <td>{{ $church->district->province->name }}</td>
                            <td>{{ $church->district->name }}</td>
                            <td class="text-primary font-weight-bold">{{ $church->name }}</td>
                            <td class="link-action">
                                <a href="{{ route('membership.church.edit', $church) }}"><i class="fe fe-edit"></i></a>

                                @include('components.actions.delete', [
                                    'type' => 'link',
                                    'route' => route('membership.church.destroy', $church)
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


                    {{ $churches->appends($_GET)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
