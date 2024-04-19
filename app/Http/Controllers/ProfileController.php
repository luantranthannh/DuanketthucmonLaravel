<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use  App\Repositories\PatientRepository;
use App\Models\Role;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class ProfileController extends Controller
{
    private $patientRepository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }
    public function index($id)
    {
        $patient = $this->patientRepository->get_patient_by_id($id);
        return view('patients.Profile', compact('patient'));
    }

    public function update(Request $request, string $id)
    {   
        $select = new PatientRepository();
    
        // Validate input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'new_password' => 'nullable|string|min:6',
            'address' => 'required|string',
            'phone' => 'required|string',
            'health_condition' => 'nullable|string',
            'note' => 'nullable|string',
        ]);
        
       
        if ($validator->fails()) {
            return redirect('/Profile/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        // Proceed with updating the patient
        $password = $request->input('password');
        $newPassword = $request->input('new_password');
        if (!empty($newPassword)) {
            $password = $newPassword;
            
        }
       
    
        // Update user information
        $updateUser = new User(
            Role::Doctor,
            '',
            $password,
            $request->input('name'),
            $request->input('address'),
            $request->input('phone'),
            ''
        );
        $updatePatient = new Patient(
            $id, 
            $request->input('health_condition'), 
            $request->input('note')
        );
        
        $patient = $select->update_patient($updateUser, $updatePatient);
        
        if ($patient == null) {
            //dd($patient);
            return redirect('/Profile/'.$id)->with('success', 'Patient updated successfully');
        }
    
        // return response()->json([
        //     "message" => "Failed to update the patient",
        // ], 400);
    }
    public function create()
    {
        return view('admin.patients.create_patient');
    }
}