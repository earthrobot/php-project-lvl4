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
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->get();

        $taskStatuses = TaskStatus::all()->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');

        $filter = $request->get('filter');

        return response()
            ->view('tasks.index', compact('tasks', 'taskStatuses', 'users', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task();
        $taskStatuses = TaskStatus::all()->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');
        $labels = Label::all()->pluck('name', 'id');

        return response()
            ->view('tasks.create', compact('task', 'taskStatuses', 'users', 'labels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->validate($request, [
            'name' => 'required|max:255',
            'status_id' => 'required'
        ]);

        $task = new Task();
        $task->fill($data);

        $task->user()->associate(Auth::user());

        if (isset($data['assigned_to_id'])) {
            $task->assignedTo()->associate($data['assigned_to_id']);
        }

        $task->save();

        $labels = collect($request->input('labels'))->filter(fn($label) => $label !== null);
        $task->labels()->sync($labels);


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
        $taskStatuses = TaskStatus::all()->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');
        $labels = Label::all()->pluck('name', 'id');

        return response()
            ->view('tasks.edit', compact('task', 'taskStatuses', 'users', 'labels'));
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
        $data = $request->all();

        $this->validate($request, [
            'name' => 'required|max:255',
            'status_id' => 'required'
        ]);

        $task->fill($data);

        if (isset($data['assigned_to_id'])) {
            $task->assignedTo()->associate($data['assigned_to_id']);
        }

        $task->save();

        $labels = collect($request->input('labels'))->filter(fn($label) => $label !== null);
        $task->labels()->sync($labels);

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
        $task->delete();
        flash(__('messages.task_delete_success'))->success();

        return redirect()
            ->route('tasks.index');
    }
}
