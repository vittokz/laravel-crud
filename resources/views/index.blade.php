@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white">CRUD de Tareas</h2>
        </div>
        <div>
            <a href="task/create" class="btn btn-primary">Crear tarea</a>
        </div>
    </div>

    @if (Session::get('success'))
    <div class="alert alert-success mt-3">
        <strong>{{ Session::get('success') }} </strong><br>
    </div>
    @endif

    <table class="table table-color" style="width:100%" id="tabla">
        <thead>
            <tr>
                <th>Tarea</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Nombres</th>
                <th>Apellido</th>
                <!-- Agrega más columnas según sea necesario -->
            </tr>
        </thead>
    </table>

    <div class="col-12 mt-4">
        <table class="table table-bordered text-white">
            <tr class="text-secondary">
                <th>Nombre completo</th>
                <th>Tarea</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Ver foto</th>

            </tr>

            @foreach ($tasks as $task )
            <tr>
                <td class="fw-bold">{{ $task?->empleado?->nombres }} {{ $task?->empleado?->apellidos }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>
                    {{ $task->due_date }}
                </td>
                <td>
                    <span class="badge bg-warning fs-6">{{ $task->status }}</span>
                </td>
                <td>
                    <a href="{{ route('task.edit', $task->id) }}" class="btn btn-warning">Editar</a>

                    <form action="{{ route('task.destroy',$task) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
                <td> <a target="_blank" href="{{  route ('view-file', '1711049056.jpg') }}">Ver</td>
            </tr>
            @endforeach


        </table>
        {{-- {{ $tasks->links() }} --}}
    </div>
</div>
@endsection

<!-- Agrega jQuery y DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
     <script>
        $(document).ready(function() {
            $('#tabla').DataTable({
                processing: true,
                serverSide: true,
                ajax: 'datos-tabla',
                autoWidth: true,
                "order": [[3, "asc"]],
                columns: [
                    { name: 'title'},
                    { name: 'description'},
                    { name: 'due_date' },
                    { name: 'status'},
                    { name: 'empleado.nombres' },
                    { name: 'empleado.apellidos' },
                ],
                columnDefs: [
                        {
                            'targets': [0, 1],
                            'searchable': true,
                            'class': "small text-left"
                        },
                        {
                            'targets': [2],
                            'searchable': true,
                            'class': "small text-center"
                        },
                        {
                            'targets': [3],
                            'searchable': true,
                            'class': "small text-left"
                        },
                        {
                            'targets': [4,5],
                            'searchable': true,
                            'class': "small text-left"
                        }
                    ],

                destroy: true,
                scrollCollapse: true,
                iDisplayLength: 10,
                deferRender: true,
                language: {
                        lengthMenu: 'Mostrar _MENU_ registros',
                        processing: '<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span> Cargando Información...</span><span class="sr-only">Cargando...</span>',
                        loadingRecords: 'Cargando...',
                        zeroRecords: 'No se encontraron resultados',
                        infoFiltered: '(filtrado de un total de _MAX_ registros) ',
                        infoEmpty: 'Mostrando registros del 0 al 0 de un total de 0 registros. ',
                        emptyTable: 'Ningún dato disponible en esta tabla',
                        info: 'Mostrando <b>_START_ a _END_</b> de _TOTAL_ registros. ',
                        select: {
                            rows: {
                                _: "Tienes seleccionadas %d filas",
                                0: "<b>Click</b> en una fila para seleccionarla",
                                1: "1 fila seleccionada"
                            }
                        }
                    },
            });
        });
    </script>

