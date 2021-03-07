<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $taskStatus;

    protected function setUp(): void
    {
        parent::setUp();
        \Artisan::call('migrate');
        \Artisan::call('db:seed');

        $this->user = User::factory()->create();
        $this->taskStatus = TaskStatus::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testEdit(): void
    {
        //$taskStatus = TaskStatus::factory()->create();
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.edit', [$this->taskStatus]));
        $response->assertOk();
        //$taskStatus->delete();
    }

    public function testStore(): void
    {
        $factoryData = TaskStatus::factory()->make()->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->post(route('task_statuses.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
        //$taskStatus = TaskStatus::orderBy('id', 'desc')->take(1);
        //$taskStatus->delete();
    }

    public function testUpdate(): void
    {
        //$taskStatus = TaskStatus::factory()->create();
        $factoryData = $this->taskStatus->toArray();
        $data = \Arr::only($factoryData, ['name']);
        $response = $this->patch(route('task_statuses.update', $this->taskStatus), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
        //$taskStatus->delete();
    }

    public function testDestroy(): void
    {
        //$taskStatus = TaskStatus::factory()->create();
        $response = $this->actingAs($this->user)
            ->delete(route('task_statuses.destroy', [$this->taskStatus]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('task_statuses', ['id' => $this->taskStatus->id]);
        //$taskStatus->delete();
    }
}
