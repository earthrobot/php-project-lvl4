<?php

namespace Tests\Feature;

use Tests\TestCase;
use Arr;
use App\Models\User;
use App\Models\Label;
use Illuminate\Support\Facades\Auth;

class LabelTest extends TestCase
{
    private User $user;
    private Label $label;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()
            ->has(Label::factory()->count(3), 'labels')
            ->create();
        $this->user = Auth::loginUsingId($user->id);
        $this->label = $this->user->labels()->first();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->get(route('labels.create'));
        $response->assertOk();
    }

    public function testEdit(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('labels.edit', [$this->label]));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $factoryData = Label::factory()->make()->toArray();
        $data = Arr::only($factoryData, ['name']);
        $response = $this->post(route('labels.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testUpdate(): void
    {
        $factoryData = $this->label->toArray();
        $data = Arr::only($factoryData, ['name']);
        $response = $this->patch(route('labels.update', [$this->label]), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testDestroy(): void
    {
        $response = $this->actingAs($this->user)
            ->delete(route('labels.destroy', [$this->label]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('labels', ['id' => $this->label->id]);
    }
}
