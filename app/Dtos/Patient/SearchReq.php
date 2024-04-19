<?php

namespace App\Dtos\Patient;

use Illuminate\Http\Request;

class SearchReq
{
    public string $key;

    public function __construct(Request $req)
    {
        $this->key = $req->input("key");
    }
}