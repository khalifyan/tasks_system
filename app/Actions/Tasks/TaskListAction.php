<?php

namespace App\Actions\Tasks;

use App\DTO\Tasks\TaskListRequestData;
use App\Repositories\TaskRepository;
use Illuminate\Support\Collection;

readonly class TaskListAction
{
    public function __construct(
        private TaskRepository $taskRepository,
    ) { }

    public function execute(TaskListRequestData $data): Collection
    {
        return $this->taskRepository->getList($data);
    }
}
