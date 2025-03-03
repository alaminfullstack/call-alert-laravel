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
        return view('details', compact('post'));
    }

    public function booking($id){
        $post = Post::findOrFail($id);
        $methods = PaymentMethod::latest()->get();
        return view('booking', compact('post', 'methods'));
    }

    public function booking_save(Request $request, $id){
        $post = Post::findOrFail($id);

        // Store form data in session
        session([
            'booking_data' => $request->only(['name', 'mobile', 'address', 'date', 'amount', 'payment_method'])
        ]);

        return redirect()->route('payment', $post->id);
    }

    public function payment($id){
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

    public function payment_save(Request $request, $id) {
        // Retrieve stored session booking data
        $bookingData = session('booking_data', []);
        $post = Post::findOrFail($id);
    
        if (empty($bookingData)) {
            return redirect()->route('booking', $post->id)->with('error', 'No booking data found.');
        }
    
        // Create a new booking record
        $booking = new Booking();
        $booking->post_id = $id;
        $booking->name = $bookingData['name'];
        $booking->mobile = $bookingData['mobile'];
        $booking->address = $bookingData['address'];
        $booking->date = $bookingData['date'];
        $booking->amount = $bookingData['amount'];
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
}
