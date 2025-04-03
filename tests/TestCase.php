<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends BaseTestCase
{
    protected string $jwt;
    protected User $jwtUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->jwt = $this->createJwtToken();
    }

    protected function createJwtToken(): string
    {
        $this->jwtUser = User::factory()->create();
        auth()->login($this->jwtUser);

        return JWTAuth::fromUser($this->jwtUser);
    }
}
