<?php

namespace App\Services\Task;
use App\Repositories\Task\TaskRepository;

class TaskService {
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository){
        $this->taskRepository = $taskRepository;
    }

    public function all()
    {
        return $this->taskRepository->all();
    }

    public function allByEmpledoId($id)
    {
        return $this->taskRepository->all();
    }
}
