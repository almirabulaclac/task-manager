<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Auth::user()->projects()->withCount('tasks')->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string',
            'description' => 'nullable|string',
            'color' => 'required|string',
        ]);

        Auth::user()->projects()->create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created successfully!');
    }

    public function show(Project $project)
    {
        // Make sure user owns this project
        if ($project->userID !== Auth::id()) {
            abort(403);
        }

        $tasks = [
            'todo' => $project->tasks()->where('status', 'todo')->orderBy('position')->get(),
            'in_progress' => $project->tasks()->where('status', 'in_progress')->orderBy('position')->get(),
            'done' => $project->tasks()->where('status', 'done')->orderBy('position')->get(),
        ];

        return view('projects.show', compact('project', 'tasks'));
    }

    public function edit(Project $project)
    {
        if ($project->userID !== Auth::id()) {
            abort(403);
        }

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        if ($project->userID !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'required|string|max:7',
        ]);

        $project->update($validated);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project updated successfully!');
    }

    // Delete project
    public function destroy(Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403);
        }

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}
