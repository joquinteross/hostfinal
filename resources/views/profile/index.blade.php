@extends('template')

@section('title','Perfil')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('css/template.css')}}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
@endpush

@section('content')
    @if(session('success'))
        <script>
            let message = "{{session('success')}}"
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: message
            });
        </script>
    @endif

<div class="container-fluid">
    <h1 class="mt-4 mb-4 text-center">Configurar perfil</h1>

    <div class="card">
        <div class="card-header">
            <p class="lead fw-bold">Configure su perfil</p>
        </div>
        @if($errors->any())
            @foreach($errors->all() as $item)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{$item}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
            @endforeach
         @endif
        <form action="{{route('profile.update',['profile' => auth()->user() ])}}" method="POST">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-sm-4">

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-square-check"></i> </span>
                        <input disabled type="text" class="forma-control" value="Nombres">
                    </div>
                </div>
                <div class="col-sm-8">
                    
                <input type="text" name="name" id="name" class="form-control" value="{{old('name',$user->name)}}">        
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4">

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-square-check"></i> </span>
                        <input disabled type="text" class="forma-control" value="Email">
                    </div>
                </div>
                <div class="col-sm-8">
                    
                <input type="text" name="email" id="email" class="form-control" value="{{old('email',$user->email)}}">        
                </div>

            </div>
            <div class="row mb-4">
                <div class="col-sm-4">

                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-square-check"></i> </span>
                        <input disabled type="text" class="forma-control" value="Contraseña">
                    </div>
                </div>
                <div class="col-sm-8">
                    
                <input type="text" name="password" id="password" class="form-control" >        
                </div>

            </div>
         

            <div class="card-footer">
                <div class="col text-center">
                    @can('editar-perfil')
                    <input class="btn btn-success" type="submit" value="Guardar cambios">
                    @endcan
                </div>
            </div>

        </form>
    </div>

</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="{{asset('js/datatables-simple-demo.js')}}"></script>
@endpush