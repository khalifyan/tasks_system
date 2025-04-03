<?php
namespace App\Http\Requests\Users;

use App\DTO\Users\UserRegisterRequestData;
use App\Http\Requests\MainRequest;

class UserRegisterRequest extends MainRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ];
    }

    public function dto(): UserRegisterRequestData
    {
        return new UserRegisterRequestData(
            $this->input('name'),
            $this->input('email'),
            $this->input('password'),
        );
    }
}
