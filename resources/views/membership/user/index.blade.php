@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <h5 class="element-header">
                    ข้อมูลสมาชิก
                </h5>
                <div class="element-box">
                    <div class="controls-above-table">
                        <div class="row">
                            <div class="col-sm-6">

                            </div>
                            <div class="col-sm-6">
                                <div class="form-inline justify-content-sm-end">
                                    <a href="{{ route('membership.user.create') }}" class="btn btn-primary">เพิ่มข้อมูลสมาชิก</a>
                                </div>

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
                                    <td>{{ __('spiritual-status.' . $user->spiritual_status) }}</td>
                                    <td>{{ $user->fullname }}</td>
                                    <td class="link-action">
                                        <a href=""><i class="far fa-eye"></i></a>
                                        <a href="{{ route('membership.user.edit', $user) }}"><i class="far fa-edit"></i></a>

                                        <a href="javascript:void(0);" onclick="$(this).find('form').submit();" >
                                            <i class="far fa-trash-alt"></i>
                                            <form action="{{ route('membership.user.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure to delete this?')">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </a>
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
