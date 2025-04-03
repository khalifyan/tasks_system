<?php

namespace App\Repositories;

use App\DTO\Tasks\TaskListRequestData;
use App\Models\Task;
use Illuminate\Support\Collection;

class TaskRepository
{

    public function create(array $data): Task
    {
        return Task::query()->create($data);
    }

    public function getList(TaskListRequestData $data): Collection
    {
        $query = Task::query()->where('user_id', $data->userId);

        if ($data->status) {
            $query->where('status', $data->status);
        }

        return $query->get();
    }

    public function update(int $id, array $data): void
    {
        Task::query()->where('id', $id)->update($data);
    }

    public function getById(int $id): Task
    {
        return Task::query()->where('id', $id)->firstOrFail();
    }

    public function delete(int $id): void
    {
        Task::query()->where('id', $id)->delete();
    }
}
