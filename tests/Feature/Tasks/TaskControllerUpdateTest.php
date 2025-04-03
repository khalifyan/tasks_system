<?php

declare(strict_types=1);

namespace Tests\Feature\Tasks;

use App\Enums\TasksStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TaskControllerUpdateTest extends TestCase
{

    public function testUpdateThrows401(): void
    {
        $task = Task::factory()->create([
            'title' => 'Title1',
            'user_id' => auth()->user()->id,
        ]);

        $this->json(Request::METHOD_PUT, route('tasks.update', $task->id), [], [
            'Authorization' => '',
        ])->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testUpdateThrows404ForInvalidIDParameter(): void
    {
        $this->json(Request::METHOD_PUT, route('tasks.update', 0), [
            'title' => 'Title2',
            'user_id' => auth()->user()->id,
            'status' => TasksStatus::completed->value,
        ], [
            'Authorization' => 'Bearer '.$this->jwt,
        ])->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testUpdateThrows400OnValidationException(): void
    {
        $task = Task::factory()->create([
            'title' => 'Title1',
            'user_id' => auth()->user()->id,
        ]);

        $this->json(Request::METHOD_PUT, route('tasks.update', $task->id), [
            'title' => 'Title2',
            'user_id' => auth()->user()->id,
            'status' => 'abc'
        ], [
            'Authorization' => 'Bearer '.$this->jwt,
        ])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function testUpdateReturnsExpectedValue(): void
    {
        $task = Task::factory()->create([
            'title' => 'Title1',
            'user_id' => auth()->user()->id,
        ]);

        $this->json(Request::METHOD_PUT, route('tasks.update', $task->id), [
            'title' => 'Title2',
            auth()->user()->id,
            'status' => TasksStatus::completed->value,
        ], [
            'Authorization' => 'Bearer ' . $this->jwt,
        ])->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Title2',
            'user_id' => auth()->user()->id,
            'status' => TasksStatus::completed->value,
        ]);
    }

    public function testUpdateThrowsAuthorizationException(): void
    {
        $task = Task::factory()->create([
            'title' => 'Title1',
            'user_id' => User::factory()->create()->id,
        ]);

        $this->json(Request::METHOD_PUT, route('tasks.update', $task->id), [], [
            'Authorization' => 'Bearer ' . $this->jwt,
        ])->assertJsonFragment([
            (new AuthorizationException('You are not authorized to update this task.'))->getMessage()
        ])->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
