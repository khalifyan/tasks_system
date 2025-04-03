<?php

declare(strict_types=1);

namespace Tests\Feature\Tasks;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TaskControllerStoreTest extends TestCase
{

    public function testStoreThrows401(): void
    {
        $this->json(Request::METHOD_POST, route('tasks.store'), [], [
            'Authorization' => '',
        ])->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testStoreThrows400OnValidationException(): void
    {
        $this->json(Request::METHOD_POST, route('tasks.store'), [], [
            'Authorization' => 'Bearer '.$this->jwt,
        ])->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function testIndexReturnsExpectedValue(): void
    {
        $this->json(Request::METHOD_POST, route('tasks.store'), [
            'title' => 'Title1',
            auth()->user()->id
        ], [
            'Authorization' => 'Bearer ' . $this->jwt,
        ])->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('tasks', [
           'title' => 'Title1',
           'user_id' => auth()->user()->id,
        ]);
    }
}
