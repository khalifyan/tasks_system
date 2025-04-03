<?php

namespace App\Actions\Users;

use App\Models\User;

readonly class UserLoginAction
{
    public function execute(User $user): string
    {
        return auth()->login($user);
    }
}
