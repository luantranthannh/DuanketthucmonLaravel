<?php

namespace App\Dtos\Patient;

use Illuminate\Http\Request;

class BookingReq
{
    public string $date;
    public string $patientId;
    public string $doctorId;
    public string $id;

    public function __construct(Request $req)
    {
        $this->date = $req->input("selectedDate");
        $this->patientId = $req->input("patientId");
        $this->doctorId = $req->input("doctorId");
        $this->id = $req->input("id");
    }
}