<div class="row col-12" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="col-8">
        <h3>
            <i class="fas fa-user-nurse"></i> Ginecologia
        </h3>
    </div>
    <div class="col-4">
        <div class="float-right" wire:ignore>
            <select class="js-example-basic-single">
                <option value="">Seleccionar Paciente</option>
                @foreach($listarPacientes as $paciente)
                    <option value="{{ $paciente->id }}">{{ $paciente->cedula }} - {{ $paciente->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
