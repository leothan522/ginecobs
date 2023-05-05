<!-- Main content -->
<div class="invoice p-3 mb-3" xmlns:wire="http://www.w3.org/1999/xhtml">

    <!-- title row -->
    <div class="row">
        @include('dashboard.ginecologia.view_title')
    </div>
    <div class="row invoice-info">
        @include('dashboard.ginecologia.view_datos')
    </div>

    <!-- Button row -->
    <div class="row invoice-info">
        <div class="col-12 mb-3">
            <button type="button" class="btn btn-default btn-sm"
                    data-toggle="modal" data-target="#modal-otros-datos">
                <i class="fas fa-list"></i> Mas Datos
            </button>
            @if(/*$keyword*/false)
                <span class="btn">
                    Resultados de la Búsqueda { <b class="text-danger">{{--{{ $keyword }}--}}hola</b> }
                </span>
                <button class="btn btn-tool text-danger"{{-- wire:click="limpiarArticulos"--}}>
                    <i class="fas fa-times-circle"></i>
                </button>
            @endif

        <!-- Right -->
            <button type="button" class="btn btn-default btn-sm float-right ml-3 mr-1" wire:click="btnAgregar"
                    data-toggle="modal" data-target="#modal-form" @if(!$paciente_id) disabled @endif>
                <i class="fas fa-plus-circle"></i> Agregar
            </button>
            <button type="button" class="btn btn-default btn-sm float-right ml-1 mr-1" wire:click="btnExamenes(1)"
                    @if($table == "examenes_1") disabled @endif>
                <i class="fas fa-id-card-alt"></i> Tabla
            </button>
            <button type="button" class="btn btn-default btn-sm float-right ml-1 mr-1" wire:click="btnExamenes()"
                    @if($table == "control") disabled @endif>
                <i class="fas fa-book-medical"></i> Historico
            </button>
        </div>
    </div>

    <!-- Table row -->
    <div class="row">
        @include('dashboard.ginecologia.table_'.$table)
    </div>

    @include('dashboard.ginecologia.modal_datos')
    @include('dashboard.ginecologia.modal_form')
    @include('dashboard.ginecologia.modal_examen')

    {!! verSpinner() !!}
    {{--<div class="overlay-wrapper" wire:loading wire:target="empresa_id, setEstatus, show">
        <div class="overlay">
            <div class="spinner-border text-navy" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>--}}

</div>
