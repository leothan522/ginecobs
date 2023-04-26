<div class="card card-navy" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;"
     xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="card-header">
        @if($antecedente_id)
            <h3 class="card-title">Editar</h3>
            <div class="card-tools">
                <button class="btn btn-tool" wire:click="limpiarAntecedentes">
                    <i class="fas fa-ban"></i> Cancelar
                </button>
            </div>
            @else
            <h3 class="card-title">Crear</h3>
            <div class="card-tools">
                <span class="btn btn-tool"><i class="fas fa-file"></i></span>
            </div>
        @endif
    </div>

    <div class="card-body">


        <form wire:submit.prevent="saveAntecedente">

            <div class="form-group">
                <label for="name">{{ __('Name') }}:</label>
                <div class="input-group mb-3">
                    {{--<div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    </div>--}}
                    <input type="text" class="form-control" wire:model.defer="ante_nombre" placeholder="Nombre Antecedente">
                    @error('ante_nombre')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="name">Tipo:</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="ante_familiares" value="1">
                    <label class="form-check-label">Familiares</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="ante_personales" value="1">
                    <label class="form-check-label">Personales</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="ante_otros" value="1">
                    <label class="form-check-label">Otros</label>
                </div>
            </div>

            <div class="form-group mt-3">
                {{--<input type="submit" class="btn btn-block btn-success" value="Guardar">--}}
                <button type="submit" class="btn btn-block btn-success"
                {{--@if(!comprobarPermisos('antecedentes.create') || ($categoria_id && !comprobarPermisos('antecedentes.edit')))
                disabled @endif--}} >
                    <i class="fas fa-save"></i> Guardar @if($antecedente_id) Cambios @endif
                </button>
            </div>

        </form>




    </div>

</div>
