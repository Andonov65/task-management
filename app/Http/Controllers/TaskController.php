<?php

namespace App\Http\Controllers;

use App\Http\Resources\EditTaskResource;
use App\Http\Resources\TasksResource;
use App\Models\Task;
use Emargareten\InertiaModal\Modal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $filter = $request->input('is_completed');

        $tasks = Task::query()
            ->where('user_id', auth()->id())
            ->when($filter && $filter != 'all',
                fn($query) => $query->where('is_completed', $filter == 'completed')
            )
            ->orderBy('due_date')
            ->get();

        $tasks = TasksResource::collection($tasks);

        $priorities = Task::priorities;

        return Inertia::render('Task/Index', compact('tasks', 'priorities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Modal
    {
        return Inertia::modal('Task/CreateOrEdit', [
            'priorities' => Task::priorities,
        ])->baseRoute('tasks.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'priority' => ['required', 'max:255', Rule::in(Task::priorities)],
            'due_date' => 'required|date',
        ]);

        $task = new Task($validated);
        $task->user()->associate(auth()->id());
        $task->save();

        return to_route('tasks.index')->with('success', 'Successfully Saved!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): Modal
    {
        return Inertia::modal('Task/CreateOrEdit', [
            'priorities' => Task::priorities,
            'task' => EditTaskResource::make($task)
        ])->baseRoute('tasks.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'priority' => ['required', 'max:255', Rule::in(Task::priorities)],
            'due_date' => 'required|date',
        ]);

        $task->fill($validated);
        $task->save();

        return to_route('tasks.index')->with('success', 'Successfully changed!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function completed(Task $task): RedirectResponse
    {
        $task->update(['is_completed' => true]);

        return redirect()->back()->with('success', 'Successfully marked as completed!');
    }
}
