@extends('adminlte::page')

@section('plugins.Sweetalert2', true)
@section('plugins.Pace', true)

@section('title', 'Usuarios')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-users"></i> Usuarios</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    <li class="breadcrumb-item active">Usuarios Registrados</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@stop

@section('content')

    @livewire('usuarios-component')
    {{--@livewire('roles-component')--}}

@stop

@section('footer')
    @include('dashboard.footer')
@stop

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
    <script src="{{ asset('js/start.js') }}"></script>
    <script>
        console.log('Hi!');
    </script>
@stop
