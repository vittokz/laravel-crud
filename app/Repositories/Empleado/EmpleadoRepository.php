<?php

namespace App\Repositories\Eloquent;
namespace App\Repositories\Empleado;
use App\Models\Empleado;
use App\Repositories\BaseRepository;

class EmpleadoRepository extends BaseRepository
{

    public function getModel(){
        return new Empleado();
    }

    public function all()
    {
        return Empleado::all();
    }

    public function find($id)
    {
        return Empleado::find($id);
    }

    public function create($data)
    {
        return Empleado::create($data);
    }

    public function update($id, $data)
    {
        $empleado = Empleado::find($id);
        $empleado->update($data);
        return $empleado;
    }

    public function delete($id)
    {
        return Empleado::destroy($id);
    }
}
