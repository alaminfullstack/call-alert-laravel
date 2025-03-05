<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Slider;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class FrontendController extends Controller
{
    public function index(){
        $posts = Post::latest()->get();
        $sliders = Slider::latest()->get();
        $populars = Post::inRandomOrder()->limit(10)->get();
        return view('index', compact('posts', 'sliders','populars'));
        // return view('welcome', compact('posts', 'sliders'));
    }

    public function details($id){
        $post = Post::findOrFail($id);
        $populars = Post::inRandomOrder()->limit(10)->get();
        return view('single', compact('post','populars'));
    }

    public function booking($id){
        $post = Post::findOrFail($id);
        $methods = PaymentMethod::latest()->get();
        $populars = Post::inRandomOrder()->limit(10)->get();
        return view('preview', compact('post', 'methods', 'populars'));
    }

    public function booking_save(Request $request, $id){
        $post = Post::findOrFail($id);

        // Store form data in session
        session([
            'booking_data' => $request->only(['name', 'mobile', 'address', 'whatsapp', 'date', 'payment_method', 'type', 'work_type'])
        ]);

        return redirect()->route('servey', $post->id);
    }

    public function servey($id) {
        $post = Post::findOrFail($id);
        $methods = PaymentMethod::latest()->get();

        // Retrieve stored session data
        $bookingData = session('booking_data', []);

        // Find the selected payment method
        $selectedMethod = null;
        if (!empty($bookingData['payment_method'])) {
            $selectedMethod = PaymentMethod::find($bookingData['payment_method']);
        }

        return view('payment', compact('post', 'methods', 'bookingData', 'selectedMethod'));
    }

    public function payment($id){
        $post = Post::findOrFail($id);
        $methods = PaymentMethod::latest()->get();
        return view('servey', compact('post','methods'));

        // Retrieve stored session data
        $bookingData = session('booking_data', []);

        // Find the selected payment method
        $selectedMethod = null;
        if (!empty($bookingData['payment_method'])) {
            $selectedMethod = PaymentMethod::find($bookingData['payment_method']);
        }

        return view('payment', compact('post', 'methods', 'bookingData', 'selectedMethod'));
    }

    public function payment_save(Request $request, $id) {
        // Retrieve stored session booking data
        $post = Post::findOrFail($id);

        // Create a new booking record
        // $booking = new Booking();
        // $booking->post_id = $id;
        // $booking->name = $request->name;
        // $booking->mobile = $request->mobile;
        // $booking->whatsapp = $request->whatsapp;
        // $booking->address = $request->address;
        // $booking->date = $request->date;
        // $booking->time = $request->time;
        // $booking->rate = $post->rate;
        // $booking->amount = $post->charge;
        // $booking->type = $request->type;
        // $booking->work_type = $request->work_type;
        // $booking->account_number = $request->account_number;
        // $booking->method = $request->bkash;
        // // $booking->transaction_id = $request->transaction_id;
        // $booking->status = 'booking';
        // $booking->save();

        // return redirect()->route('welcome')->with('success', 'Booking and payment saved successfully.');
        
        $bookingData = session('booking_data', []);
        if (empty($bookingData)) {
            return redirect()->route('booking', $post->id)->with('error', 'No booking data found.');
        }
    
        // Create a new booking record
        $booking = new Booking();
        $booking->post_id = $id;
        $booking->name = $bookingData['name'];
        $booking->mobile = $bookingData['mobile'];
        $booking->whatsapp = $bookingData['whatsapp'];
        $booking->address = $bookingData['address'];
        $booking->date = $bookingData['date'];
        $booking->time = $bookingData['time'];
        $booking->type = $bookingData['type'];
        $booking->work_type = $bookingData['work_type'];
        $booking->amount = $post->charge;
        $booking->rate = $post->rate;
        $booking->method = $request->method;
        $booking->method_address = $request->method_address;
        $booking->account_number = $request->account_number;
        $booking->transaction_id = $request->transaction_id;
        $booking->status = 'booking';
        $booking->save();
    
        // Clear the session after storing data
        session()->forget('booking_data');
    
        return redirect()->route('welcome')->with('success', 'Booking and payment saved successfully.');
    }

    public function services() {
        $populars = Post::inRandomOrder()->limit(10)->get();
        return view('pages.service', compact('populars'));
    }

    public function terms() {
        $populars = Post::inRandomOrder()->limit(10)->get();
        return view('pages.terms', compact('populars'));
    }

    public function how_to_book() {
        $populars = Post::inRandomOrder()->limit(10)->get();
        return view('pages.how-to', compact('populars'));
    }

    public function about_us() {
        $populars = Post::inRandomOrder()->limit(10)->get();
        return view('pages.about-us', compact('populars'));
    }

    public function video_service() {
        $populars = Post::inRandomOrder()->limit(10)->get();
        return view('pages.video-service', compact('populars'));
    }
}
