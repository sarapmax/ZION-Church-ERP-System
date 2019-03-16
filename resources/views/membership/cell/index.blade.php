@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render('cell') }}
@endsection

@section('content')
<div class="header">
    <div class="header-body">
        <div class="row align-items-end">
            <div class="col"><h1 class="header-title">กลุ่มแคร์</h1></div>
            <div class="col-auto">
                <a href="{{ route('membership.cell.create') }}" class="btn btn-primary">เพิ่มกลุ่มแคร์</a>
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
                        <th>หน่วย</th>
                        <th class="text-primary">กลุ่มแคร์</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($cells as $cell)
                        <tr>
                            <td>{{ $cell->id }}</td>
                            <td>{{ $cell->area->church->district->province->name }}</td>
                            <td>{{ $cell->area->church->district->name }}</td>
                            <td>{{ $cell->area->church->name }}</td>
                            <td>{{ $cell->area->name }}</td>
                            <td class="text-primary font-weight-bold">{{ $cell->name }}</td>
                            <td class="link-action">
                                <a href="{{ route('membership.cell.edit', $cell) }}"><i class="fe fe-edit"></i></a>

                                @include('components.actions.delete', [
                                    'type' => 'link',
                                    'route' => route('membership.cell.destroy', $cell)
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

                {{ $cells->appends($_GET)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
