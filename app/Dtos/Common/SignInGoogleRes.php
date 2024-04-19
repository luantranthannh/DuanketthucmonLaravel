<?php

namespace App\Dtos\Common;

class SignInGoogleRes
{
    public string $id;
    public string $email;
    public string $fullName;
    public string $image;


    /**
     * @param string $id
     * @param string $image
     * @param string $email
     * @param string $fullName
     */
    public function __construct(string $id,string $email, string $fullName,string $image)
    {
        $this->id = $id;
        $this->email = $email;
        $this->fullName = $fullName;
        $this->image = $image;
    }
}
