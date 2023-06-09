<!-- Main content -->
<div class="invoice p-3 mb-3" xmlns:wire="http://www.w3.org/1999/xhtml">

    <!-- title row -->
    <div class="row">
        @include('dashboard.control.view_title')
    </div>
    <div class="row invoice-info">
        @include('dashboard.control.view_datos')
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
                    data-toggle="modal" data-target="#modal-form" @if(!$paciente_id || $table == "examenes_3") disabled @endif>
                <i class="fas fa-plus-circle"></i> Agregar
            </button>
            <button type="button" class="btn btn-default btn-sm float-right ml-1 mr-3" wire:click="btnExamenes(3)"
                    @if($table == "examenes_3") disabled @endif>
                <i class="fas fa-id-card-alt"></i> Uroanalisis / Urocultivo
            </button>
            <button type="button" class="btn btn-default btn-sm float-right ml-1 mr-1" wire:click="btnExamenes(2)"
                    @if($table == "examenes_2") disabled @endif>
                <i class="fas fa-id-card-alt"></i> Laboratorio 2
            </button>
            <button type="button" class="btn btn-default btn-sm float-right ml-1 mr-1" wire:click="btnExamenes(1)"
                    @if($table == "examenes_1") disabled @endif>
                <i class="fas fa-id-card-alt"></i> Laboratorio 1
            </button>
            <button type="button" class="btn btn-default btn-sm float-right ml-1 mr-1" wire:click="btnExamenes()"
                    @if($table == "control") disabled @endif>
                <i class="fas fa-book-medical"></i> Historico
            </button>
        </div>
    </div>

    <!-- Table row -->
    <div class="row">
        @include('dashboard.control.table_'.$table)
    </div>

    @include('dashboard.control.modal_datos')
    @include('dashboard.control.modal_form')

    {!! verSpinner() !!}

</div>
