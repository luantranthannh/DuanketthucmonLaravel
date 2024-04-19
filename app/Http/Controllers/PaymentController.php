<?php

namespace App\Http\Controllers;

use App\Repositories\DoctorRepository;
use App\Repositories\PatientRepository;

class PaymentController extends Controller
{
    public function index($user_id,$doctor_id,$date,$time_id)
    {
        $doctorRepository = new DoctorRepository;
        $patientRepository = new PatientRepository;
        return view("patients.Payment", ['doctor' => $doctorRepository->getDoctorById($doctor_id)], ['patient' => $patientRepository-> get_patient_by_id($user_id),'time' => $patientRepository->getTimeId($time_id),'date' => $date]);
    }
}