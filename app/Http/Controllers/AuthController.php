<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * show login
     *
     * show login function
     *
     **/
    public function show_login()
    {
        if(auth()->check()){
           return redirect()->back();
        }
        
        return view('login');
    }


    /**
     * login
     *
     * login function
     *
     * @param Request $request
     * @return Auth
     **/
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('home');
        }
        
        return redirect()->back()->with('error', 'The provided credentials do not match our records.');
    }

    /**
     * show login
     *
     * show login function
     *
     **/
    public function show_doctor_login()
    {
        return view('doctor_login');
    }

    /**
     * login
     *
     * login function
     *
     * @param Request $request
     * @return Auth
     **/
    public function doctor_login(Request $request)
    {
        if(Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('doctor.home');
        }
        
        return redirect()->back()->with('error', 'The provided credentials do not match our records.');
    }

    /**
     * show login
     *
     * show login function
     *
     **/
    public function show_register(Request $request)
    {
        if(auth()->check()){
           return redirect()->back();
        }

        $type = $request->type;
        
        return view('register'. compact('type'));
    }


    /**
     * login
     *
     * login function
     *
     * @param Request $request
     * @return Auth
     **/
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->type = $request->type;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($user->save()){
            Auth::login($user);
            return redirect()->route('home');
        }
        
        return redirect()->back()->with('error', 'something went to wrong!');
    }
}
