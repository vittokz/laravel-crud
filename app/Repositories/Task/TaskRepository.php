<?php

namespace App\Repositories\Eloquent;
namespace App\Repositories\Task;

use App\Models\Task;
use App\Models\Empleado;
use App\Repositories\BaseRepository;

class TaskRepository extends BaseRepository
{

    public function getModel(){
        return new Task();
    }

    public function all()
    {
       $tasks = Task::with('empleado')->get();
       return $tasks;
    }

    public function find($id)
    {
        return Task::find($id);
    }

    public function create($data)
    {
        return Task::create($data);
    }

    public function update($id, $data)
    {
        $task = Task::find($id);
        $task->update($data);
        return $task;
    }

    public function delete($id)
    {
        return Task::destroy($id);
    }
}
