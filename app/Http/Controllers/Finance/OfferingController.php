<?php

namespace App\Http\Controllers\Finance;

use App\Enums\OfferingType;
use App\Models\Offering;
use App\Models\ServiceRound;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class OfferingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $serviceRounds = ServiceRound::latest()->take(10)->get();
        $offeringRecords = Offering::latest()->take(8)->get();
        $serviceRoundDate = $request->service_round_date;

        return view('finance.offering.index', compact('serviceRounds', 'offeringRecords', 'serviceRoundDate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'member_id' => 'required|exists:users,id',
            'type' => ['required', new EnumValue(OfferingType::class, false)],
            'amount' => 'required|alpha_num'
        ]);

        $financialOfficer = auth()->user();

        $financialOfficer->offerings()->create($request->all());

        return back()->with('success', 'บันทึกข้อมูลการถวายเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Offering $offering
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Offering $offering)
    {
        $offering->delete();

        return back()->with('success', 'ลบข้อมูลการถวายเรียบร้อยแล้ว');
    }
}
