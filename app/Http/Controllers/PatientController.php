<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        return view('admin.patients.patients');
    }

    public function create()
    {
        return view('admin.patients.create_patient');
    }

    public function update()
    {
        return view('admin.patients.update_patient');
    }
   
}

