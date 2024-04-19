<?php

namespace App\Http\Controllers;

use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use App\Repositories\DoctorRepository;
use App\Repositories\UserRepository;
use  App\Repositories\PatientRepository;
use App\Models\Role;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class AdminDoctorController extends Controller
{
    private $adminRepository;
    private $patientRepository;
    private $userRepository;
    private $doctorRepository;

    public function __construct(AdminRepository $adminRepository, PatientRepository $patientRepository, UserRepository $userRepository, DoctorRepository $doctorRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->patientRepository = $patientRepository;
        $this->userRepository = $userRepository;
        $this->doctorRepository = $doctorRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = $this->doctorRepository->getAllDoctor();
        // dd($doctors);
        return view('admin.doctors.doctors', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctors.create_doctor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|not_regex:/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9\s])[\w\s]+$/',
            'name' => 'required',
            'phone' => ['required', 'regex:/^0\d{9}$/'],
            'address' => 'required',
            'url_image' => 'required|file|mimes:png,jpg,jpeg,webp,gif',
            'specialization' => 'required',
            'description' => 'required',
        ];

        $validator = Validator::make($request->all(), $rule);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('url_image')) {
            $file = $request->file('url_image');
            $name = time() . "_" . $file->getClientOriginalName();
            $path = public_path('assets/admin/images');

            $file->move($path, $name);
            $url_image = $name;

            $select = new AdminRepository();
            $insert_doctor = new DoctorRepository();
            $user = new User(
                Role::Doctor,
                $request->input('email'),
                $request->input('password'),
                $request->input('name'),
                $request->input('phone'),
                $request->input('address'),
                $url_image
            );
            $doctor = $select->addNewDoctor($user);
            $newDoctor = new Doctor($user->getId(), $request->input('specialization'), $request->input('description'));
            $insert_doctor->insert_doctor($newDoctor);

            if ($doctor != null) {
                return redirect('admin/doctors/')->with('success', 'Doctor successfully added');
            }
        } else {
            return back()->withErrors(['url_image' => 'The image field is required.'])->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $doc = new DoctorRepository();
        $doctor = $doc->getDoctorById($id);
        $doctor = $doctor[0];
        return view('admin.doctors.update_doctor', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rule = [
            'password' => 'required|min:6|not_regex:/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9\s])[\w\s]+$/',
            'name' => 'required',
            'phone' => ['required', 'regex:/^0\d{9}$/'],
            'address' => 'required',
            'url_image' => 'nullable|mimes:png,jpg,jpeg,webp,gif',
        ];

        $validator = Validator::make($request->all(), $rule);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('url_image')) {

            $file = $request->file('url_image');
            $name = time() . "_" . $file->getClientOriginalName();
            $path = public_path('assets/admin/images');

            $file->move($path, $name);
            $url_image = $name;

            $select = new AdminRepository();
            $user = new User(
                Role::Doctor,
                $request->input('email'),
                $request->input('password'),
                $request->input('name'),
                $request->input('phone'),
                $request->input('address'),
                $url_image
            );
            $newDoctor = new Doctor($id, $request->input('specialization'), $request->input('description'));
            $doctor = $select->updateDoctor($user, $newDoctor);

            if ($doctor != null) {
                return redirect('admin/doctors/')->with('success', 'Doctor successfully updated');
            }
        } else {
            return back()->withErrors(['url_image' => 'The image field is required.'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $select = new AdminRepository();
        $select->deleteDoctor($id);
        return redirect('admin/doctors/')->with('success', 'Doctor successfully deleted');
    }


    public function search_doctor(Request $request)
    {
        $search = $request->input('search'); // Lấy giá trị từ query string
    
        $doctors = $this->adminRepository->search_doctor($search); // Chuyển giá trị search vào hàm search trong repository
        //dd($patients);
        return view('admin.doctors.doctors', compact('doctors', 'search')); // Trả kết quả và từ khóa tìm kiếm đến view
    }

    
}