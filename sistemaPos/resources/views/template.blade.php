<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Sistemas de ventas" />
        <meta name="author" content="Vanessa Restrepo" />
        <title>Sistema Ventas - @yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{ asset('css/template.css')}}" rel="stylesheet" />
        
        @stack('css')
    </head>
    @auth <!--vista solo para usuarios autenticados-->
    <body class="sb-nav-fixed">
        <x-navigation-header/>  <!--componente nav header esta en components-->

        <div id="layoutSidenav">
            <x-navigation-menu></x-navigation-menu>
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                   <x-footer></x-footer> 
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <script src="{{asset('js/scripts.js')}}"></script>
        @stack('js')
        
    </body>
    @endauth
    @guest
        @include('pages.401')
    @endguest
</html>
