@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <div class="element-actions">
                    <a href="{{ route('membership.user.create') }}" class="btn btn-primary">เพิ่มข้อมูลสมาชิก</a>
                </div>
                <h5 class="element-header">
                    ข้อมูลสมาชิก
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
                                <th>รหัสสมาชิก</th>
                                <th>คริสตจักร</th>
                                <th>แคร์</th>
                                <th>สถานะฝ่ายจิตวิญญาณ</th>
                                <th>ชื่อ</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->code }}</td>
                                    <td>{{ $user->cell->church->name }}</td>
                                    <td>{{ $user->cell->name }}</td>
                                    <td>{{ __('spiritual-status.' . $user->spiritual_status_name) }}</td>
                                    <td>{{ $user->fullname }}</td>
                                    <td class="link-action">
                                        <a href="{{ route('membership.user.show', $user) }}"><i class="far fa-eye"></i></a>
                                        <a href="{{ route('membership.user.edit', $user) }}"><i class="far fa-edit"></i></a>

                                        @include('components.actions.delete', [
                                            'type' => 'link',
                                            'route' => route('membership.user.destroy', $user)
                                        ])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
