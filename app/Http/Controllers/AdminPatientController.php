<?php

namespace App\Http\Controllers;

use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use App\Repositories\DoctorRepository;
use App\Repositories\UserRepository;
use  App\Repositories\PatientRepository;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminPatientController extends Controller
{
    private $adminRepository;
    private $doctorRepository;
    private $userRepository;
    private $patientRepository;

    public function __construct(AdminRepository $adminRepository, PatientRepository $patientRepository, UserRepository $userRepository, DoctorRepository $doctorRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->patientRepository = $patientRepository;
        $this->userRepository = $userRepository;
        $this->doctorRepository = $doctorRepository;
    }


    public function index()
    {
        $patients = $this->patientRepository->get_info_patients();
        return view('admin.patients.patients', compact('patients'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => [
                'required',
                'min:6',
                
            ],
            'name' => 'required',
            'phone' => ['required', 'regex:/^0\d{9}$/'],
            'address' => 'required',
            'url_image' => 'required|mimes:png,jpg,jpeg,webp,gif',
            'health_condition' => 'required|string',
            'note' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect('admin/patients/create')
                ->withErrors($validator)
                ->withInput();
        }
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }
        $hashedPassword = ($request->input('password'));
        $select = new AdminRepository();
        $insert_patient = new PatientRepository();
        $user = new User(
            Role::Patient,
            $request->input('email'),
            $hashedPassword,
            $request->input('name'),
            $request->input('phone'),
            $request->input('address'),
            $request->file('url_image')->move('assets/admin/images' . $request->file('url_image')->getClientOriginalExtension())
        );
        $patient = $select->add_new_user($user);
        $new_patient = new Patient(
            $user->getId(),
            $request->input('health_condition') ?? '',
            $request->input('note') ?? ''
        );
        $insert_patient->add_new_patient($new_patient);

        if ($patient==null) {
            return redirect('/admin/patients')->with('success', 'Patient deleted successfully');
        } 
        
    }

    public function edit($user_id)
    {   
        $patient = $this->patientRepository->get_patient_by_id($user_id);
       // dd($patient);
        return view('admin.patients.update_patient', compact('patient'));
    }

    public function update(Request $request, string $id)
    {   
        $select = new AdminRepository();
    
        // Validate input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'new_password' => 'nullable|string|min:6',
            'address' => 'required|string',
            'phone' => 'required|string',
            'url_image' => 'required|mimes:png,jpg,jpeg,webp,gif',
            'health_condition' => 'nullable|string',
            'note' => 'nullable|string',
        ]);
        
       
        if ($validator->fails()) {
            return redirect('admin/patients/'.$id.'/update')
                ->withErrors($validator)
                ->withInput();
        }
        // Proceed with updating the patient
        $password = $request->input('password');
        $newPassword = $request->input('new_password');
        if (!empty($newPassword)) {
            $password = $newPassword;
        }

        if ($request->hasFile('url_image')) {
            $fileName = $request->file('url_image')->getClientOriginalName();
            $request->file('url_image')->move('assets/admin/images', $fileName);
            $imageUrl =   $fileName;
        } else {
            $imageUrl = null;
        }

        $updateUser = new User(
            Role::Patient,
            '',
            $password,
            $request->input('name'),
            $request->input('address'),
            $request->input('phone'),
            $imageUrl
        );
        $updatePatient = new Patient(
            $id, 
            $request->input('health_condition'), 
            $request->input('note')
        );
        $patient = $select->update_patient($updateUser, $updatePatient);
        
        if ($patient == null) {
            return redirect('/admin/patients')->with('success', 'Patient updated successfully');
        } 
    
        
    }























    
    public function create()
    {
        return view('admin.patients.create_patient');
    }

    public function destroy(string $id)
    {
        $select = new AdminRepository();
        $select->delete_patient($id);
        return redirect('admin/patients')->with('success', 'Patient successfully deleted');
    }


    public function search(Request $request)
{
    $search = $request->input('search'); // Lấy giá trị từ query string

    $patients = $this->adminRepository->search_patient($search); // Chuyển giá trị search vào hàm search trong repository
    //dd($patients);
    return view('admin.patients.patients', compact('patients', 'search')); // Trả kết quả và từ khóa tìm kiếm đến view
}}