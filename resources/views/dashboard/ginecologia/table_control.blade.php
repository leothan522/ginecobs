<div class="col-12 table-responsive" xmlns:wire="http://www.w3.org/1999/xhtml">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="text-center">FECHA</th>
            <th>MC</th>
            <th class="text-right">PESO</th>
            <th>T.A.</th>
            <th>MAMA</th>
            <th>CUE</th>
            <th>ZT</th>
            <th style="width: 5%;">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($listarControl as $control)
            <tr>
                <td class="text-center">{{ fecha($control->fecha) }}</td>
                <td>{{ $control->mc }}</td>
                <td class="text-right">
                    @if($control->peso_id)
                        {{ formatoMillares($control->peso->peso, 3) }}
                    @endif
                </td>
                <td>{{ $control->ta }}</td>
                <td>{{ $control->mama }}</td>
                <td>{{ $control->cue }}</td>
                <td>{{ $control->zt }}</td>
                <td>
                    <div class="btn-group">

                        <button type="button" class="btn btn-primary btn-sm" wire:click="editControl({{ $control->id }})"
                                data-toggle="modal" data-target="#modal-form"
                            {{--@if(!comprobarPermisos('paciante.edit')) disabled @endif--}} >
                            <i class="fas fa-edit"></i>
                        </button>

                        <button type="button" class="btn btn-primary btn-sm" wire:click="destroyControl({{ $control->id }})"
                                @if(!comprobarPermisos()) disabled @endif >
                            <i class="fas fa-trash-alt"></i>
                        </button>

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
