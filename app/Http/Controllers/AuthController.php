<?php

namespace App\Http\Controllers;

use App\Action\User\LogoutUserAction;
use App\Action\User\RegisterUserAction;
use App\Action\User\UserLoginAction;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRegistrationRequest;
use App\Http\Resources\User\UserTokenResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth:sanctum')->only(['logout']);
    }

    public function register(UserRegistrationRequest $request, RegisterUserAction $registerUserAction)
    {
        $registerUserAction->execute($request->validated());
        return $this->created();
    }

    public function login(UserLoginRequest $request, UserLoginAction $userLoginAction)
    {
        try {
            $token = $userLoginAction->execute($request->validated());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        return $this->ok(
            UserTokenResource::make($token),
        );
    }

    public function logout(Request $request, LogoutUserAction $logoutUserAction)
    {
        $logoutUserAction->execute($request->user());
        return $this->ok();
    }
}
