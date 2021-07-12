<?php

namespace Tests\Feature;

use Tests\TestCase;
use Arr;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Task $task;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->task = Task::factory()->hasLabels(2)->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('tasks.edit', [$this->task]));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $taskDataForStore = Task::factory()
            ->for($this->user)
            ->make()
            ->toArray();

        $response = $this->actingAs($this->user)->post(route('tasks.store'), $taskDataForStore);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $taskDataForStore);
    }

    public function testUpdate(): void
    {
        $taskData = $this->task->toArray();
        $taskDataForChanging = \Arr::only(
            $taskData,
            ['name', 'status_id', 'assigned_to_id', 'description']
        );

        $response = $this->actingAs($this->user)->patch(route('tasks.update', $this->task), $taskDataForChanging);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $taskDataForChanging);
    }

    public function testDestroy(): void
    {
        $task = Task::factory()
            ->for($this->user)
            ->create();
        $response = $this->actingAs($this->user)
            ->delete(route('tasks.destroy', [$task]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function testDestroyFailsIfUserIsNotCreator(): void
    {
        $task = Task::factory()->create();
        $response = $this->delete(route('tasks.destroy', [$task]));
        $response->assertForbidden();
    }
}
