@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <div class="element-actions">
                    <a href="{{ route('membership.member.create') }}" class="btn btn-primary">เพิ่มข้อมูลสมาชิก</a>
                </div>
                <h5 class="element-header">
                    ข้อมูลสมาชิก
                </h5>
                <div class="element-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary float-sm-right" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-filter"></i> คัดกรองข้อมูลสมาชิก
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-filter"></i> คัดกรองข้อมูลสมาชิก</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="text" name="search_keyword" class="form-control" placeholder="ค้นหา.. ชื่อ, นามสกุล, รหัสสมาชิก" value="{{ app('request')->search_keyword }}">
                                                </div>
                                                @include('components.selections.church-structure', [
                                                    'old' => [
                                                        'province_id' => app('request')->province_id,
                                                        'district_id' => app('request')->district_id,
                                                        'church_id' => app('request')->church_id,
                                                        'cell_id' => app('request')->cell_id
                                                    ],
                                                    'excepts' => []
                                                ])
                                                <div class="form-group">
                                                    <label for="spiritual_status">สถานะผู้เชื่อ </label>
                                                    <select id="spiritual_status" class="form-control" name="spiritual_status">
                                                        <option value="">-- Select --</option>
                                                        @foreach(SpiritualStatus::constants() as $key => $value)
                                                            <option value="{{ $value }}" @if($value == app('request')->spiritual_status) selected @endif>{{ __('spiritual-status.' . $key) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">ค้นหา</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-lightborder">
                            <thead>
                            <tr>
                                <th></th>
                                <th>รหัสสมาชิก</th>
                                <th>ชื่อ</th>
                                <th>สถานะฝ่ายจิตวิญญาณ</th>
                                <th>คริสตจักร</th>
                                <th>แคร์</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td>
                                        <div class="cell-image-list">
                                            <div class="cell-img" style="background-image: url({{ $member->profile_image_path }})"></div>
                                        </div>
                                    </td>
                                    <td>{{ $member->code }}</td>
                                    <td>{{ $member->fullname }}</td>
                                    <td>{{ __('spiritual-status.' . $member->spiritual_status_name) }}</td>
                                    <td>{{ $member->cell->church->name }}</td>
                                    <td>{{ $member->cell->name }}</td>
                                    <td class="link-action">
                                        <a href="{{ route('membership.member.show', $member) }}"><i class="far fa-eye"></i></a>
                                        <a href="{{ route('membership.member.edit', $member) }}"><i class="far fa-edit"></i></a>

                                        @include('components.actions.delete', [
                                            'type' => 'link',
                                            'route' => route('membership.member.destroy', $member)
                                        ])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $members->appends($_GET)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
