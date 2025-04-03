<?php

namespace App\Actions\Users;

use App\DTO\Users\UserRegisterRequestData;
use App\Models\User;
use App\Repositories\UserRepository;

readonly class UserRegisterAction
{
    public function __construct(
        private UserRepository $userRepository,
    ) { }

    public function execute(UserRegisterRequestData $data): User
    {
        return $this->userRepository->create($data->toArray());
    }
}
