<?php

namespace App\Services;

use App\Interfaces\RegisterRepositoryInterface;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResendRequest;
use App\Http\Requests\VerificationRequest;
use App\Events\UserLoggedIn;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class RegisterService
{
    protected $RegisterRepositoryInterface;

    public function __construct(RegisterRepositoryInterface $RegisterRepositoryInterface)
    {
        $this->RegisterRepositoryInterface = $RegisterRepositoryInterface;
    }

    public function register(RegisterRequest $request) 
    {
        $array = $request->all();
        
        if ($this->RegisterRepositoryInterface->find($request->email)) {
            return response()->json(['message' => __('messages.email_exists')], 422);
        }

        $array['password'] = bcrypt($array['password']);
        $code = rand(100000, 999999);
        $array['code'] = $code;
        $user = $this->RegisterRepositoryInterface->create($array);
        event(new UserLoggedIn($user, $code));
        $accessToken = JWTAuth::fromUser($user);
        return response()->json([
            'user' => $user,
            'Token'=>$accessToken ,
            'message' => 'تم إرسال الرمز إلى بريدك الإلكتروني'
            ],200);
    } 
    public function resend(ResendRequest $request)
    {
       if ($this->RegisterRepositoryInterface->find($request->email)) {
            $user = $this->RegisterRepositoryInterface->get($request->email)->first(); 
            if ($user) {
                $code = rand(100000, 999999);
                $user['code'] = $code;
                $user->save();
                event(new UserLoggedIn($user, $code));
                return response()->json(['user' => $user, 'message' => 'تم إرسال الرمز إلى بريدك الإلكتروني مرة أخرى'], 200);
            }
        } else {
            return response()->json(['message' => 'البريد الإلكتروني غير موجود'], 422);
        }
    }

    public function verification(VerificationRequest $request)
    {
        $user = Auth::user();
        $code = $user->code;
        if ($code == $request->code) {
            $user->role = 'user';
            try {
                $user->save();
                return response()->json(['message' => 'تمت عملية التحقق بنجاح'], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'حدث خطأ أثناء حفظ الدور: ' . $e->getMessage()], 500);
            }
        } else {
            return response()->json(['message' => 'الكود المدخل غير صحيح'], 422);
        }
    }

    public function getuserIn($groupId)
    {
    $user = $this->RegisterRepositoryInterface->getuser($groupId);
    return response()->json(['user' => $user, 'message' => 'All User in Application'], 200);
    }
    public function getuser()
    {
    $user = $this->RegisterRepositoryInterface->getuser();
    return response()->json(['user' => $user, 'message' => 'All User in Application'], 200);
    }
}
