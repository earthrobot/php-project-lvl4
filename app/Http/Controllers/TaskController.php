<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('crud');
        $task = new Task();
        $task_statuses = TaskStatus::all()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        })->toArray();
        $users = User::all()->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        })->toArray();
        return view('tasks.create', compact('task', 'task_statuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|max:255',
            'status_id' => 'required',
            'assigned_to_id' => ''
        ]);

        $task = new Task();
        $task->fill($data);

        $task->createdBy()->associate(Auth::user());

        if (array_key_exists('assigned_to_id', $data) && $data['assigned_to_id'] != '') {
            $task->assignedTo()->associate($data['assigned_to_id']);
        }

        $task->save();

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
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->authorize('crud');
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $this->validate($request, [
            'name' => 'required|max:255',
            'status_id' => 'required'
        ]);

        $task->fill($data);
        $task->save();

        flash(__('messages.task_update_success'))->success();

        return redirect()
            ->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete-task', $task);
        if ($task) {
            $task->delete();
            flash(__('messages.task_delete_success'))->success();
        }
        return redirect()
            ->route('tasks.index');
    }
}
