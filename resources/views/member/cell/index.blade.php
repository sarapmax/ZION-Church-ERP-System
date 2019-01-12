@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <h6 class="element-header">
                    กลุ่มแคร์
                </h6>
                <div class="element-box">
                    <div class="controls-above-table">
                        <div class="row">
                            <div class="col-sm-6">

                            </div>
                            <div class="col-sm-6">
                                <div class="form-inline justify-content-sm-end">
                                    <a href="{{ route('member.cell.create') }}" class="btn btn-primary">เพิ่มกลุ่มแคร์</a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-lightborder">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>จังหวัด</th>
                                <th>อำเภอ</th>
                                <th>คริสตจักร</th>
                                <th>กลุ่มแคร์</th>
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
                                    <td>{{ $cell->name }}</td>
                                    <td>
                                        <a href="{{ route('member.cell.edit', $cell) }}"><i class="far fa-edit"></i></a>

                                        <a href="javascript:void(0);" onclick="$(this).find('form').submit();" >
                                            <i class="far fa-trash-alt"></i>
                                            <form action="{{ route('member.cell.destroy', $cell) }}" method="POST" onsubmit="return confirm('Are you sure to delete this?')">
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
