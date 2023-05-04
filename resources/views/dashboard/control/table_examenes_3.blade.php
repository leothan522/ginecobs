<div class="col-6 table-responsive" xmlns:wire="http://www.w3.org/1999/xhtml">
    <form wire:submit.prevent="saveUroanalisis">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="text-center">FECHA</th>
                <th colspan="3">UROANALISIS</th>
                <th class="text-center">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($listarUroanalisis as $examen)
                <tr>
                    <td class="text-center" style="width: 20%;">
                        {{ fecha($examen->fecha) }}
                    </td>
                    <td>
                        <span class="text-bold">LUE:</span>
                        <span class="float-right">{{ $examen->leu }}</span>
                    </td>
                    <td>
                        <span class="text-bold">BAC:</span>
                        <span class="float-right">{{ $examen->bac }}</span>
                    </td>
                    <td>{{ $examen->detalles }}</td>
                    <td class="text-center" style="width: 5%;">
                        <div class="btn-group">

                            <button type="button" class="btn btn-primary btn-sm" wire:click="editUroanalisis({{ $examen->id }})"
                                {{--@if(!comprobarPermisos('paciante.edit')) disabled @endif--}} >
                                <i class="fas fa-edit"></i>
                            </button>

                            <button type="button" class="btn btn-primary btn-sm" wire:click="destroyUroanalisis({{ $examen->id }})"
                                @if(!comprobarPermisos()) disabled @endif >
                                <i class="fas fa-trash-alt"></i>
                            </button>

                        </div>
                    </td>
                </tr>
            @endforeach
            @if($paciente_id)
                <tr class="table-sm">
                    <td colspan="5">&nbsp;</td>
                </tr>
                <tr class="table-primary">
                    <td>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" wire:model.defer="ex3_fecha"
                                       placeholder="FECHA">
                                @error('ex3_fecha')
                                <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                                @enderror
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" wire:model.defer="ex3_leu" placeholder="LEU">
                                @error('ex3_leu')
                                <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                                @enderror
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" wire:model.defer="ex3_bac" placeholder="BAC">
                                @error('ex3_bac')
                                <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                                @enderror
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" wire:model.defer="ex3_detalles"
                                       placeholder="Detalles">
                                @error('ex3_detalles')
                                <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                                @enderror
                            </div>
                        </div>
                    </td>
                    <td class="text-center">

                        <div class="btn-group">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </form>
</div>
<div class="col-6 table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="text-center" style="width: 20%">FECHA</th>
            <th>UROCULTIVO</th>
            <th class="text-center" style="width: 5%;">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-center">24/02/2023</td>
            <td>

            </td>
            <td class="text-center">
                <div class="btn-group">

                    <button type="button" class="btn btn-primary btn-sm"
                            data-toggle="modal" data-target="#modal-form"
                        {{--@if(!comprobarPermisos('paciante.edit')) disabled @endif--}} >
                        <i class="fas fa-edit"></i>
                    </button>

                    <button type="button" class="btn btn-primary btn-sm"
                        {{--@if(/*!comprobarPermisos('paciante.destroy') ||*/ !$antecedente->pa_id) disabled @endif--}} >
                        <i class="fas fa-trash-alt"></i>
                    </button>

                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
