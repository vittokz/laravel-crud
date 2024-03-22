<?php

namespace App\Http\Controllers;

use  App\Repositories\Task\TaskRepository;
use  App\Services\Task\TaskService;
use  App\Services\Empleado\EmpleadoService;

use App\Models\Task;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Laratables\TaskLaratable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class TaskController extends Controller
{
    protected $taskRepository;
    protected $taskService;
    protected $empleadoService;

    public function __construct(
        TaskRepository $taskRepo,
        TaskService $taskService,
        EmpleadoService $empleadoService
    ) {
        $this->taskRepository = $taskRepo;
        $this->taskService = $taskService;
        $this->empleadoService = $empleadoService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $tasks = Task::latest()->paginate(3);
        // $tasks = $this->taskRepository->getAll();
        //$tasks = Task::all();
        $tasks = $this->taskService->all();
        $tasks = Cache::remember('tasks', now()->addMinutes(10), function () {
            return Task::all();
        });
        return view('index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empleados = $this->empleadoService->all();
        return view('create',['empleados' => $empleados]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('imagen')) { //verificar si existe un archivo con el campo file
            $image = $request->file('imagen'); //obtengo el archivo
            $imageName = time().'.'.$image->getClientOriginalExtension(); // se genera un nombre de archivo unico
            $path = $request->file('imagen')->storeAs('uploads', $imageName, 'public');
            // Guarda el archivo en el directorio "storage/app/public/uploads"
            // Asegúrate de tener el enlace simbólico configurado para la carpeta storage
        }
        $this->taskRepository->create($request->all());
        return redirect()->route('task.index')->with('success', 'Nueva tarea creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function showFile($filename)
    {
        $file = Storage::disk('local')->get("public/uploads/$filename");
        return response($file, 200)->header('Content-Type', 'image/jpeg'); // Cambia el Content-Type según el tipo de archivo que estés subiendo
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //Vivualizamos el formulario
        return view('edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->taskRepository->update($task->id, $request->all());
        return redirect()->route('task.index')->with('success', 'Tarea actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $this->taskRepository->delete($task->id);
        return redirect()->route('task.index')->with('success', 'Tarea eliminada correctamente');
    }

     /**
     * DataTable
     */
    public function datosTablaTask()
    {
        $tasks = Cache::remember('tasks', now()->addMinutes(10), function () {
            return response()->json(Laratables::recordsOf(Task::class, TaskLaratable::class));
        });

        return $tasks;
    }
}
