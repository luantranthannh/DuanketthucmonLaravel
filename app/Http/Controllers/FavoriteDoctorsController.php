<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Repositories\DoctorRepository;
use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;

class FavoriteDoctorsController extends Controller
{
    public function __construct(private DoctorRepository $doctorRepository)
    {
        
    }
    
    public function index()
    {
        // // Lấy dữ liệu từ model (truy vấn cơ sở dữ liệu)
        // $favoriteDoctors = Favorite::all();
        // // Load view và truyền dữ liệu vào view
        // return view('patients.favoriteDoctors', ['favoriteDoctors' => $favoriteDoctors]);
        $banners=Banner::all();
        $favoriteDoctors = $this->doctorRepository->getAllFavoriteDoctors();
        return view('patients.favoriteDoctors',['favoriteDoctors' => $favoriteDoctors, 'banners' => $banners]);
    }

    public function destroy(Request $request, $id) {  
        $favorite = Favorite::find($id);
        if ($favorite) {
            $favorite->delete();
            return redirect('/favorite-doctors')->with('success', 'Favorite doctor deleted successfully');
        } else {
            return redirect('/favorite-doctors')->with('error', 'Favorite doctor not found');
        }
    }
}