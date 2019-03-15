@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('area') }}
@endsection

@section('content')
<div class="header">
    <div class="header-body">
        <div class="row align-items-end">
            <div class="col"><h1 class="header-title">เขต</h1></div>
            <div class="col-auto">
                <a href="{{ route('membership.area.create') }}" class="btn btn-primary">เพิ่มเขต</a>
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
                        <th>คริสตจักร</th>
                        <th class="text-primary">เขต</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($areas as $area)
                        <tr>
                            <td>{{ $area->id }}</td>
                            <td>{{ $area->church->district->province->name }}</td>
                            <td>{{ $area->church->district->name }}</td>
                            <td>{{ $area->church->name }}</td>
                            <td class="text-primary font-weight-bold">{{ $area->name }}</td>
                            <td class="link-action">
                                <a href="{{ route('membership.area.edit', $area) }}"><i class="fe fe-edit"></i></a>

                                @include('components.actions.delete', [
                                    'type' => 'link',
                                    'route' => route('membership.area.destroy', $area)
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

                {{ $areas->appends($_GET)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
