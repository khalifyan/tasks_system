<?php

namespace App\Actions\Tasks;

use App\Repositories\TaskRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;

readonly class TaskDestroyAction
{
    public function __construct(
        private TaskRepository $taskRepository,
    ) { }

    public function execute(int $id): void
    {
        DB::transaction(function () use ($id) {
            $task = $this->taskRepository->getById($id);

            if ($task->user_id !== auth()->user()->id) {
                throw new AuthorizationException('You are not authorized to update this task.');
            }

            $this->taskRepository->delete($id);
        });
    }
}
