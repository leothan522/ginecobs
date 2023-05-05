<div class="p-3">
    <ul class="nav nav-pills flex-column">
        {{--@livewire('dashboard.dolar-component')--}}
        {{--<li class="dropdown-divider"></li>--}}
        <li class="nav-item mb-2">
            <span class="text-small text-muted float-right">Imprimir</span>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1" {{--onclick="verAntecedentes()"--}}
                    @if(!comprobarPermisos()) disabled @endif >
                Historia Ginecologica
            </button>
        </li>
        {{--<li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                    data-toggle="modal" data-target="#modal-ginecostetricos" onclick="verGinecostetricos()"
                    @if(!comprobarPermisos()) disabled @endif >
                Ginecostetricos
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                    data-toggle="modal" data-target="#modal-vacunas" onclick="verVacunas()"
                    @if(!comprobarPermisos()) disabled @endif >
                Vacunas
            </button>
        </li>--}}

        <li class="dropdown-divider"></li>
    </ul>
</div>
