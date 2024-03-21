<?php

namespace App\Http\Controllers;

use App\Http\Resources\TasksResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TaskController extends Controller
{
    public function index(Request $request): Response
    {
        $tasks = Task::query()->where('user_id', auth()->id())->get();

        $tasks = TasksResource::collection($tasks);

        return Inertia::render('Task/Index', compact('tasks'));
    }
}
