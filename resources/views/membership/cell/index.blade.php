@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <div class="element-actions">
                    <a href="{{ route('membership.cell.create') }}" class="btn btn-primary">เพิ่มกลุ่มแคร์</a>
                </div>
                <h5 class="element-header">
                    กลุ่มแคร์
                </h5>
                <div class="element-box">
                    <div class="controls-above-table">
                        <div class="row">
                            <div class="col-sm-6">

                            </div>
                            <div class="col-sm-6">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-lightborder">
                            <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>จังหวัด</th>
                                <th>อำเภอ</th>
                                <th>คริสตจักร</th>
                                <th class="text-primary">กลุ่มแคร์</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cells as $cell)
                                <tr>
                                    <td>{{ $cell->id }}</td>
                                    <td>{{ $cell->church->district->province->name }}</td>
                                    <td>{{ $cell->church->district->name }}</td>
                                    <td>{{ $cell->church->name }}</td>
                                    <td class="text-primary font-weight-bold">{{ $cell->name }}</td>
                                    <td class="link-action">
                                        <a href="{{ route('membership.cell.edit', $cell) }}"><i class="far fa-edit"></i></a>

                                        @include('components.actions.delete', [
                                            'type' => 'link',
                                            'route' => route('membership.cell.destroy', $cell)
                                        ])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $cells->appends($_GET)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
