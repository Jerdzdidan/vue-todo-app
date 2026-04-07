<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->user()->todos()->latest();

        if ($filter = $request->input('filter')) {
            match ($filter) {
                'active' => $query->where('completed', false),
                'completed' => $query->where('completed', true),
                default => null,
            };
        }

        return response()->json($query->get());
    }

    public function stats(Request $request)
    {
        $todos = $request->user()->todos();

        return response()->json([
            'total' => $todos->count(),
            'active' => (clone $todos)->where('completed', false)->count(),
            'completed' => (clone $todos)->where('completed', true)->count(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'priority' => 'in:low,medium,high',
            'category' => 'nullable|string|max:100',
        ]);

        $todo = $request->user()->todos()->create($validated);

        return response()->json($todo, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        // $this->authorized('update', $todo);

        $validated = $request->validate([
            'text' => 'sometimes|string|max:255',
            'completed' => 'sometimes|boolean',
            'priority' => 'sometimes|in:low,medium,high',
            'category' => 'sometimes|nullable|string|max:100',
        ]);

        $todo->update($validated);

        return response()->json($todo);
    }

    public function toggle(Todo $todo)
    {
        $todo->update(['completed' => !$todo->completed]);
        return response()->json($todo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function clearCompleted(Request $request)
    {
        $request->user()->todos()->where('completed', true)->delete();
        return response()->json(['message' => 'Cleared']);
    }
}
