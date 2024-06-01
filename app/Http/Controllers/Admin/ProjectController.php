<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;

class ProjectController extends Controller
{
    public function index()
    {

        $projects = Project::orderByDesc('id')->paginate(8);

        return view('admin.projects.index', compact('projects'));

    }

    public function create()
    {

        $technologies = Technology::all();

        return view('admin.projects.create', compact('technologies'));

    }

    public function store(StoreProjectRequest $request)
    {

        $validated = $request->validated();

        $project = Project::create($validated);

        if ($request->has('technologies')) {
            $project->technologies()->attach($validated['technologies']);
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');

    }

    public function show(Project $project)
    {

        return view('admin.projects.show', compact('project'));

    }

    public function edit(Project $project)
    {

        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'technologies'));

    }

    public function update(UpdateProjectRequest $request, Project $project)
    {

        $validated = $request->validated();

        $project->update($validated);

        //$technologies = Technology::all();

        if ($request->has('technologies')) {
            $project->technologies()->sync($validated['technologies']);
        } else {
            $project->technologies()->sync([]);
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');

    }

    public function destroy(Project $project)
    {

        $project->delete();

        return to_route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');

    }
}
