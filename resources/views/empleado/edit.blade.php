@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>Actualizar Empleado</h2>
        </div>
        <div>
            <a href="{{route('empleado.index')}}" class="btn btn-primary">Volver</a>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <strong>Error..!</strong> Algo fue mal..<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('empleado.update', $empleado) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Nombres:</strong>
                    <input type="text" name="nombres" class="form-control" placeholder="Nombres" value="{{ $empleado->nombres}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Apellidos:</strong>
                    <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" value="{{ $empleado->apellidos}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Teléfono:</strong>
                    <input type="number" name="telefono" class="form-control" placeholder="Teléfono" value="{{ $empleado->telefono}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Emáil:</strong>
                    <input type="text" name="email" class="form-control" value="{{ $empleado->email}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                <div class="form-group">
                    <strong>Estado (inicial):</strong>
                    <select name="status" class="form-select" id="">
                        <option value="">-- Elige el status --</option>
                        <option value="Activo" @selected("Activo"== $empleado->status)>Activo</option>
                        <option value="Inactivo" @selected("Inactivo"== $empleado->status)>Inactivo</option>
                        <option value="Creado" @selected("Creado"== $empleado->status)>Creado</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </form>
</div>
@endsection
