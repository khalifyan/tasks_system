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

class TaskControllerDestroyTest extends TestCase
{

    public function testDestroyThrows401(): void
    {
        $task = Task::factory()->create([
            'title' => 'Title1',
            'user_id' => auth()->user()->id,
        ]);

        $this->json(Request::METHOD_DELETE, route('tasks.destroy', $task->id), [], [
            'Authorization' => '',
        ])->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testDestroyThrows404ForInvalidIDParameter(): void
    {
        $this->json(Request::METHOD_DELETE, route('tasks.destroy', 0), [], [
            'Authorization' => 'Bearer '.$this->jwt,
        ])->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testDestroyReturnsExpectedValue(): void
    {
        $task = Task::factory()->create([
            'title' => 'Title1',
            'user_id' => auth()->user()->id,
        ]);

        $this->json(Request::METHOD_DELETE, route('tasks.destroy', $task->id), [], [
            'Authorization' => 'Bearer ' . $this->jwt,
        ])->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
            'title' => 'Title1',
            'user_id' => auth()->user()->id,
        ]);
    }

    public function testDestroyThrowsAuthorizationException(): void
    {
        $task = Task::factory()->create([
            'title' => 'Title1',
            'user_id' => User::factory()->create()->id,
        ]);

        $this->json(Request::METHOD_DELETE, route('tasks.destroy', $task->id), [], [
            'Authorization' => 'Bearer ' . $this->jwt,
        ])->assertJsonFragment([
            (new AuthorizationException('You are not authorized to update this task.'))->getMessage()
        ])->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
