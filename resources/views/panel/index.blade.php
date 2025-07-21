@extends('template')

@section('title')
@push('css')
    
<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
<script src="https://cdn.plot.ly/plotly-3.0.1.min.js"></script>

@endpush            

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Infomacion General</h1>
    <div class="row">
          <!----Clientes--->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-people-group"></i><span class="m-1">Clientes</span>
                        </div>
                        <div class="col-4">
                            <?php

                            use App\Models\Cliente;

                            $clientes = count(Cliente::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$clientes}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('clientes.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!----Compra--->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-store"></i><span class="m-1">Compras</span>
                        </div>
                        <div class="col-4">
                            <?php

                            use App\Models\Compra;

                            $compras = count(Compra::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$compras}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('compras.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!----Producto--->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-brands fa-shopify"></i><span class="m-1">Productos</span>
                        </div>
                        <div class="col-4">
                            <?php

                            use App\Models\Producto;

                            $productos = count(Producto::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$productos}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('productos.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <!----Users--->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-user"></i><span class="m-1">Usuarios</span>
                        </div>
                        <div class="col-4">
                            <?php

                            use App\Models\User;

                            $users = count(User::all());
                            ?>
                            <p class="text-center fw-bold fs-4">{{$users}}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('users.index') }}">Ver más</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        Grafico de barras
                    </div>
                    <div class="card-body">
                        <div id="idgrafica"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        Gráfico de pie
                    </div>
                    <div class="card-body">
                        <div id="idgrafica2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


                   

@endsection

@push('js')
<script>
        function graficar() {
            var viernes = 0;
            var sabado = 0;
            var domingo = 0;
            var motocicleta = 0;
            var bicicleta = 0;
            var peaton = 0;
            var taxi = 0;
            var particular = 0;
            var finDeSemana = [];
            var dias = ['viernes', 'sabado', 'domingo'];
            var cantvehi = [];
            var vehi = ['Motocicleta', 'Bicicleta', 'Peatón', 'Taxi', 'Vehículo Particular'];

            fetch("https://www.datos.gov.co/resource/wwir-6riq.json")
                .then(response => response.json())
                .then(data => {
                    data.forEach(item => {
                        switch (item.dia_de_la_semana) {
                            case "viernes":
                                viernes += 1;
                                break;
                            case "sabado":
                                sabado += 1;
                                break;
                            case "domingo":
                                domingo += 1;
                                break;
                        }

                        switch (item.vehiculo_de_la_victima) {
                            case "Motocicleta":
                                motocicleta += 1;
                                break;
                            case "Bicicleta":
                                bicicleta += 1;
                                break;
                            case "Autónomo (Peatón)":
                                peaton += 1;
                                break;
                            case "Taxi":
                                taxi += 1;
                                break;
                            case "Vehiculo particular":
                                particular += 1;
                                break;
                        }
                    });

                    finDeSemana.push(viernes, sabado, domingo);
                    cantvehi.push(motocicleta, bicicleta, peaton, taxi, particular);

                    var data = [{
                        x: dias,
                        y: finDeSemana,
                        type: 'bar',
                        marker: { color: 'blue' }
                    }];

                    var layout = {
                        title: 'Accidentes en fin de semana',
                        barmode: 'group'
                    };

                    Plotly.newPlot('idgrafica', data, layout);

                    var data2 = [{
                        labels: vehi,
                        values: cantvehi,
                        type: 'pie'
                    }];

                    var layout2 = {
                        title: 'Accidentes por tipo de vehículo',
                        height: 400,
                        width: 500
                    };

                    Plotly.newPlot('idgrafica2', data2, layout2);
                });
        }

        document.addEventListener('DOMContentLoaded', graficar);
    </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('js/datatables-simple-demo.js')}}"></script>
endpush