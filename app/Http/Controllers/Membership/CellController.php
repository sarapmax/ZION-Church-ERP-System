<?php

namespace App\Http\Controllers\Membership;

use App\Models\Cell;
use App\Enums\SubmissionTypeEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cells = Cell::with(['church', 'church.district', 'church.district.province'])->paginate(20);

        return view('membership.cell.index', compact('cells'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('membership.cell.create');
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
            'name' => 'required|min:3|unique:cells'
        ]);

        Cell::create($request->all());

        if ($request->submit_type == SubmissionTypeEnum::ADD_AND_ADD_ANOTHER) {
            return redirect()->back()->with('success', 'เพิ่มคริสตจักรเรียบร้อยแล้ว')->withInput($request->except('name'));
        }

        return redirect()->route('membership.cell.index')->with('success', 'เพิ่มกลุ่มแคร์เรียบร้อยแล้ว');
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
        $cell = Cell::with(['church', 'church.district', 'church.district.province'])->find($id);

        return view('membership.cell.edit', compact('cell'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Cell $cell
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Cell $cell)
    {
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'church_id' => 'required|exists:churches,id',
            'name' => [
                'required',
                'min:3',
                Rule::unique('cells')->ignore($cell->id)
            ],
        ]);

        $cell->update($request->all());

        return redirect()->route('membership.cell.index')->with('success', 'แก้ไขกลุ่มแคร์เรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cell $cell
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Cell $cell)
    {
        $cell->delete();

        return redirect()->route('membership.cell.index')->with('success', 'ลบกลุ่มแคร์เรียบร้อยแล้ว');
    }
}
