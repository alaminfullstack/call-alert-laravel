<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Intervention\Image\Facades\Image;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::latest()->paginate();
        return view('payment-methods.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment-methods.create');
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
            'address' => 'required',
            'title' => 'required'
        ]);


        $paymentMethod = new PaymentMethod();
        $paymentMethod->title = $request->title;
        $paymentMethod->address = $request->address;
      
        if ($request->has('image')) {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $extenstion;

            $path = public_path('uploads/' . $file_name);

            // Resize and save the image using Intervention Image
            Image::make($file->getRealPath())->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

            $paymentMethod->image = 'uploads/' . $file_name;
        }


        if ($paymentMethod->save()) {
            return redirect()->route('payment-methods.index')->with('success', 'PaymentMethod Uploaded Successfully');
        }


        return back()->with('error', 'Something went to wrong!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('payment-methods.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $request->validate([
            'address' => 'required',
            'title' => 'required'
        ]);

        $paymentMethod->title = $request->title;
        $paymentMethod->address = $request->address;
       
        if ($request->has('image')) {
            $image_path = public_path('uploads/' . $paymentMethod->image);

            if ($paymentMethod->image != null) {
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


            $paymentMethod->image = 'uploads/' . $file_name;
          
        } 
            

        if ($paymentMethod->update()) {
            return redirect()->route('payment-methods.index')->with('success', 'PaymentMethod Updated Successfully');
        }
        

        return back()->with('error', 'Something went to wrong!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $image_path = public_path('uploads/' . $paymentMethod->image);
        if ($paymentMethod->image != null) {
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }


        $paymentMethod->delete();

        return redirect()->route('payment-methods.index')
            ->with('success', 'PaymentMethod deleted successfully');
    }
}
