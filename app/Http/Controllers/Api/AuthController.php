<?php
namespace App\Http\Controllers\Api;

use App\Actions\Users\UserCheckLoginAction;
use App\Actions\Users\UserLoginAction;
use App\Actions\Users\UserLogoutAction;
use App\Actions\Users\UserRefreshTokenAction;
use App\Actions\Users\UserRegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserLoginRequest;
use App\Http\Requests\Users\UserRegisterRequest;
use App\Http\Resources\Users\UserResource;
use App\Http\Resources\Users\UserTokenResource;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(
        UserRegisterAction $userRegisterAction,
        UserLoginAction $userLoginAction,
        UserRegisterRequest $request
    ): UserResource {
        $user = $userRegisterAction->execute($request->dto());
        $token = $userLoginAction->execute($user);

        return (new UserResource($user))->withToken($token);
    }

    public function login(
        UserCheckLoginAction $userCheckLoginAction,
        UserLoginRequest $request
    ): UserTokenResource {
        $token = $userCheckLoginAction->execute($request->dto());

        return (new UserTokenResource($request))->withToken($token);
    }

    public function logout(UserLogoutAction $userLogoutAction): Response {
        $userLogoutAction->execute();

        return response()->noContent();
    }

    public function refresh(
        UserRefreshTokenAction $userRefreshTokenAction,
        UserLoginRequest $request
    ): UserTokenResource {
        $token = $userRefreshTokenAction->execute();

        return (new UserTokenResource($request))->withToken($token);
    }
}
