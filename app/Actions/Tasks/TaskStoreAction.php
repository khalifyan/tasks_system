<?php

namespace App\Actions\Tasks;

use App\DTO\Tasks\TaskStoreRequestData;
use App\Models\Task;
use App\Repositories\TaskRepository;

readonly class TaskStoreAction
{
    public function __construct(
        private TaskRepository $taskRepository,
    ) { }

    public function execute(TaskStoreRequestData $data): Task
    {
        return $this->taskRepository->create($data->toArray());
    }
}
