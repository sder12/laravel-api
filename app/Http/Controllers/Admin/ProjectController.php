<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects =  Project::paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        //DEBUG
        //dd($request->all());

        $data = $request->validated();
        $data['slug'] = Project::generateSlug($data['title']);
        //If there is the img in the request add to storage folder
        if ($request->hasFile('cover_img')) {
            $path = Storage::put('proj_images', $request->cover_img);
            $data['cover_img'] = $path;
        };

        $project = Project::create($data);

        if ($request->has('technologies')) {
            $project->technologies()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.index')->with('message', "Added new project, titled: $project->title");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // DEBUG
        // dd($project->technologies);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //dd($request->all());
        $data = $request->validated();
        $data['slug'] = Project::generateSlug($data['title']);

        if ($request->hasFile('cover_img')) {
            //Delete previous img
            if ($project->cover_img) {
                Storage::delete($project->cover_img);
            }
            // Save new img
            $path = Storage::put('proj_images', $request->cover_img);
            $data['cover_img'] = $path;
        }

        $project->update($data);

        //IF the request collection is not empty: synch the element inside
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        }
        //ELSE the request is empty: empty the prev collection
        else {
            $project->technologies()->sync([]);
            // $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project->slug)->with('message', "The project $project->title was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->cover_img) {
            Storage::delete($project->cover_img);
        };
        $project->technologies()->detach();
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "$project->title was canceled");
    }
}
