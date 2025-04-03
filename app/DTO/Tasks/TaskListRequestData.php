<?php
namespace App\DTO\Tasks;

readonly class TaskListRequestData
{
    public function __construct(
        public ?int $userId,
        public ?string $status
    ) { }
}
