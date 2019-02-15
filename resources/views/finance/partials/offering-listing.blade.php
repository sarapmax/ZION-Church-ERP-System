<div class="card">
    <div class="table-responsive mb-0">
        <table class="table table-nowrap card-table">
            <thead>
            <tr>
                <th>รหัสสมาชิก</th>
                <th>ชื่อสมาชิก</th>
                <th>ประเภท</th>
                <th>จำนวนเงิน</th>
                <th>ใบเสร็จ</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($offeringRecords as $offeringRecord)
                <tr>
                    <td>{{ $offeringRecord->member->code }}</td>
                    <td>{{ $offeringRecord->member->fullname }}</td>
                    <td>{{ __('offering-type.' . OfferingType::getKey($offeringRecord->type)) }}</td>
                    <td>{{ number_format($offeringRecord->amount) }}</td>
                    <td>@if($offeringRecord->need_receipt) <i class="fe fe-check text-success"></i> @endif</td>
                    <td class="link-action">
                        <a href=""><i class="fe fe-printer"></i></a>
                        @include('components.actions.delete', [
                            'type' => 'link',
                            'route' => route('finance.offering.destroy', $offeringRecord)
                        ])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No matching records found!.</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6" class="text-right pr-5">ยอดรวมทั้งหมด: {{ number_format($offeringRecords->sum('amount')) }} บาท</th>
                </tr>
            </tfoot>
        </table>

        @if($pagination) {{ $offeringRecords->links() }} @endif
    </div>
</div>
