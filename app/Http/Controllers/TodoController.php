<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    protected $service;

    public function __construct(TodoService $service)
    {
        $this->service = $service;
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $data = $request->only(['title', 'description', 'date', 'completed']);
        $data['user_id'] = $user->id;
        $todo = $this->service->create($data);
        return response()->json($todo, 201);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $data = $request->only(['title', 'description', 'date', 'completed']);
        $todo = $this->service->update($id, $data, $user->id);
        return response()->json($todo);
    }

    public function delete($id)
    {
        $user = Auth::user();
        $this->service->delete($id, $user->id);
        return response()->json(['message' => 'Todo deleted']);
    }

    public function display()
    {
        $user = Auth::user();
        $todos = $this->service->all($user->id);
        return response()->json($todos);
    }
}
