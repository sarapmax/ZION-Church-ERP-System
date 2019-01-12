@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="element-wrapper">
            <h6 class="element-header">
                คริสตจักร
            </h6>
            <div class="element-box">
                <div class="controls-above-table">
                    <div class="row">
                        <div class="col-sm-6">

                        </div>
                        <div class="col-sm-6">
                            <div class="form-inline justify-content-sm-end">
                                <a href="{{ route('member.church.create') }}" class="btn btn-primary">เพิ่มคริสตจักร</a>
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
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($churches as $church)
                        <tr>
                            <td>{{ $church->id }}</td>
                            <td>{{ $church->district->province->name }}</td>
                            <td>{{ $church->district->name }}</td>
                            <td>{{ $church->name }}</td>
                            <td>
                                <a href="{{ route('member.church.edit', $church) }}"><i class="far fa-edit"></i></a>

                                <a href="javascript:void(0);" onclick="$(this).find('form').submit();" >
                                    <i class="far fa-trash-alt"></i>
                                    <form action="{{ route('member.church.destroy', $church) }}" method="POST" onsubmit="return confirm('Are you sure to delete this?')">
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
