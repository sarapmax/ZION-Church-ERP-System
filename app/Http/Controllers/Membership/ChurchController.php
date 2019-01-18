<?php

namespace App\Http\Controllers\Membership;

use App\Models\Church;
use App\Enums\SubmissionTypeEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class ChurchController extends Controller
{
    /**
     * ChurchController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $churches = Church::with(['district', 'district.province'])->paginate(20);

        return view('membership.church.index', compact('churches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('membership.church.create');
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
            'name' => 'required|min:3|unique:churches'
        ]);

        Church::create($request->all());

        if ($request->submit_type == SubmissionTypeEnum::ADD_AND_ADD_ANOTHER) {
            return redirect()->back()->with('success', 'เพิ่มคริสตจักรเรียบร้อยแล้ว')->withInput($request->except('name'));
        }

        return redirect()->route('membership.church.index')->with('success', 'เพิ่มคริสตจักรเรียบร้อยแล้ว');
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
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $church = Church::with(['district', 'district.province'])->find($id);

        return view('membership.church.edit', compact('church'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Church $church
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Church $church)
    {
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'name' => [
                'required',
                'min:3',
                Rule::unique('churches')->ignore($church->id)
            ],
        ]);

        $church->update($request->all());

        return redirect()->route('membership.church.index')->with('success', 'แก้ไขคริสตจักรเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Church $church
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Church $church)
    {
        $church->delete();

        return redirect()->route('membership.church.index')->with('success', 'ลบคริสตจักรเรียบร้อยแล้ว');
    }
}
