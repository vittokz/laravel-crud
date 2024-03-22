@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-white">CRUD de empleados</h2>
        </div>
        <div>
            <a href="empleado/create" class="btn btn-primary">Crear empleado</a>
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
                <th>Id</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Telefono</th>
                <th>Emáil</th>
                <th>Estado</th>

                <!-- Agrega más columnas según sea necesario -->
            </tr>
        </thead>
    </table>

    <div class="col-12 mt-4">
        <table class="table table-bordered text-white">
            <tr class="text-secondary">
                <th>Id</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Telefono</th>
                <th>Emáil</th>
                <th>Estado</th>
            </tr>

            @foreach ($empleado as $empl )
            <tr>
                <td class="fw-bold">{{ $empl->nombres }}</td>
                <td>{{ $empl->apellidos }}</td>
                <td>{{ $empl->telefono }}</td>
                <td>
                    {{ $empl->email }}
                </td>
                <td>
                    <span class="badge bg-warning fs-6">{{ $empl->status }}</span>
                </td>
                <td>
                    <a href="{{ route('empleado.edit', $empl->id) }}" class="btn btn-warning">Editar</a>

                    <form action="{{ route('empleado.destroy',$empl) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
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
                serverSide: true,
                ajax: 'datos-tabla-empleado',
                columns: [
                    { name: 'id' },
                    { name: 'nombres'},
                    { name: 'apellidos'},
                    { name: 'telefono' },
                    { name: 'email'},
                    { name: 'status' },
                ]
            });
        });
    </script>
