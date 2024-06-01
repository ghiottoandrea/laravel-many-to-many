<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {

        $projects = Project::orderByDesc('id')->paginate(8);

        return view('admin.projects.index', compact('projects'));

    }

    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('technologies', 'types'));

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

    public function show(Project $project, Type $type)
    {
        $types = Type::all();

        return view('admin.projects.show', compact('project', 'types'));

    }

    public function edit(Project $project, Type $type)
    {

        $technologies = Technology::all();
        $types = Type::all();

        return view('admin.projects.edit', compact('project', 'technologies', 'types'));

    }

    public function update(UpdateProjectRequest $request, Project $project)
    {

        $validated = $request->validated();

        $project->update($validated);

        if ($request->has('preview_image')) {

            if ($project->preview_image) {
                Storage::delete($project->preview_image);
            }

            $image_path = Storage::put('uploads', $validated['preview_image']);
            $validated['preview_image'] = $image_path;
        }

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
