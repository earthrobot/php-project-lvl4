<?php

namespace Tests\Feature;

use Tests\TestCase;
use Arr;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;

class TaskTest extends TestCase
{
    private User $user;
    private Task $task;
    private Collection $labels;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->user = User::factory()->create();
        $this->task = Task::factory()
            ->for($this->user, 'createdBy')
            ->create();
        $this->labels = Label::factory(3)->create();
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
        $factoryData = Task::factory()->make()->toArray();
        $data = Arr::only($factoryData, ['name', 'status_id']);

        $labels = $this->labels->pluck('id')->toArray();
        $dataWithLabels = array_merge($data, ['labels' => $labels]);

        $response = $this->actingAs($this->user)->post(route('tasks.store'), $dataWithLabels);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $data);

        $newTask = Task::where($data)->first();
        $this->assertEquals($newTask->labels()->get()->pluck('id')->toArray(), $labels);
    }

    public function testUpdate(): void
    {
        $factoryData = $this->task->toArray();
        $data = Arr::only($factoryData, ['name', 'status_id']);

        $labels = $this->labels->pluck('id')->toArray();
        $dataWithLabels = array_merge($data, ['labels' => $labels]);

        $response = $this->actingAs($this->user)->patch(route('tasks.update', $this->task), $dataWithLabels);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $data);
        $this->assertEquals($this->task->labels()->get()->pluck('id')->toArray(), $labels);
    }

    public function testDestroy(): void
    {
        $response = $this->actingAs($this->user)
            ->delete(route('tasks.destroy', [$this->task]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', ['id' => $this->task->id]);
    }

    public function testDestroyFailsIfUserIsNotCreator(): void
    {
        $response = $this->delete(route('tasks.destroy', [$this->task]));
        $response->assertForbidden();
    }
}
