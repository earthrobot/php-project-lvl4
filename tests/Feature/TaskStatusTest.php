<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        TaskStatus::factory()->count(2)->make();
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testCreate()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(route('task_statuses.create'));
            $response->assertOk();
    }

    public function testEdit()
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        $response = $this->actingAs($user)
            ->get(route('task_statuses.edit', [$taskStatus]));
        $response->assertOk();
    }

    public function testStore()
    {
        $factoryData = TaskStatus::factory()->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->post(route('task_statuses.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testUpdate()
    {
        $taskStatus = TaskStatus::factory()->create();
        $factoryData = TaskStatus::factory()->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->patch(route('task_statuses.update', $taskStatus), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy()
    {
        $user = User::factory()->create();
        $taskStatus = TaskStatus::factory()->create();
        $response = $this->actingAs($user)
            ->delete(route('task_statuses.destroy', [$taskStatus]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('task_statuses', ['id' => $taskStatus->id]);
    }
}
