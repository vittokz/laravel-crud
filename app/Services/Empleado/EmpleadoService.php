<?php

namespace App\Services\Empleado;
use App\Repositories\Empleado\EmpleadoRepository;

class EmpleadoService {
    protected $empleadoRepository;

    public function __construct(EmpleadoRepository $empleadoRepository){
        $this->empleadoRepository = $empleadoRepository;
    }

    public function all()
    {
        return $this->empleadoRepository->all();
    }

    public function createEmpleado($data){
        return $this->empleadoRepository->create($data);
    }

    public function updateEmpleado($id,$data){
        return $this->empleadoRepository->update($id,$data);
    }

    public function deleteEmpleado($id){
        return $this->empleadoRepository->delete($id);
    }
}
