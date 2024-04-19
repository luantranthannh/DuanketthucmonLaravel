<?php

namespace App\Http\Controllers;

use App\Models\MessageContact;
use Illuminate\Http\Request;
use App\Repositories\ContactRepository;
use GuzzleHttp\Psr7\Message;

class AdminContactController extends Controller
{
    public function index()
    {
        $messages = MessageContact::all();
        return view('admin.messagesContact.contactUs', compact('messages'));
    }

    public function update_contact_message($id)
    {
        $message = MessageContact::find($id);
        if ($message) {
            $message->status = $message->status ? 0 : 1;
            $message->save();
        }
        return redirect()->route('admin.contact');
    }
}
