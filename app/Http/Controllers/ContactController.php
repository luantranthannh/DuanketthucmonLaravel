<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use App\Jobs\ContactUsJob;
use App\Models\Banner;
use App\Models\MessageContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show() {
        $banners=Banner::all();
        return view('patients.contactUs', compact('banners'));
    }
    public function send(){
        $data = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:5',
        ]);

        // Send email to admin
        Mail::to('luan.tran25@student.passerellesnumeriques.org')->send(new ContactUs($data));
        MessageContact::create($data);
        $job = (new ContactUsJob($data));
        dispatch($job);

        // dd('send');
        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }    
    
}