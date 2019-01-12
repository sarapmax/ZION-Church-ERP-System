<?php

namespace App\Http\Controllers\Member;

use App\Cell;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CellController extends Controller
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
        $cells = Cell::with(['church', 'church.district', 'church.district.province'])->get();

        return view('member.cell.index', compact('cells'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.cell.create');
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
            'region_id' => 'required|exists:regions,id',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'church_id' => 'required|exists:churches,id',
            'name' => 'required|min:3|unique:cells'
        ]);

        Cell::create($request->all());

        return redirect()->route('member.cell.index')->with('success', 'เพิ่มกลุ่มแคร์เรียบร้อยแล้ว');
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
        $cell = Cell::with(['church', 'church.district', 'church.district.province', 'church.district.province.region'])->find($id);

        return view('member.cell.edit', compact('cell'));
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
            'region_id' => 'required|exists:regions,id',
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

        return redirect()->route('member.cell.index')->with('success', 'แก้ไขกลุ่มแคร์เรียบร้อยแล้ว');
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

        return redirect()->back()->with('success', 'ลบกลุ่มแคร์เรียบร้อยแล้ว');
    }
}
