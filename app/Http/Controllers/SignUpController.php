<?php

namespace App\Http\Controllers;


use App\Dtos\Common\SignInRes;
use App\Dtos\Patient\SignUpReq;
use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use App\Repositories\PatientRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;


class SignUpController extends Controller
{
    private UserRepository $userRepository;
    private PatientRepository $patientRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->patientRepository = new PatientRepository();
    }
    public function index()
    {
        return view("patients\signUp");
    }
    public function signUp(Request $req)
    {
        $signUpReq = new SignUpReq($req);
        $validation = new UserRepository();
        
        $checkMail = $validation->validateEmail($signUpReq->email);
        $checkPassword = $validation->validatePassword($signUpReq->password);
        $checkFullName = $validation->validateFullName($signUpReq->fullName);
        $checkPhone = $validation->validatePhone($signUpReq->phone);
        $checkAddress = $validation->validateAddress($signUpReq->address);
        if ($signUpReq->email == "" || $signUpReq->password == "" || $signUpReq->fullName == "" || $signUpReq->phone == "" || $signUpReq->address == "") {
            return response()->json([
                "message" => "Please enter complete information",
                "error" => [
                    "email" => $signUpReq->email,
                    "password" => $signUpReq->password,
                    "fullName" => $signUpReq->fullName,
                    "phone" => $signUpReq->phone,
                    "address" => $signUpReq->address
                ]
            ], 422);
        }   


        if (!$checkMail || !$checkPassword || !$checkFullName) {
            return response()->json([
                "message" => "Invalid",
                "error" => [
                    "email" => !$checkMail,
                    "password" => !$checkPassword,
                    "fullName" => !$checkFullName,
                    "phone" =>!$checkPhone,
                    "address" =>!$checkAddress
                ]
            ], 400);
        }

        $userRepository = new UserRepository();
        $user = $userRepository->findByEmail($signUpReq->email);
        if ($user != null) {
            return response()->json([
                "message" => "email already exists",
                "error" => "email is error"
            ], 401);
        }

        $newUser = new User(Role::Patient, $signUpReq->email, $signUpReq->password, $signUpReq->fullName, $signUpReq->phone, $signUpReq->address);
        $newPatient = new Patient($newUser->getId());

        $this->userRepository->insert($newUser);
        $this->patientRepository->insert($newPatient);

        $requestPatient = new PatientRepository();
        $patientId = $requestPatient->findByEmail($signUpReq->email);

        return response()->json([
            'message' => 'Sign Up Successfully',
            'payload' => new SignInRes(
                $patientId,
                $newUser->getId(),
                $newUser->getRole()->getValue(),
                $newUser->getEmail(),
                $newUser->getFullname(),
                $newUser->getPassword(),
                $newUser->getPhone(),
                $newUser->getAddress(),
                $newUser->getUrlImage()
            )
        ], 200);
    }
}