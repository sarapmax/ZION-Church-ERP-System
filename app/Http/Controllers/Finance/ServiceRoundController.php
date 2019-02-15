<?php

namespace App\Http\Controllers\Finance;

use App\Models\Offering;
use App\Models\ServiceRound;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceRoundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceRounds = ServiceRound::latest()->paginate(20);

        return view('finance.service-round.index', compact('serviceRounds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('finance.service-round.create');
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
           'date' => 'required|date'
        ]);

        $serviceRound = auth()->user()->serviceRounds()->create([
            'date' => $request->date,
            'financial_witnesses' => $request->financial_witnesses
        ]);

        return redirect()->route('finance.service-round.show', $serviceRound)->with('success', 'เพิ่มรอบนมัสการเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param ServiceRound $serviceRound
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ServiceRound $serviceRound)
    {
        $offeringRecords = Offering::whereServiceRoundId($serviceRound->id)->with('member')->latest()->paginate(20);

        return view('finance.service-round.show', compact('serviceRound', 'offeringRecords'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ServiceRound $serviceRound
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ServiceRound $serviceRound)
    {
        return view('finance.service-round.edit', compact('serviceRound'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param ServiceRound $serviceRound
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceRound $serviceRound)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $serviceRound->update([
            'date' => $request->date,
            'financial_witnesses' => $request->financial_witnesses
        ]);

        return redirect()->route('finance.service-round.show', $serviceRound)->with('success', 'แก้ไขรอบนมัสการเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ServiceRound $serviceRound
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(ServiceRound $serviceRound)
    {
        $serviceRound->delete();

        return back();
    }
}
