<?php

namespace Tests\Feature;

use Tests\TestCase;
use Arr;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    // private Task $task;
    // private Collection $labels;

    protected function setUp(): void
    {
        parent::setUp();
        //$this->seed();

        // $user = User::factory()
        //     ->has(Task::factory()->count(3), 'tasks')
        //     ->create();
        // $this->user = Auth::loginUsingId($user->id);
        $this->user = User::factory()->create();
        Task::factory()->count(2)->create();

        //$this->task = $this->user->tasks()->first();
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
        $task = Task::factory()->create();
        $response = $this->actingAs($this->user)
            ->get(route('tasks.edit', [$task]));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $factoryData = Task::factory()->make()->toArray();
        $data = Arr::only($factoryData, ['name', 'status_id']);

        $labels = [Label::factory()->create()->id];
        $dataWithLabels = array_merge($data, ['labels' => $labels]);

        $response = $this->actingAs($this->user)->post(route('tasks.store'), $dataWithLabels);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('tasks', $data);

        $newTask = Task::where($data)->first();
        $this->assertNotNull($newTask);
        $this->assertEquals($newTask->labels()->pluck('label_id')->toArray(), $labels);
    }

    public function testUpdate(): void
    {
        $task = Task::factory()->create();
        $factoryData = Task::factory()->make()->toArray();
        $data = \Arr::only(
            $factoryData,
            ['name', 'description', 'status_id']
        );
        $labels = [Label::factory()->create()->id];

        $dataWithLabels = array_merge($data, ['labels' => $labels]);

        $response = $this->actingAs($this->user)->patch(route('tasks.update', $task), $dataWithLabels);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $data);
        $this->assertEquals($task->labels()->pluck('label_id')->toArray(), $labels);
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
