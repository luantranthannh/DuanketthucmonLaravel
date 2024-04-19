<?php

namespace App\Http\Controllers;

use App\Repositories\PatientRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Repositories\BookingRepository;


class HistoryBookingController extends Controller
{

    private BookingRepository $bookingRepository;
    public function __construct()
    {
        $this->bookingRepository = new BookingRepository();
    }
    public function index()
    {
        return view('patients.HistoryBooking');
    }

    public function processHistoryBooking(Request $request)
    {
        $email = $request->input('email');
        $booking = $this->bookingRepository->get_patient_id($email);
        return $booking;
    }
}