<?php

namespace App\Http\Controllers;

use App\Models\GradeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\SettingSection;

class GradeSettingController extends Controller
{
    
    public function index()
    {
        {
            $data = GradeSetting::all();
            return view('grade.list', compact('data'));
        }
    }

    public function create()
    {
        $view = view('grade.add')->render();
        return Response::json(['status' => 200, 'view' => $view]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'sections' => 'required|array',
            'sections.*' => 'required|string',
        ]);
        $grade = GradeSetting::create([
            'name' => $validated['name'],
        ]);
        if ($grade) {
            foreach ($validated['sections'] as $section) {
                SettingSection::create([
                    'grade'    => $validated['name'], // name saved as grade
                    'sections' => $section,
                ]);
            }
        }
        return redirect('/grade')->with('success', 'Saved Successfully !!!');
    }
    
    public function show(GradeSetting $gradeSetting)
    {
        //
    }

//     public function edit(Request $request)
// {
//     $id = $request->get('id');

//     $row = GradeSetting::with('sections')->findOrFail($id);

//     $view = view('grade.edit', compact('row'))->render();

//     return response()->json([
//         'status' => 200,
//         'view' => $view,
//     ]);
// }


// public function update(Request $request, $id)
// {
//     $validated = $request->validate([
//         'name' => 'required|string',
//         'sections' => 'required|array',
//         'sections.*' => 'required|string',
//     ]);

//     // Find grade
//     $grade = GradeSetting::findOrFail($id);

//     $oldGradeName = $grade->name;

//     // Update grade name
//     $grade->update([
//         'name' => $validated['name'],
//     ]);

//     // Delete old sections (based on OLD grade name)
//     SettingSection::where('grade', $oldGradeName)->delete();

//     // Insert new sections with NEW grade name
//     foreach ($validated['sections'] as $section) {
//         SettingSection::create([
//             'grade' => $validated['name'],
//             'sections' => $section,
//         ]);
//     }

//     return redirect('/grade')->with('success', 'Update Successful !!!');
// }


    public function destroy(GradeSetting $gradeSetting)
    {
        // dd($gradeSetting);
        $gradeName = $gradeSetting->name;
        // dd($gradeName);
        SettingSection::where('grade', $gradeName)->delete();
        $gradeSetting->delete();
        return redirect('/grade')->with('success', 'Grade and sections deleted successfully !!!');
    }

}
