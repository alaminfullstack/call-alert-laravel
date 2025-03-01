<?php

namespace App\Http\Controllers;

use App\Models\Appoitment;
use App\Models\Booking;
use App\Models\Designation;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PaymentMethod;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        // $total_patient = Patient::count();
        // $total_doctor = Doctor::count();
        // $total_designation = Designation::count();
        // $today_appoitments  = Appoitment::whereDate('date', Carbon::today())->orderBy('date', 'DESC')->get();


        $total_post = Post::count();
        $total_booking = Booking::count();
        $today_booking = Booking::whereDate('created_at', Carbon::today())->count();
        $today_bookings  = Booking::whereDate('created_at', Carbon::today())->orderBy('created_at', 'DESC')->get();


        return view('home', compact('total_post', 'total_booking', 'today_booking', 'today_bookings'));
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
