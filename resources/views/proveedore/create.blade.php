@extends('template')
@section('title','Crear proveedor')

@push('css')
<style>
    #decripcion{
        resize:none;
    }
    .input-error {
        border: 2px solid red !important;
        background-color: #ffe6e6;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Proveedor</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item "><a href="{{route('proveedores.index')}}">Proveedores</a></li>
            <li class="breadcrumb-item active">Crear Proveedores</li>
        </ol>

        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3 ">
            <form action="{{route('proveedores.store')}}" method="post">
                @csrf
                <div class="row g-3">

                    <!--tipo persona-->
                    <div class="col-md-6">
                        <label for="tipo_persona" class="form-label">Tipo de proveedor:</label>
                        <select class="form-select" name="tipo_persona" id="tipo_persona">
                            <option value="" selected disable>Seleccione una opcion</option>
                            <option value="natural"{{old('tipo_persona') == 'natural' ? 'selected':'' }}>Persona natural</option>
                            <option value="juridica"{{old('tipo_persona') == 'juridica' ? 'selected':'' }}>Persona juridica</option>
                        </select>
                        @error('tipo_persona')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                    <!--Razon social-->
                    <div class="col-md-12 mt-3">
                            <label id="naturalDiv" style="display:none;" for="razon_social" class="form-label">Nombre completo:</label>
                            <label id="juridicaDiv" style="display:none;"for="razon_social" class="form-label">Nombre de la empresa:</label>
                            <input type="text" class="form-control" name="razon_social" id="razon_social" style="display:none;" value="{{ old('razon_social') }}">
                        @error('razon_social')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror                    
                    </div>
                  
                    <!--Direccion-->
                    <div class="col-md-12 mb-2">                        
                            <label for="direccion" class="form-label">Direccion:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" value="{{ old('direccion') }}">
                        
                        @error('direccion')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror                                            
                    </div>
                    <!-- Teléfono -->
                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="number" name="telefono" id="telefono" class="form-control"
                            value="{{old('telefono')}}">
                        <small class="text-danger d-none" id="error-telefono">El teléfono es obligatorio.</small>
                    </div>
                      <!-- Email -->
                   <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Correo electrónico:</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email') }}">
                    </div>

                    

                          <!--Documento-->
                    <div class="col-md-6">
                        <label for="documento_id" class="form-label">Tipo de documento:</label>
                        <select class="form-select" name="documento_id" id="documento_id">
                            <option value="" selected disable>Seleccione tipo de documento</option>
                            @foreach ($documentos as $item)
                                <option value="{{$item->id}}" {{old('documento_id') == $item->id ? 'selected':''}} >{{$item->tipo_documento}}</option>
                         @endforeach
                        </select>
                        @error('documento_id')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-2">                        
                            <label for="numero_documento" class="form-label">Numero de documento:</label>
                            <input type="text" class="form-control" name="numero_documento" id="numero_documento" value="{{ old('numero_documento') }}">
                        
                        @error('numero_documento')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror                                            
                    </div>
                      
                
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary " >Guardar</button>
                    </div>

           
            </form>
        </div>
</div>

@endsection

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tipoPersona = document.getElementById('tipo_persona');
        const naturalDiv = document.getElementById('naturalDiv');
        const juridicaDiv = document.getElementById('juridicaDiv');
        const razon_social = document.getElementById('razon_social');
        const form = document.getElementById('formProveedores');
        const email = document.getElementById('email');
        const telefono = document.getElementById('telefono');
        const errorEmail = document.getElementById('error-email');
        const errorTelefono = document.getElementById('error-telefono');

        function toggleDivs() {
            if (tipoPersona.value === 'natural') {
                naturalDiv.style.display = 'block';
                juridicaDiv.style.display = 'none';
                razon_social.style.display = 'block';
            } else if (tipoPersona.value === 'juridica') {
                naturalDiv.style.display = 'none';
                juridicaDiv.style.display = 'block';
             
            } else {
                naturalDiv.style.display = 'none';
                juridicaDiv.style.display = 'none';
                razon_social.style.display = 'none';
            }
        }

        tipoPersona.addEventListener('change', toggleDivs);

        
        toggleDivs();
        form.addEventListener('submit', function (event) {
        let valid = true;

            // Validar Email (patrón básico)
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email.value.trim())) {
            email.classList.add('input-error');
            valid = false;
        } else {
            email.classList.remove('input-error');
        }

        // Validar Teléfono (no vacío)
        if (telefono.value.trim() === '') {
            errorTelefono.classList.remove('d-none');
            valid = false;
        } else {
            errorTelefono.classList.add('d-none');
        }

        // Si algo falla, no enviar
        if (!valid) {
            event.preventDefault();
        }
        });
    });
</script>
@endpush

