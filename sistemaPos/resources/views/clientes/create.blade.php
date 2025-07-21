@extends('template')
@section('title','Crear clientes')

@push('css')
<style>
    #decripcion{
        resize:none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Clientes</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item "><a href="{{route('clientes.index')}}">Clientes</a></li>
            <li class="breadcrumb-item active">Crear Clientes</li>
        </ol>

        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3 ">
            <form action="{{route('clientes.store')}}" method="post">
                @csrf
                <div class="row g-3">

                    <!--tipo persona-->
                    <div class="col-md-6">
                        <label for="tipo_persona" class="form-label">Tipo de cliente:</label>
                        <select class="form-select" name="tipo_persona" id="tipo_persona">
                            <option value="" selected disable>Seleccione una persona</option>
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
    });
</script>
@endpush

