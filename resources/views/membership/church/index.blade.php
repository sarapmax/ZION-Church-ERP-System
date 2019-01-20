@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="element-wrapper">
            <div class="element-actions">
                <a href="{{ route('membership.church.create') }}" class="btn btn-primary">เพิ่มคริสตจักร</a>
            </div>
            <h5 class="element-header">
                คริสตจักร
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
                                <a href="{{ route('membership.church.edit', $church) }}"><i class="far fa-edit"></i></a>

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
</div>
@endsection
