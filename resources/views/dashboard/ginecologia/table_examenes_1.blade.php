<div class="col-12 table-responsive" xmlns:wire="http://www.w3.org/1999/xhtml">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th style="width: 5%" class="text-center">Nº</th>
            <th>AÑO</th>
            <th>SEMANAS</th>
            <th>VIA</th>
            <th>SEXO</th>
            <th class="text-right">PESO KG.</th>
            <th style="width: 5%;">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @php($i = 0)
        @foreach($listarTabla as $examen)
            <tr>
                <td class="text-center">{{ ++$i }}</td>
                <td>{{ $examen->year }}</td>
                <td>{{ $examen->semanas }}</td>
                <td>{{ $examen->via }}</td>
                <td>{{ $examen->sexo }}</td>
                <td class="text-right">{{ formatoMillares($examen->peso, 3) }}</td>
                <td>
                    <div class="btn-group">

                        <button type="button" class="btn btn-primary btn-sm" wire:click="editLaboratorio1({{ $examen->id }})"
                                data-toggle="modal" data-target="#modal-form"
                            {{--@if(!comprobarPermisos('paciante.edit')) disabled @endif--}} >
                            <i class="fas fa-edit"></i>
                        </button>

                        <button type="button" class="btn btn-primary btn-sm" wire:click="destroyLaboratorio1({{ $examen->id }})"
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
