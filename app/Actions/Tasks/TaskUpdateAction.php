<?php

namespace App\Actions\Tasks;

use App\DTO\Tasks\TaskUpdateRequestData;
use App\Repositories\TaskRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;

readonly class TaskUpdateAction
{
    public function __construct(
        private TaskRepository $taskRepository,
    ) { }

    public function execute(int $id, TaskUpdateRequestData $data): void
    {
        DB::transaction(function () use ($data, $id) {
            $task = $this->taskRepository->getById($id);

            if ($task->user_id !== auth()->user()->id) {
                throw new AuthorizationException('You are not authorized to update this task.');
            }

            $this->taskRepository->update($id, $data->toArray());
        });
    }
}
