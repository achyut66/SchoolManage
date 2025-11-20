<?php

namespace App\Http\Controllers;

use App\Models\PalikaProfile;
use Illuminate\Http\Request;

class PalikaProfileController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(! Auth()->user()->can('system-setup')) {
            return redirect('/dashboard')->with('access', 'Permission Denied!!!');
        }
        $row = PalikaProfile::first();
        return view('pages.setup', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SystemConfig  $systemConfig
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'type'          => 'required',
            'pradesh'       => 'required',
            'district'      => 'required',
            'palika'        => 'required',
            'address'       => 'required',
            'schoolname'    => 'required',
        ]);

        if ($request->file('logo')) {
            $file = $request->file('logo');
            $fileName = time().".".$file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $validatedData['logo'] = $filePath;
        }
        $validatedData['slogan'] = $request->get('slogan');
        if(empty($request->id)) {
            PalikaProfile::create($validatedData);
        } else {
            PalikaProfile::where('id', $request->id)->update($validatedData);
        }
        return redirect('/system-config')->with('success', 'User is successfully created');
    }
    // public function getSchoolProfile()
    // {
    //     $row = PalikaProfile::first();
    //     return response()->json($row);
    // }

    /**
     * Get palika profile details by ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPalikaProfile($id = null)
    {
        if ($id) {
            $profile = PalikaProfile::find($id);
        } else {
            $profile = PalikaProfile::first();
        }
        return response()->json($profile);
    }
}
