<?php

namespace App\Http\Controllers;

use App\Dtos\Common\SignInRes;
use App\Dtos\Common\SignInGoogleRes;
use App\Dtos\Common\SignInReq;
use App\Repositories\UserRepository;
use App\Repositories\PatientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


use Laravel\Socialite\Facades\Socialite;

class SignInController extends Controller
{
    private PatientRepository $patientRepository;

    public function __construct()
    {
        $this->patientRepository = new PatientRepository();
    }

    public function index()
    {
        return view("common\SignIn");
    }

    public function signIn(Request $req)
    {
        $signInRequest = new SignInReq($req);

        if ($signInRequest->email == "" && $signInRequest->password == "") {
            return response()->json([
                'message' => 'Please enter complete information',
                'error' => [
                    "email" => $signInRequest->email,
                    "password" => $signInRequest->password
                ]
            ], 422);
        }

        $userRepository = new UserRepository();
        $user = $userRepository->findByEmail($signInRequest->email);

        if ($user == "" || $user->getPassword() != $signInRequest->password) {
            return response()->json([
                'message' => 'User not found or invalid credentials',
            ], 401);
        }

        $requestPatient = new PatientRepository();
        $patientId = $requestPatient->findByEmail($signInRequest->email);
        return response()->json([
            'message' => 'Sign in Successfully',
            'payload' => new SignInRes(
                $patientId,
                $user->getId(),
                $user->getRole()->getValue(),
                $user->getEmail(),
                $user->getFullname(),
                $user->getPassword(),
                $user->getPhone(),
                $user->getAddress(),
                $user->getUrlImage()
            )
        ]);
    }
    
    public function SignInGoogle()
    {
        $user = Socialite::driver('google')->user(); 
        $this->patientRepository->insertGoogle($user->id);
        $payload = new SignInGoogleRes(
            $user->id,
            $user->email,
            $user->name,
            $user->avatar
        );
        session()->put('payload', $payload);
       
        return redirect()->route('home', ['payload' => $payload]);

    }
}
