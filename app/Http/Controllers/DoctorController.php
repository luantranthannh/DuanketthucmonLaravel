<?php

namespace App\Http\Controllers;
use App\Repositories\DoctorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Banner;

class DoctorController extends Controller
{
    public function __construct(private DoctorRepository $doctorRepository)
    {
    }
    public function index()
    {
        $psychoDoctors = $this->doctorRepository->selectPsychoD();
        $psychologists = $this->doctorRepository->selectPsychologistsD();
        $neurologists = $this->doctorRepository->selectNeurologistD();
        $typeDoctors = $this->doctorRepository->typeDoctors();
        $banners = Banner::all();
        return view('patients.doctors', ['psychoDoctors' => $psychoDoctors, 'psychologists' => $psychologists, 'neurologists' => $neurologists, 'typeDoctors' => $typeDoctors, 'banners' => $banners]);
    }

    public function favoriteDoctor(Request $request)
    {
        $userId = $request->userId;
        $doctorId = $request->doctorId;

        $result = $this->doctorRepository->storeFavoriteDoctor($userId, $doctorId);
        if ($result) {
            return response()->json([
                'message' => 'success'
            ], 201);
        }
        return response()->json([
            'message' => 'error'
        ], 400);
    }
}
