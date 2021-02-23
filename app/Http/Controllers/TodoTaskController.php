<?php

namespace App\Http\Controllers;

use App\Models\TodoTask;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoTaskController extends Controller
{
    use SessionTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $session = self::is_session('user.list_id');
        if ($session) {
            $tasks = TodoTask::where('todo_list_id', '=', $session)->get();
            return view('tasks.index', compact('tasks'));
        }
        return view('lists.create', ['lists' => []]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $session = self::is_session('user.list_id');
        if ($session) {
            $lists = TodoList::findOrFail($session);
            return view('tasks.create', ['id' => $lists->id]);
        }
        return redirect()->route('todo-list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => ['required', 'string'],
            'is_done' => ['required', 'integer', 'min:1', 'max:4'],
            'todo_list_id' => ['required', 'integer'],
        ]);
        $task = new TodoTask();

        $task->fill($validatedData);
        $task->todoList()->associate($validatedData['todo_list_id']);
        $task->save();
        return redirect()->route('todo-task.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = TodoTask::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string'],
            'is_done' => ['required', 'integer'],
            'todo_list_id' => ['required', 'integer'],
        ]);
        $task = TodoTask::findOrFail($id);

        $task->fill($validatedData);
        $task->todoList()->associate($validatedData['todo_list_id']);
        $task->save();
        return redirect()->route('todo-task.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = TodoTask::find($id);
        $task->delete();

        return redirect()->route('todo-task.index')
            ->with('success', 'Task deleted!');
    }
}
