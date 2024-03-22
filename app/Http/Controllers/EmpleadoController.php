<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Freshbitsweb\Laratables\Laratables;
use App\Services\Empleado\EmpleadoService;

class EmpleadoController extends Controller
{
    protected $empleadoService;

    public function __construct(EmpleadoService $empleadoService) {
        $this->empleadoService = $empleadoService;
    }

    public function index()
    {
        $empleado = $this->empleadoService->all();
        return view('empleado/index', ['empleado' => $empleado]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleado/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());
       $request->validate([
        'nombres'=> 'required',
        'apellidos'=> 'required',
        'telefono'=> 'required',
        'email'=> 'required'
    ]);
    $this->empleadoService->createEmpleado($request->all());
    return redirect()->route('empleado.index')->with('success','Nuevo empleado creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        return view('empleado/edit',['empleado'=> $empleado]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'nombres'=> 'required',
            'apellidos'=> 'required',
            'telefono'=> 'required',
            'email'=> 'required'
        ]);

        $empleado = $this->empleadoService->updateEmpleado($id, $data);
        return redirect()->route('empleado.index')->with('success','Empleado actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->empleadoService->deleteEmpleado($id);
        return redirect()->route('empleado.index')->with('success','Empleado eliminado correctamente');

    }

      /**
     * DataTable
     */
    public function datosTablaEmpleado(Request $request)
    {
         $data = Laratables::recordsOf(Empleado::class);
         return response()->json(Laratables::recordsOf(Empleado::class));
    }
}
