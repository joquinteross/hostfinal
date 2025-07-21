@extends('template')
@section('title','Crear Usuario')

@push('css')
    <style>
        #descripcion {
            resize: none;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Usuario</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
        <li class="breadcrumb-item active">Crear Usuario</li>
    </ol>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <!-- Nombre -->
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo electrónico:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>

                <!-- Rol -->
                <div class="col-md-6">
                    <label for="role" class="form-label">Rol:</label>
                    <select name="role" id="role" class="form-control">
                        <option value="">Seleccione un rol</option>
                        @foreach ($roles as $item)
                            <option value="{{ $item->name}}" @selected(old('role')==$item->name)>{{$item->name}}
                                {{ $item->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="col-md-6">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @error('password')
                        <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>

                <!-- Confirmar contraseña -->
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Confirmar contraseña:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <!-- Botón -->
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
