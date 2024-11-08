<?php

namespace App\Services;
use App\Repositories\LoginRepository;
use Tymon\JWTAuth\Facades\JWTAuth;
class LoginService
{
    protected $LoginRepository;
    public function __construct( LoginRepository  $LoginRepository) 
    {   
        $this->LoginRepository = $LoginRepository;
    }
    
    public function login($request)
    {
        if ($this->LoginRepository->get($request)) {
            $user = $request->only('email', 'password');
            $accessToken = JWTAuth::attempt($user);
            return response()->json(['user' => $user, 'access_token' => $accessToken], 200);
        }else{
            return response()->json(['Error'], 404);
        }
    }
}