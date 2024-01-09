<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TaskStatus;
use App\Models\Priority;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all tasks, descending order
        $tasks = Task::orderBy('priority', 'desc')
            ->orderBy('id', 'desc')
            ->get();



        //send to view
        return view('tasks.index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //get task statuses from table task_status
        $taskStatuses = TaskStatus::all();

        //get all tasks
        $tasks = Task::all();

        //get all users
        $users = User::all();
        //send to view
        return view('tasks.create', [
            'users' => $users,
            'taskStatuses' => $taskStatuses,
            'taskPriorities' => Priority::all(),
            'tasks' => $tasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate request form data
        $task = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required|integer',
            'dependencies' => 'array',
            'attachments' => 'array',
            'priority' => 'required|integer',
            'comments' => 'nullable:string',
            'tags' => 'nullable:string',
            'assigned_to' => 'integer:required'
        ]);

        //user_id from logged in user, defines who originally created the task
        $task['user_id'] = auth()->id();
        //assigned_at from now
        $task['assigned_at'] = now();
        //assigned_by from logged in user, defines who assigned the task or reassigned the task last
        $task['assigned_by'] = auth()->id();

        $task['dependencies'] = json_encode($task['dependencies'] ?? []);
        $task['attachments'] = json_encode($task['attachments'] ?? []);

        $task['created_by'] = auth()->id();
        $task['created_at'] = now();

        Task::create($task);

        return redirect()->route('tasks.index')->with('success', __('messages.task-created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task,
            'users' => User::all(),
            'taskStatuses' => TaskStatus::all(),
            'taskPriorities' => Priority::all(),
            'tasks' => Task::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //validate request form data
        $taskVal = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required|integer',
            'dependencies' => 'array',
            'attachments' => 'array',
            'priority' => 'required|integer',
            'comments' => 'nullable:string',
            'tags' => 'nullable:string',
            'assigned_to' => 'integer:required'
        ]);

//        dd($taskVal['dependencies']);

        //user_id from logged in user, defines who originally created the task
        $taskVal['user_id'] = auth()->id();
        //assigned_at from now
        $taskVal['assigned_at'] = now();
        //assigned_by from logged in user, defines who assigned the task or reassigned the task last
        $taskVal['assigned_by'] = auth()->id();

        //Update task but add updated_at and updated_by
        $task->update(array_merge($taskVal, array('updated_at' => now(),'updated_by' => auth()->id())));

        //redirect to the current task
        return redirect()->route('tasks.edit', $task)->with('success', __('messages.task-updated'));
    }

    public function assignTask(Request $request, Task $task)
    {
        //TODO: TEST THIS CODE (UNTESTED)

        //get task
        $task = Task::find($request->id);

        //update task with assigned_to and assigned_to_at
        $task->update([
            'assigned_to' => $request->assigned_to,
            'assigned_to_at' => now()
        ]);

        //redirect to tasks.index with flash message, use lang file
        return redirect()->route('tasks.index')->with('success', __('messages.task-updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //delete task
        $task->delete();

        //redirect to tasks.index with flash message, use lang file
        return redirect()->route('tasks.index')->with('success', __('messages.task-deleted'));
    }
}
