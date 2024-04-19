<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUs;

class ContactUsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        $mailable = new ContactUs($this->data);
        // Mail::to('hoai.nguyen25@student.passerellesnumeriques.org')->send(new ContactUs($this->data));

        Mail::to('luan.tran25@student.passerellesnumeriques.org')->send($mailable);
    }
}