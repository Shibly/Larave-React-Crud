<?php


namespace App\Repositories;


use App\Interfaces\CrudInterface;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskRepository implements CrudInterface
{


    public function getAll()
    {
        return Task::all();
    }

    public function findById($id)
    {
        return Task::with('project')
            ->find($id);
    }

    public function create(Request $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->project_id = $request->project_id;
        $task->save();
        return $task;
    }

    public function update(Request $request, $id)
    {
        $task = $this->findById($id);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->project_id = $request->project_id;
        $task->save();
        return $task;
    }

    public function delete($id)
    {
        $task = $this->findById($id);
        $task->delete();
        return $task;
    }


}
