<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // $projects = Project::all();
        // $projects = Project::with('type', 'technologies')->get();
        $projects = Project::with('type', 'technologies')->paginate(3);
        return  response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    public function show($slug)
    {
        // dd($slug)   
        $project = Project::with('type', 'technologies')->where('slug', $slug)->first();
        // dd($project);
        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'err' => 'Project not found',
            ]);
        }
    }
}
