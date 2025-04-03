<?php

namespace App\Actions\Users;

readonly class UserLogoutAction
{
    public function execute(): ?string
    {
        return auth()->logout();
    }
}
