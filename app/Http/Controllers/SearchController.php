<?php

namespace App\Http\Controllers;
use App\Dtos\Patient\SearchReq;
use App\Models\Banner;
use App\Repositories\DoctorRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $request = new DoctorRepository;
        $banners=Banner::all();
        return view("patients.Search", ['doctors' => $request->getAllDoctor(), 'banners' => $banners]);
    }

    public function search(Request $req)
    {
        $request = new SearchReq($req);
        $requests = new DoctorRepository;
        $name = $request->key;
        $arrayUser = $requests->searchDoctors($name);
        return response()->json([
            'message' => 'Successfully',
            'ListDoctor' =>  $arrayUser,
        ], 200);
        
    }
}