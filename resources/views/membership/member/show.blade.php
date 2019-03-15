@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('showMember', $member->cell->area->church, $member->cell->area, $member->cell, $member) }}
@endsection

@section('content')
<div class="header">
    <div class="header-body">
        <div class="row align-items-end">
            <div class="col"><h1 class="header-title">ข้อมูลสมาชิกรหัส {{ $member->code }}</h1></div>
            <div class="col-auto">
                @include('components.actions.delete', [
                        'type' => 'button',
                        'route' => route('membership.member.destroy', $member)
                    ])
                <a href="{{ route('membership.member.edit', $member) }}" class="btn btn-primary"><i class="fe fe-edit"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-header-title">ข้อมูลคริสตจักร</h2>
            </div>
            <div class="card-body">
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">ภูมิภาค</span></div>
                    <div class="col-sm-9 py-3">{{ $member->cell->area->church->district->province->region->name }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">จังหวัด</span></div>
                    <div class="col-sm-9 py-3">{{ $member->cell->area->church->district->province->name }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">อำเภอ/เขต</span></div>
                    <div class="col-sm-9 py-3">{{ $member->cell->area->church->district->name }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">คริสตจักร</span></div>
                    <div class="col-sm-9 py-3">{{ $member->cell->area->church->name }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">เขต</span></div>
                    <div class="col-sm-9 py-3">{{ $member->cell->area->name }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">กลุ่มแคร์</span></div>
                    <div class="col-sm-9 py-3">{{ $member->cell->name }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-3 py-3"><span class="text-muted">สถานะฝ่ายจิตวิญญาณ</span></div>
                    <div class="col-sm-9 py-3">{{ __('spiritual-status.' . SpiritualStatus::getKey($member->spiritual_status)) }}</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-header-title">ข้อมูลส่วนตัว</h2>
            </div>
            <div class="card-body">
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">รูปโปรไฟล์</span></div>
                    <div class="col-sm-9 py-3">
                        <img src="{{ $member->profile_image_path }}"
                             width="150px" alt="{{ $member->fullname }}"
                             class="img-thumbnail">
                    </div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">ชื่อ</span></div>
                    <div class="col-sm-9 py-3">{{ $member->fullname }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">ชื่อเล่น</span></div>
                    <div class="col-sm-9 py-3">{{ $member->nickname }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">เพศ</span></div>
                    <div class="col-sm-9 py-3">{{ $member->gender }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">วันเกิด</span></div>
                    <div class="col-sm-9 py-3">
                        {{ defaultDateFormat($member->birthday) }}
                        @if ($member->birthday) (อายุ {{ $member->age }} ปี) @endif
                    </div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">เลขบัตรประจำตัวประชาชน</span></div>
                    <div class="col-sm-9 py-3">{{ $member->idcard }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">เชื้อชาติ / สัญชาติ</span></div>
                    <div class="col-sm-9 py-3">{{ $member->race }} / {{ $member->nationality }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">เพิ่มเข้าระบบเมื่อ</span></div>
                    <div class="col-sm-9 py-3">{{ defaultDateFormat($member->created_at) }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-3 py-3"><span class="text-muted">แก้ไขล่าสุดเมื่อ</span></div>
                    <div class="col-sm-9 py-3">{{ defaultDateFormat($member->updated_at) }}</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-header-title">ข้อมูลการติดต่อ</h2>
            </div>
            <div class="card-body">
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">Email</span></div>
                    <div class="col-sm-9 py-3">{{ $member->email }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">เบอร์โทรศัพท์มือถือ</span></div>
                    <div class="col-sm-9 py-3">{{ $member->mobile_number }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">Facebook</span></div>
                    <div class="col-sm-9 py-3">{{ $member->facebook }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-3 py-3"><span class="text-muted">Line</span></div>
                    <div class="col-sm-9 py-3">{{ $member->line }}</div>
                </div>
            </div>
        </div>

        @foreach($member->addresses as $address)
            @if($address->type == AddressType::CURRENT)
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-header-title">ที่อยู่ปัจจุบัน</h2>
                    </div>
                    <div class="card-body">
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">จังหวัด</span></div>
                            <div class="col-sm-9 py-3">{{ $address->subDistrict->district->province->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">อำเภอ/เขต</span></div>
                            <div class="col-sm-9 py-3">{{ $address->subDistrict->district->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">ตำบล/แขวง</span></div>
                            <div class="col-sm-9 py-3">{{ $address->subDistrict->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">รหัสไปรษณีย์</span></div>
                            <div class="col-sm-9 py-3">{{ $address->postcode }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 py-3"><span class="text-muted">รายละเอียด</span></div>
                            <div class="col-sm-9 py-3">{{ $address->detail }}</div>
                        </div>
                    </div>
                </div>
            @endif
            @if($address->type == AddressType::ORIGINAL)
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-header-title">ที่อยู่ตามทะเบียนบ้าน</h2>
                    </div>
                    <div class="card-body">
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">จังหวัด</span></div>
                            <div class="col-sm-9 py-3">{{ $address->subDistrict->district->province->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">อำเภอ/เขต</span></div>
                            <div class="col-sm-9 py-3">{{ $address->subDistrict->district->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">ตำบล/แขวง</span></div>
                            <div class="col-sm-9 py-3">{{ $address->subDistrict->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">รหัสไปรษณีย์</span></div>
                            <div class="col-sm-9 py-3">{{ $address->postcode }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 py-3"><span class="text-muted">รายละเอียด</span></div>
                            <div class="col-sm-9 py-3">{{ $address->detail }}</div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <div class="card">
            <div class="card-header">
                <h2 class="card-header-title">สถานภาพ</h2>
            </div>
            <div class="card-body">
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">สถานะ</span></div>
                    <div class="col-sm-9 py-3">{{ __('mariage-status.' . MariageStatus::getKey($member->mariage->status)) }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">ชื่อคู่สมรส</span></div>
                    <div class="col-sm-9 py-3">{{ $member->mariage->spouse_name }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">ชื่อเล่นคู่สมรส</span></div>
                    <div class="col-sm-9 py-3">{{ $member->mariage->spouse_nickname }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">วันเกิดคู่สมรส</span></div>
                    <div class="col-sm-9 py-3">
                        {{ defaultDateFormat($member->mariage->spouse_birthday) }}
                        @if ($member->mariage->spouse_birthday) (อายุ {{ $member->mariage->age }} ปี) @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 py-3"><span class="text-muted">เป็นคริสเตียน</span></div>
                    <div class="col-sm-9 py-3">
                        @if($member->mariage->spouse_christian)
                            <i class="fa fa-check text-primary"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-header-title">บุคคลที่สามารถติดต่อได้ในกรณีฉุกเฉิน</h2>
            </div>
            <div class="card-body">
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">ชื่อ</span></div>
                    <div class="col-sm-9 py-3">{{ $member->emergencyContact->name }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">ชื่อเล่น</span></div>
                    <div class="col-sm-9 py-3">{{ $member->emergencyContact->nickname }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">อายุ</span></div>
                    <div class="col-sm-9 py-3">{{ $member->emergencyContact->age }} ปี</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">ความสัมพันธ์</span></div>
                    <div class="col-sm-9 py-3">{{ $member->emergencyContact->relationship }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">เบอร์โทรศัพท์มือถือ</span></div>
                    <div class="col-sm-9 py-3">{{ $member->emergencyContact->mobile_number }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">จังหวัด</span></div>
                    <div class="col-sm-9 py-3">{{ $member->emergencyContact->address->subDistrict->district->province->name }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">อำเภอ/เขต</span></div>
                    <div class="col-sm-9 py-3">{{ $member->emergencyContact->address->subDistrict->district->name }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">ตำบล/แขวง</span></div>
                    <div class="col-sm-9 py-3">{{ $member->emergencyContact->address->subDistrict->name }}</div>
                </div>
                <div class="row border-bottom">
                    <div class="col-sm-3 py-3"><span class="text-muted">รหัสไปรษณีย์</span></div>
                    <div class="col-sm-9 py-3">{{ $member->emergencyContact->address->postcode }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-3 py-3"><span class="text-muted">รายละเอียด</span></div>
                    <div class="col-sm-9 py-3">{{ $member->emergencyContact->address->detail }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
