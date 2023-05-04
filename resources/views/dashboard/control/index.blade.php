@extends('adminlte::page')

@section('plugins.Sweetalert2', true)
@section('plugins.Pace', true)
@section('plugins.Select2', true)

@section('title', 'Control Prenatal')

@section('content_header')
    <div class="container-fluid">
        {{--<div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-book-medical"></i> Control Prenatal</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pacientes Registrados</li>
                </ol>
            </div>
        </div>--}}
    </div>
@endsection

@section('content')
    <livewire:dashboard.control-component />
@endsection

@section('right-sidebar')
    @include('dashboard.control.right-sidebar')
@endsection

@section('footer')
    @include('dashboard.footer')
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css">--}}
@endsection

@section('js')
    <script src="{{ asset('js/start.js') }}"></script>
    <script>
        /*function verAntecedentes() {
            Livewire.emit('limpiarAntecedentes');
        }*/
        $('.js-example-basic-single').select2();
        //$('.js-example-basic-single').val(null).trigger('change');
        $('.js-example-basic-single').on('change', function() {
            var val = $(this).val();
            if (val != ""){
                Livewire.emit('setPacienteActivo', val);
            }

        });

        console.log('Hi!');
    </script>
@endsection


