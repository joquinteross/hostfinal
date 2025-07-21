@extends('template')
@section('title', 'Presentaciones')
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

    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Productos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
            <li class="breadcrumb-item active">Productos</li>
        </ol>
        <div class="mb-4">
            <a href="{{route('productos.create')}}">
                <button type="button" class="btn btn-primary">Añadir nuevo producto</button>
            </a>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla de Productos
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table-striped fs-6">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Presentacion</th>
                            <th>Categorias</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $item)
                            <tr>
                                <td>{{ $item->codigo }}</td>
                                <td>{{ $item->nombre }}</td>
                                <td>{{ $item->marca->caracteristica->nombre ?? 'Sin marca' }}</td>
                                <td>{{ $item->presentacione->caracteristica->nombre ?? 'Sin presentación' }}</td>
                                <td>
                                    @foreach ($item->categorias as $categoria)
                                        {{ $categoria->caracteristica->nombre }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($item->estado == 1)
                                        <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                                    @else
                                        <span class="fw-bolder p-1 rounded bg-danger text-white">Eliminado</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        {{-- Editar --}}
                                        <form action="{{ route('productos.edit', ['producto' => $item]) }}">
                                            <button type="submit" class="btn btn-warning">Editar</button>
                                        </form>

                                        {{-- Ver detalles --}}
                                        <button type="button"
                                                class="btn btn-success"
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewModal-{{ $item->id }}">
                                            Ver
                                        </button>
                                        @if ($item->estado == 1)

                                        <button type="button"
                                                class="btn btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmModal-{{ $item->id }}">
                                            Eliminar
                                        </button>

                                        @else

                                        <button type="button"
                                                class="btn btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmModal-{{ $item->id }}">
                                            Restaurar
                                        </button>
                                        
                                        @endif
                                        

                                        
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal de detalles (Ver) --}}
                            <div class="modal fade" id="viewModal-{{ $item->id }}" tabindex="-1"
                                 aria-labelledby="viewModalLabel-{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel-{{ $item->id }}">
                                                Detalle del producto
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Descripción:</strong> {{ $item->descripcion }}</p>
                                            <p><strong>Fecha de vencimiento:</strong>
                                                {{ $item->fecha_vencimiento ?: 'No tiene' }}</p>
                                            <p><strong>Stock:</strong> {{ $item->stock }}</p>
                                            <p><strong>Imagen:</strong></p>
                                            @if ($item->img_path)
                                                <img src="{{ asset('img/productos/' . $item->img_path) }}"
                                                     alt="{{ $item->nombre }}"
                                                     class="img-fluid img-thumbnail border border-4 rounded">
                                            @else
                                                <p>Sin imagen</p>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal de confirmación --}}
                            <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1"
                                 aria-labelledby="confirmModalLabel-{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmModalLabel-{{ $item->id }}">
                                                Mensaje de confirmación
                                            </h5>
                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $item->estado == 1
                                               ? '¿Seguro que quieres eliminar este producto?'
                                               : '¿Seguro que quieres reactivar este producto?' }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal">
                                                Cerrar
                                            </button>
                                            <form action="{{ route('productos.destroy', ['producto' => $item->id]) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    {{ $item->estado == 1 ? 'Eliminar' : 'Reactivar' }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush