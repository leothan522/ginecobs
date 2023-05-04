<div class="col-12 table-responsive" xmlns:wire="http://www.w3.org/1999/xhtml">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>FECHA</th>
            <th>HIV</th>
            <th>VDRL</th>
            <th>ANTICORE</th>
            <th>TGO</th>
            <th>TPG</th>
            <th>LDH</th>
            <th>TOXO IGM</th>
            <th>TOXO IGG</th>
            <th>TSH</th>
            <th>T4</th>
            <th style="width: 5%;">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($listarLaboratorio2 as $examen)
            <tr>
                <td class="text-center">{{ fecha($examen->fecha) }}</td>
                <td>{{ $examen->hiv }}</td>
                <td>{{ $examen->vdrl }}</td>
                <td>{{ $examen->anticore }}</td>
                <td>{{ $examen->tgo }}</td>
                <td>{{ $examen->tpg }}</td>
                <td>{{ $examen->ldh }}</td>
                <td>{{ $examen->toxo_igm }}</td>
                <td>{{ $examen->toxo_igg }}</td>
                <td>{{ $examen->tsh }}</td>
                <td>{{ $examen->t4 }}</td>
                <td>
                    <div class="btn-group">

                        <button type="button" class="btn btn-primary btn-sm" wire:click="editLaboratorio2({{ $examen->id }})"
                                data-toggle="modal" data-target="#modal-form"
                            {{--@if(!comprobarPermisos('paciante.edit')) disabled @endif--}} >
                            <i class="fas fa-edit"></i>
                        </button>

                        <button type="button" class="btn btn-primary btn-sm" wire:click="destroyLaboratorio2({{ $examen->id }})"
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
