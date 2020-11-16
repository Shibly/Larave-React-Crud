<?php


namespace App\Repositories;


use App\Interfaces\CrudInterface;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectRepository implements CrudInterface
{


    public function getAll()
    {
        return Project::all();
    }

    public function findById($id)
    {
        return Project::with('tasks')->find($id);
    }

    /**
     * @param Request $request
     * @return Project
     */
    public function create(Request $request)
    {
        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->user_id = $request->user_id;
        $project->save();

        return $project;

    }

    public function update(Request $request, $id)
    {
        $project = $this->findById($id);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->user_id = $request->user_id;
        $project->save();

        return $project;

    }

    public function delete($id)
    {
        $project = $this->findById($id);
        $project->delete();
        return $project;
    }
}
