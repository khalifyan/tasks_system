<?php
namespace App\DTO\Tasks;

readonly class TaskStoreRequestData
{
    public function __construct(
        public ?int $userId,
        public string $title,
        public ?string $description,
        public ?string $status,
    ) { }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
