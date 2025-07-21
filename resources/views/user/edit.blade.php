@extends('template')
@section('title','Editar Usuario')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Usuario</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
        <li class="breadcrumb-item active">Editar Usuario</li>
    </ol>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <!-- Nombre -->
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
                    @error('name')
                        <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo electrónico:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
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
                        @if(in_array($item->name,$user->roles->pluck('name')->toArray()))
                            <option selected value="{{ $item->name}}" @selected(old('role')==$item->name)>{{$item->name}}
                                {{ $item->nombre }}
                            </option>
                        @else
                            <option selected value="{{ $item->name}}" @selected(old('role')==$item->name)>{{$item->name}}
                                {{ $item->nombre }}
                            </option>
                            @endif
                        @endforeach
                    </select>
                    @error('role_id')
                        <small class="text-danger">{{ '*'.$message }}</small>
                    @enderror
                </div>

                

                <!-- Estado -->
                <div class="col-md-6">
                    <label for="estado" class="form-label">Estado:</label>
                    <select name="estado" id="estado" class="form-control">
                        <option value="1" {{ old('estado', $user->estado) == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado', $user->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <!-- Botón -->
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
