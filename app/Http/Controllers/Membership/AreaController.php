<?php

namespace App\Http\Controllers\Membership;

use App\Enums\SubmissionType;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::with(['church', 'church.district', 'church.district.province'])->paginate(20);

        return view('membership.area.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('membership.area.create');
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
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'church_id' => 'required|exists:churches,id',
            'name' => 'required|min:2|unique:cells'
        ]);

        Area::create($request->all());

        if ($request->submit_type == SubmissionType::ADD_AND_ADD_ANOTHER) {
            return redirect()->back()->with('success', 'เพิ่มเขตเรียบร้อยแล้ว')->withInput($request->except('name'));
        }

        return redirect()->route('membership.area.index')->with('success', 'เพิ่มเขตเรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = Area::with(['church', 'church.district', 'church.district.province'])->find($id);

        return view('membership.area.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Area $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'church_id' => 'required|exists:churches,id',
            'name' => [
                'required',
                'min:2',
                Rule::unique('areas')->ignore($area->id)
            ],
        ]);

        $area->update($request->all());

        return redirect()->route('membership.area.index')->with('success', 'แก้ไขเขตเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Area $area
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Area $area)
    {
        $area->delete();

        return redirect()->route('membership.area.index')->with('success', 'ลบเขตเรียบร้อยแล้ว');
    }
}
