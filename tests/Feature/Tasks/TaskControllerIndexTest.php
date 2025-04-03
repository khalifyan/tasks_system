<?php

declare(strict_types=1);

namespace Tests\Feature\Tasks;

use App\Models\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TaskControllerIndexTest extends TestCase
{

    public function testIndexThrows401(): void
    {
        $this->json(Request::METHOD_GET, route('tasks.index'), [], [
            'Authorization' => '',
        ])->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testIndexReturnsExpectedValue(): void
    {
        $task = Task::factory()->create([
            'user_id' => auth()->user()->id,
        ]);

        $this->json(Request::METHOD_GET, route('tasks.index'), [], [
            'Authorization' => 'Bearer ' . $this->jwt,
        ]);

        $this->json(Request::METHOD_GET, route('tasks.index'), [], [
            'Authorization' => 'Bearer ' . $this->jwt,
        ])->assertJsonFragment([
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'status' => $task->status,
            'user' => $task->user->name . ' ' . $task->user->email,
        ])
            ->assertStatus(Response::HTTP_OK);
    }
}
