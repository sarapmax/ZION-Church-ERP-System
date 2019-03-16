@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('member') }}
@endsection

@section('content')
<div class="header">
    <div class="header-body">
        <div class="row align-items-end">
            <div class="col"><h1 class="header-title">ข้อมูลสมาชิก</h1></div>
            <div class="col-auto">
                <a href="{{ route('membership.member.create') }}" class="btn btn-primary">เพิ่มข้อมูลสมาชิก</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <div class="ml-sm-auto">
                        <button type="button" class="btn btn-dark" data-toggle="modal"
                                data-target="#exampleModal">
                            <i class="fe fe-filter"></i> คัดกรองข้อมูลสมาชิก
                        </button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="card-header-title" id="exampleModalLabel">
                                            <i class="fe fe-filter"></i>
                                            คัดกรองข้อมูลสมาชิก
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="text" name="search_keyword" class="form-control"
                                                       placeholder="ค้นหา.. ชื่อ, นามสกุล, รหัสสมาชิก"
                                                       value="{{ app('request')->search_keyword }}">
                                            </div>
                                            @include('components.selections.church-structure', [
                                                'old' => [
                                                    'province_id' => app('request')->province_id,
                                                    'district_id' => app('request')->district_id,
                                                    'church_id' => app('request')->church_id,
                                                    'area_id' => app('request')->area_id,
                                                    'cell_id' => app('request')->cell_id,
                                                    'shepard_id' => app('request')->shepard_id
                                                ],
                                                'excepts' => []
                                            ])
                                            <div class="form-group">
                                                <label for="spiritual_status">สถานะผู้เชื่อ </label>
                                                <select id="spiritual_status" class="form-control"
                                                        name="spiritual_status">
                                                    <option value="">-- Select --</option>
                                                    @foreach(SpiritualStatus::toArray() as $key => $value)
                                                        <option value="{{ $value }}"
                                                                @if($value == app('request')->spiritual_status) selected @endif>{{ __('spiritual-status.' . $key) }}</option>
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
            </div>
            <div class="table-responsive mb-0">
                <table class="table table-nowrap card-table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>รหัสสมาชิก</th>
                        <th>ชื่อ</th>
                        <th>สถานะฝ่ายจิตวิญญาณ</th>
                        <th>คริสตจักร</th>
                        <th>หน่วย</th>
                        <th>แคร์</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($members as $member)
                        <tr>
                            <td>
                                <div class="avatar avatar-xs">
                                    <img src="{{ asset($member->profile_image_path) }}" alt="{{ $member->fullname }}" class="avatar-img rounded-circle">
                                </div>
                            </td>
                            <td>{{ $member->code }}</td>
                            <td>{{ $member->fullname }}</td>
                            <td>{{ __('spiritual-status.' . SpiritualStatus::getKey($member->spiritual_status)) }}</td>
                            <td>{{ $member->cell->area->church->name }}</td>
                            <td>{{ $member->cell->area->name }}</td>
                            <td>{{ $member->cell->name }}</td>
                            <td class="link-action">
                                <a href="{{ route('membership.member.show', $member) }}"><i class="fe fe-eye"></i></a>
                                <a href="{{ route('membership.member.edit', $member) }}"><i class="fe fe-edit"></i></a>

                                @include('components.actions.delete', [
                                    'type' => 'link',
                                    'route' => route('membership.member.destroy', $member)
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

                {{ $members->appends($_GET)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
