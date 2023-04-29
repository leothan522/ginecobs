<div class="card card-navy" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;"
     xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="card-header">
        <h3 class="card-title">
            @if($new_paciente) Nuevo Paciente @endif
            @if(!$new_paciente && $view == 'form') Editar Paciente @endif
            @if(!$new_paciente && $view != "form") Ver Paciente @endif
        </h3>
        <div class="card-tools">
            {{--<span class="btn btn-tool"><i class="fas fa-list"></i></span>--}}
            @if($btn_nuevo) <button class="btn btn-tool" wire:click="create"><i class="fas fa-file"></i> Nuevo</button> @endif
            @if($btn_editar) <button class="btn btn-tool" wire:click="edit"><i class="fas fa-edit"></i> Editar</button> @endif
            @if($btn_cancelar) <button class="btn btn-tool" wire:click="btnCancelar"><i class="fas fa-ban"></i> Cancelar</button> @endif
        </div>
    </div>

    <div class="card-body">

        @if($view)
            @include('dashboard.pacientes.view_'.$view)
            @else
            Seleccione algún Paciente.
        @endif

    </div>

    <div class="card-footer text-center @if(!$footer) d-none @endif">

        <button type="button" class="btn btn-default btn-sm" wire:click="btnPeso"
            {{--@if(!comprobarPermisos('empresas.horario')) disabled @endif--}}>
            <i class="fas fa-weight"></i> Peso
        </button>

        <button type="button" class="btn btn-default btn-sm" wire:click="btnAntecedentes"
            {{--@if(!comprobarPermisos('empresas.horario')) disabled @endif--}}>
            <i class="fas fa-notes-medical"></i> Antecedentes
        </button>

        {{--<button type="button" class="btn btn-default btn-sm" wire:click="btnImagen"
            --}}{{--@if(!comprobarPermisos('empresas.horario')) disabled @endif--}}{{-->
            <i class="fas fa-image"></i> Imagen
        </button>
--}}
        {{--<button type="button" class="btn btn-default btn-sm" --}}{{--wire:click="btnActivoInactivo"--}}{{--
            --}}{{--@if(!comprobarPermisos('empresas.horario')) disabled @endif--}}{{-->
            @if(/*$articulo_estatus*/true)
                <i class="fas fa-check"></i> Activo
            @else
                <i class="fas fa-ban"></i> Inactivo
            @endif
        </button>--}}

        <button type="button" class="btn btn-default btn-sm" wire:click="destroy"
            @if(!comprobarPermisos()) disabled @endif>
            <i class="fas fa-trash-alt"></i> Borrar
        </button>

    </div>

    <div class="overlay-wrapper" wire:loading wire:target="create, savePacientes, showPacientes, edit, btnCancelar, destroy, confirmed, buscar, btnPeso, savePeso, editPeso, destroyPeso, saveAntecedente, editAntecedente, confirmedAntecedente, buscarAntecedente, btnAntecedentes, editPaciAnte, savePaciAnte, destroyPaciAnte">
        <div class="overlay">
            <div class="spinner-border text-navy" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

</div>
