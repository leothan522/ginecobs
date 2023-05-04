<div class="col-12 table-responsive" xmlns:wire="http://www.w3.org/1999/xhtml">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="text-center">FECHA</th>
            <th>EDAD GESTACIONAL</th>
            <th class="text-right">PESO KG.</th>
            <th>TA</th>
            <th>AU</th>
            <th>PRES</th>
            <th>FCF</th>
            <th>MOV FETALES</th>
            <th>DU</th>
            <th>EDEMA</th>
            <th>SISTOMAS</th>
            <th style="width: 5%;">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($listarControl as $control)
            <tr>
                <td class="text-center">{{ fecha($control->fecha) }}</td>
                <td>{{ $control->edad_gestacional }}s</td>
                <td class="text-right">
                    @if($control->peso_id)
                        {{ formatoMillares($control->peso->peso, 3) }}
                    @endif
                </td>
                <td>{{ $control->ta }}</td>
                <td>{{ $control->au }}</td>
                <td>{{ $control->pres }}</td>
                <td>{{ $control->fcf }}</td>
                <td>{{ $control->mov_fetales }}</td>
                <td>{{ $control->du }}</td>
                <td>{{ $control->edema }}</td>
                <td>{{ $control->sintomas }}</td>
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

<div class="col-12">
    <ul class="pagination pagination-sm float-right pt-1">
        {{ $listarControl->links() }}
    </ul>
</div>

