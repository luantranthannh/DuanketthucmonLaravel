<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Repositories\AdminRepository;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\File;
class AdminAppointmentController extends Controller
{  
    private $adminRepository ;
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }
    
    public function index()
    { 
       $appointments = $this->adminRepository->get_appointments();
       return view('admin.appointments.appointment', compact('appointments'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $newStatus = $request->input('status');
        $result = $this->adminRepository->updateBookingStatus($id, $newStatus);
        if ($result) {
            $appointments = $this->adminRepository->get_appointments();
            return view('admin.appointments.appointment', compact('appointments'))->with('status', 'Status updated successfully');
        }
    }
        
    }





    