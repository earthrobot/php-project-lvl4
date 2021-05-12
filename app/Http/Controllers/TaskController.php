<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Arr;

class TaskController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd(Auth::user()->assigned_tasks()->get());
        dd(Task::find(1)->status()->get());
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->get();

        $task_statuses = TaskStatus::all()->mapWithKeys(function ($item): array {
            return [$item['id'] => $item['name']];
        })->toArray();
        $users = User::all()->mapWithKeys(function ($item): array {
            return [$item['id'] => $item['name']];
        })->toArray();

        $filter = $request->get('filter');

        return response()
            ->view('tasks.index', compact('tasks', 'task_statuses', 'users', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task();
        $task_statuses = TaskStatus::all()->mapWithKeys(function ($item): array {
            return [$item['id'] => $item['name']];
        })->toArray();
        $users = User::all()->mapWithKeys(function ($item): array {
            return [$item['id'] => $item['name']];
        })->toArray();
        $labels = Label::all()->mapWithKeys(function ($item): array {
            return [$item['id'] => $item['name']];
        })->toArray();

        return response()
            ->view('tasks.create', compact('task', 'task_statuses', 'users', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|max:255',
            'description' => '',
            'status_id' => 'required',
            'assigned_to_id' => '',
            'labels' => ''
        ]);

        $task = new Task();
        $task->fill($data);

        $task->createdBy()->associate(Auth::user());

        if (array_key_exists('assigned_to_id', $data) && $data['assigned_to_id'] != '') {
            $task->assignedTo()->associate($data['assigned_to_id']);
        }

        $task->save();

        if (array_key_exists('labels', $data)) {
            $labels = array_filter($data['labels']);
            $task->labels()->sync(Arr::wrap($labels));
        }

        flash(__('messages.task_store_success'))->success();

        return redirect()
            ->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()
            ->view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $task_statuses = TaskStatus::all()->mapWithKeys(function ($item): array {
            return [$item['id'] => $item['name']];
        })->toArray();
        $users = User::all()->mapWithKeys(function ($item): array {
            return [$item['id'] => $item['name']];
        })->toArray();
        $labels = Label::all()->mapWithKeys(function ($item): array {
            return [$item['id'] => $item['name']];
        })->toArray();

        return response()
            ->view('tasks.edit', compact('task', 'task_statuses', 'users', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        $data = $this->validate($request, [
            'name' => 'required|max:255',
            'description' => '',
            'status_id' => 'required',
            'assigned_to_id' => '',
            'labels' => ''
        ]);

        $task->fill($data);

        if (array_key_exists('assigned_to_id', $data) && $data['assigned_to_id'] != '') {
            $task->assignedTo()->associate($data['assigned_to_id']);
        }

        if (array_key_exists('labels', $data)) {
            $labels = array_filter($data['labels']);
            $task->labels()->sync(Arr::wrap($labels));
        }

        $task->save();

        flash(__('messages.task_update_success'))->success();

        return redirect()
            ->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        if ($task->exists()) {
            $task->delete();
            flash(__('messages.task_delete_success'))->success();
        }
        return redirect()
            ->route('tasks.index');
    }
}
