<?php

namespace App\Dtos\Common;

use Illuminate\Http\Request;

class SignInReq
{
    public string $email;
    public string $password;

    public function __construct(Request $request)
    {
        $this->email = $request->input("email") ?? "";
        $this->password = $request->input("password") ?? "";
    }
}
