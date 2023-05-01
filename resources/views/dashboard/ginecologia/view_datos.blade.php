<div class="col-sm-4 invoice-col">
    <em>Paciente</em>
    <address>
        <h4 class="text-bold text-navy">{{ $nombre }}&nbsp;</h4>
        Edad: <strong class="ml-3">{{ $edad }}</strong><br>
        C.I: <strong class="ml-3">{{ $cedula }}</strong><br>
        Fecha Nac: <strong class="ml-3">{{ fecha($fecha_nac) }}</strong><br>
        Telefono: <strong class="ml-3">{{ $telefono }}</strong><br>
        Direccion: <strong class="ml-3">{{ $direccion }}</strong>
    </address>
</div>

<div class="col-sm-4 invoice-col">
    <em>Datos Adicionales</em>
    <address>
        GRUPO: <strong class="ml-3">{{ $grupo }}</strong><br>
        FUR: <strong class="ml-3">{{ $fur }}</strong><br>
        FPP: <strong class="ml-3">{{ $fpp }}</strong><br>
        GESTAS:<strong class="col-6 float-right">{{ formatoMillares($gestas, 0) }}</strong><br>
        PARTOS:<strong class="col-6 float-right">{{ formatoMillares($partos, 0) }}</strong><br>
        CESAREA:<strong class="col-6 float-right">{{ formatoMillares($cesarea, 0) }}</strong><br>
        ABORTO:<strong class="col-6 float-right">{{ formatoMillares($abortos, 0) }}</strong><br>
    </address>
</div>



<div class="col-sm-4 invoice-col">
    <em>Ginecostetricos</em>
    <address>
        @if($listarGinecostetricos->isNotEmpty())
            @foreach($listarGinecostetricos as $antecedente)
                <span>{{ $antecedente->nombre }}:</span>
                <strong class="ml-3">
                    @if(!is_null($antecedente->valor))
                        {{ $antecedente->valor }}
                    @endif
                </strong><br>
            @endforeach
        @endif
    </address>
</div>
