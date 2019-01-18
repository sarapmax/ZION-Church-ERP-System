@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="element-wrapper">
                <div class="element-actions">
                    @include('components.actions.delete', [
                        'type' => 'button',
                        'route' => route('membership.user.destroy', $user)
                    ])
                    <a href="{{ route('membership.user.edit', $user) }}" class="btn btn-primary"><i class="far fa-edit"></i></a>
                </div>
                <h5 class="element-header">
                    ข้อมูลสมาชิกรหัส {{ $user->code }}
                </h5>
                <div class="element-box detail-view">
                    <h5 class="form-header">ข้อมูลคริสตจักร</h5>
                    <div class="element-box-content">
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">ภูมิภาค</span></div>
                            <div class="col-sm-9 py-3">{{ $user->cell->church->district->province->region->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">จังหวัด</span></div>
                            <div class="col-sm-9 py-3">{{ $user->cell->church->district->province->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">อำเภอ/เขต</span></div>
                            <div class="col-sm-9 py-3">{{ $user->cell->church->district->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">คริสตจักร</span></div>
                            <div class="col-sm-9 py-3">{{ $user->cell->church->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">กลุ่มแคร์</span></div>
                            <div class="col-sm-9 py-3">{{ $user->cell->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 py-3"><span class="text-muted">สถานะฝ่ายจิตวิญญาณ</span></div>
                            <div class="col-sm-9 py-3">{{ __('spiritual-status.' . $user->spiritual_status_name) }}</div>
                        </div>
                    </div>
                </div>

                <div class="element-box">
                    <h5 class="form-header">ข้อมูลส่วนตัว</h5>
                    <div class="element-box-content">
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">ชื่อ</span></div>
                            <div class="col-sm-9 py-3">{{ $user->fullname }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">ชื่อเล่น</span></div>
                            <div class="col-sm-9 py-3">{{ $user->nickname }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">เพศ</span></div>
                            <div class="col-sm-9 py-3">{{ $user->gender }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">วันเกิด</span></div>
                            <div class="col-sm-9 py-3">{{ $user->birthday->format('d/m/Y') }} (อายุ {{ $user->age }} ปี)</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">เลขบัตรประจำตัวประชาชน</span></div>
                            <div class="col-sm-9 py-3">{{ $user->idcard }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">เชื้อชาติ / สัญชาติ</span></div>
                            <div class="col-sm-9 py-3">{{ $user->race }} / {{ $user->nationality }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">เพิ่มเข้าระบบเมื่อ</span></div>
                            <div class="col-sm-9 py-3">{{ $user->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 py-3"><span class="text-muted">แก้ไขล่าสุดเมื่อ</span></div>
                            <div class="col-sm-9 py-3">{{ $user->updated_at->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>

                <div class="element-box">
                    <h5 class="form-header">ข้อมูลการติดต่อ</h5>
                    <div class="element-box-content">
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">Email</span></div>
                            <div class="col-sm-9 py-3">{{ $user->email }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">เบอร์โทรศัพท์มือถือ</span></div>
                            <div class="col-sm-9 py-3">{{ $user->mobile_number }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">Facebook</span></div>
                            <div class="col-sm-9 py-3">{{ $user->facebook }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 py-3"><span class="text-muted">Line</span></div>
                            <div class="col-sm-9 py-3">{{ $user->line }}</div>
                        </div>
                    </div>
                </div>

                @foreach($user->addresses as $address)
                    @if($address->type == AddressType::CURRENT)
                        <div class="element-box">
                            <h5 class="form-header">ที่อยู่ปัจจุบัน</h5>
                            <div class="element-box-content">
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
                        <div class="element-box">
                            <h5 class="form-header">ที่อยู่ตามทะเบียนบ้าน</h5>
                            <div class="element-box-content">
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

                <div class="element-box">
                    <h5 class="form-header">สถานภาพ</h5>
                    <div class="element-box-content">
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">สถานะ</span></div>
                            <div class="col-sm-9 py-3">{{ $user->mariage->status }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">ชื่อคู่สมรส</span></div>
                            <div class="col-sm-9 py-3">{{ $user->mariage->spouse_name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">ชื่อเล่นคู่สมรส</span></div>
                            <div class="col-sm-9 py-3">{{ $user->mariage->spouse_nickname }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">วันเกิดคู่สมรส</span></div>
                            <div class="col-sm-9 py-3">{{ $user->mariage->spouse_birthday->format('d/m/Y') }} (อายุ {{ $user->mariage->age }} ปี)</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 py-3"><span class="text-muted">เป็นคริสเตียน</span></div>
                            <div class="col-sm-9 py-3">
                                @if($user->mariage->spouse_christian)
                                    <i class="fa fa-check text-primary"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="element-box">
                    <h5 class="form-header">บุคคลที่สามารถติดต่อได้ในกรณีฉุกเฉิน</h5>
                    <div class="element-box-content">
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">ชื่อ</span></div>
                            <div class="col-sm-9 py-3">{{ $user->emergencyContact->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">ชื่อเล่น</span></div>
                            <div class="col-sm-9 py-3">{{ $user->emergencyContact->nickname }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">อายุ</span></div>
                            <div class="col-sm-9 py-3">{{ $user->emergencyContact->age }} ปี</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">ความสัมพันธ์</span></div>
                            <div class="col-sm-9 py-3">{{ $user->emergencyContact->relationship }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">เบอร์โทรศัพท์มือถือ</span></div>
                            <div class="col-sm-9 py-3">{{ $user->emergencyContact->mobile_number }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">จังหวัด</span></div>
                            <div class="col-sm-9 py-3">{{ $user->emergencyContact->address->subDistrict->district->province->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">อำเภอ/เขต</span></div>
                            <div class="col-sm-9 py-3">{{ $user->emergencyContact->address->subDistrict->district->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">ตำบล/แขวง</span></div>
                            <div class="col-sm-9 py-3">{{ $user->emergencyContact->address->subDistrict->name }}</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-sm-3 py-3"><span class="text-muted">รหัสไปรษณีย์</span></div>
                            <div class="col-sm-9 py-3">{{ $user->emergencyContact->address->postcode }}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 py-3"><span class="text-muted">รายละเอียด</span></div>
                            <div class="col-sm-9 py-3">{{ $user->emergencyContact->address->detail }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
