<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::with('designation')->latest()->paginate();
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = Designation::latest()->get();
        return view('doctors.create', compact('designations'));
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


        $doctor = new Doctor();
        $doctor->name = $request->name;

        $doctor->email = $request->email;
        $doctor->mobile = $request->mobile;
        $doctor->gender = $request->gender;
        $doctor->blood_group = $request->blood_group;
        $doctor->address = $request->address;
        $doctor->designation_id = $request->designation_id;

        if ($request->has('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $extenstion;

            $path = public_path('uploads/' . $file_name);

            // Resize and save the image using Intervention Image
            Image::make($file->getRealPath())->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

            $doctor->image = 'uploads/' . $file_name;
        }


        if ($doctor->save()) {
            return redirect()->route('doctors.index')->with('success', 'Doctor Uploaded Successfully');
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
        $doctor = Doctor::findOrFail($id);
        $designations = Designation::latest()->get();
        return view('doctors.edit', compact('doctor', 'designations'));
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

        $doctor = Doctor::findOrFail($id);

        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->mobile = $request->mobile;
        $doctor->gender = $request->gender;
        $doctor->blood_group = $request->blood_group;
        $doctor->address = $request->address;
        $doctor->designation_id = $request->designation_id;

        if ($request->has('image')) {
            $image_path = public_path('uploads/' . $doctor->image);

            if ($doctor->image != null) {
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


            $doctor->image = 'uploads/' . $file_name;
          
        } 
            

        if ($doctor->update()) {
            return redirect()->route('doctors.index')->with('success', 'Doctor Updated Successfully');
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

        $doctor = Doctor::findOrFail($id);

        $image_path = public_path('uploads/' . $doctor->image);
        if ($doctor->image != null) {
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }


        $doctor->delete();

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor deleted successfully');
    }
}
