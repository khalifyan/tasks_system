<?php

namespace App\Actions\Users;

use App\DTO\Users\UserLoginRequestData;

readonly class UserCheckLoginAction
{
    public function execute(UserLoginRequestData $data): string
    {
        return auth()->attempt($data->toArray());
    }
}
