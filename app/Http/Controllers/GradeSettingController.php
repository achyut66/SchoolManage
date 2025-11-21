<?php

namespace App\Http\Controllers;

use App\Models\GradeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class GradeSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            $data = GradeSetting::all();
            return view('grade.list', compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('grade.add')->render();
        return Response::json(['status' => 200, 'view' => $view]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'         => 'required',
        ]);
        GradeSetting::create($validatedData);
        return redirect('/grade')->with('success', 'Saved Successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradeSetting  $gradeSetting
     * @return \Illuminate\Http\Response
     */
    public function show(GradeSetting $gradeSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GradeSetting  $gradeSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $st = $request->get('id');
        $row = GradeSetting::find($st);
        $view = view('grade.edit',compact('row'))->render();
        return Response::json(['status' => 200, 'view' => $view]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GradeSetting  $gradeSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GradeSetting $caste,$id)
    {
        $validatedData = $request->validate([
            'name'         => 'required',
        ]);
        GradeSetting::where('id', $id)->update($validatedData);
        return redirect('/grade')->with('success', 'Update Successfull !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GradeSetting  $gradeSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradeSetting $gradeSetting)
    {
        //
    }
}
