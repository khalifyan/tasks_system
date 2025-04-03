<?php

namespace App\Actions\Users;

readonly class UserRefreshTokenAction
{
    public function execute(): string
    {
        return auth()->refresh();
    }
}
