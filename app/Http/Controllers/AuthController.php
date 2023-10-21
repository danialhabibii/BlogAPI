<?php

namespace App\Http\Controllers;

use App\Action\User\LogoutUserAction;
use App\Action\User\RegisterUserAction;
use App\Action\User\UserChangePasswordAction;
use App\Action\User\UserLoginAction;
use App\Http\Requests\User\UserChangePasswordRequest;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRegistrationRequest;
use App\Http\Resources\User\UserTokenResource;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth:sanctum')->only(['changePassword','logout']);
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

    public function changePassword(UserChangePasswordRequest $request, UserChangePasswordAction $changePasswordAction)
    {
        $changePasswordAction->execute($request->user(), $request->validated());
        return $this->ok();
    }

    public function logout(Request $request, LogoutUserAction $logoutUserAction)
    {
        $logoutUserAction->execute($request->user());
        return $this->ok();
    }
}
