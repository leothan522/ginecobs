<div class="col-12 table-responsive" xmlns:wire="http://www.w3.org/1999/xhtml">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="text-center">FECHA</th>
            <th>HB</th>
            <th>LEUCO</th>
            <th>PLAQUETA</th>
            <th>GLICEMIA</th>
            <th>UREA</th>
            <th>CREA</th>
            <th>AC. URICO</th>
            <th>TP</th>
            <th>TPT</th>
            <th style="width: 5%;">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($listarLaboratorio1 as $examen)
            <tr>
                <td class="text-center">{{ fecha($examen->fecha) }}</td>
                <td>{{ $examen->hb }}</td>
                <td>{{ $examen->leuco }}</td>
                <td>{{ $examen->plaqueta }}</td>
                <td>{{ $examen->glicemia }}</td>
                <td>{{ $examen->urea }}</td>
                <td>{{ $examen->crea }}</td>
                <td>{{ $examen->ac_urico }}</td>
                <td>{{ $examen->tp }}</td>
                <td>{{ $examen->tpt }}</td>
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
