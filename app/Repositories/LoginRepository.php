<?php

namespace App\Repositories;

use App\Interfaces\LoginRepositoryInterface;

use Illuminate\Support\Facades\Auth;

class LoginRepository implements LoginRepositoryInterface
{
    public function get($request)
    {
        return Auth::attempt($request->only('email', 'password') );
    }
}
