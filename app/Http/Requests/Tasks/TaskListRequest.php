<?php
namespace App\Http\Requests\Tasks;

use App\DTO\Tasks\TaskListRequestData;
use App\Http\Requests\MainRequest;

class TaskListRequest extends MainRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'nullable|integer|exists:users,id',
            'status' => 'nullable|string',
        ];
    }

    public function dto(): TaskListRequestData
    {
        return new TaskListRequestData(
            $this->input('user_id', auth()->user()->id),
            $this->input('status'),
        );
    }
}
