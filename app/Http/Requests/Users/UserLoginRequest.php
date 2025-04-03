<?php
namespace App\Http\Requests\Users;

use App\DTO\Users\UserLoginRequestData;
use App\Http\Requests\MainRequest;

class UserLoginRequest extends MainRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ];
    }

    public function dto(): UserLoginRequestData
    {
        return new UserLoginRequestData(
            $this->input('email'),
            $this->input('password'),
        );
    }
}
