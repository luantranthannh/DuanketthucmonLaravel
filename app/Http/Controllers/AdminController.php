<?php

namespace App\Http\Controllers;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{  
    private $adminRepository;


    public function __construct(AdminRepository $adminRepository){
        $this->adminRepository = $adminRepository;
    }
    public function index()
    {
        return view('layouts.admin.admin');
    }

    public function dashboard()
    {   
        $counts = $this->adminRepository->get_appointments_by_doctor();
    
        // Khởi tạo mảng rỗng để lưu trữ dữ liệu mới
        $chartData = [];
        $labels = [];
    
        // Lặp qua kết quả truy vấn và chuyển đổi dữ liệu
        foreach ($counts as $count) {
            $chartData[] = $count->total_bookings;
            $labels[] = $count->name;
        }
    
        return view('admin.dashboard', compact('chartData', 'labels'));
    }
    

}