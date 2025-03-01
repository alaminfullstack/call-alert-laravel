<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::latest()->paginate();
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
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
            'email' => 'required',
            'name' => 'required'
        ]);


        $patient = new Patient();
        $patient->name = $request->name;

        $patient->email = $request->email;
        $patient->mobile = $request->mobile;
        $patient->gender = $request->gender;
        $patient->blood_group = $request->blood_group;
        $patient->address = $request->address;

        if ($request->has('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $extenstion;

            $path = public_path('uploads/' . $file_name);

            // Resize and save the image using Intervention Image
            Image::make($file->getRealPath())->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

            $patient->image = 'uploads/' . $file_name;
        }


        if ($patient->save()) {
            return redirect()->route('patients.index')->with('success', 'Patient Uploaded Successfully');
        }


        return back()->with('error', 'Something went to wrong!');
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
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $patient = Patient::findOrFail($id);



        if ($request->has('image')) {
            $image_path = public_path('uploads/' . $patient->image);

            if ($patient->image != null) {
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $extenstion;

            $path = public_path('uploads/' . $file_name);

            // Resize and save the image using Intervention Image
            Image::make($file->getRealPath())->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);


            $patient->name = $request->name;
            $patient->image = 'uploads/' . $file_name;
            $patient->email = $request->email;
            $patient->mobile = $request->mobile;
            $patient->gender = $request->gender;
            $patient->blood_group = $request->blood_group;
            $patient->address = $request->address;

            if ($patient->update()) {
                return redirect()->route('patients.index')->with('success', 'Patient Uploaded Successfully');
            }
        } else {
            $patient->name = $request->name;
            $patient->email = $request->email;
            $patient->mobile = $request->mobile;
            $patient->gender = $request->gender;
            $patient->blood_group = $request->blood_group;
            $patient->address = $request->address;

            if ($patient->update()) {
                return redirect()->route('patients.index')->with('success', 'Updated Successfully');
            }
        }

        return back()->with('error', 'Something went to wrong!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $patient = Patient::findOrFail($id);

        $image_path = public_path('uploads/' . $patient->image);
        if ($patient->image != null) {
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }


        $patient->delete();

        return redirect()->route('patients.index')
            ->with('success', 'Patient deleted successfully');
    }
}
