<?php

namespace App\Http\Controllers;

use App\Services\RegisterService;
use App\Services\LoginService;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResendRequest;
use App\Http\Requests\VerificationRequest;

class RegisterController extends Controller
{
    protected $registerService;
    protected $loginService;

    public function __construct(RegisterService $registerService , LoginService $loginService)
    {    
        $this->registerService = $registerService;
        $this->loginService = $loginService;
    }

    public function register(RegisterRequest $request)
    {
        return $this->registerService->register($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->loginService->login($request);
    }

    public function resend(ResendRequest $request){

        return $this->registerService->resend($request);
    }

    public function verification(VerificationRequest $request)
    {
        return $this->registerService->verification($request);
    }

    public function getUser()
    {
        return $this->registerService->getuser();
    }
}
