<?php
namespace App\Http\Requests\Tasks;

use App\DTO\Tasks\TaskUpdateRequestData;
use App\Http\Requests\MainRequest;

class TaskUpdateRequest extends MainRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'nullable|integer|exists:users,id',
            'title' => 'nullable|string|min:1|max:255',
            'description' => 'nullable|string|min:1',
            'status' => 'nullable|string|in:new,in_progress,completed'
        ];
    }

    public function dto(): TaskUpdateRequestData
    {
        return new TaskUpdateRequestData(
            $this->input('user_id', auth()->user()->id),
            $this->input('title'),
            $this->input('description'),
            $this->input('status'),
        );
    }
}
