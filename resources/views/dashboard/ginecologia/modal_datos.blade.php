<div wire:ignore.self class="modal fade" id="modal-otros-datos" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Mas Datos</h4>
                <button type="button" {{--wire:click="limpiar()"--}} class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="invoice p-3 mb-3" xmlns:wire="http://www.w3.org/1999/xhtml">
                    <div class="row invoice-info">

                        <div class="col-sm-4 invoice-col">
                            <em>Antecedentes Familiares</em>
                            <address>
                                @if($listarFamiliares->isNotEmpty())
                                    @foreach($listarFamiliares as $antecedente)
                                        <span>{{ $antecedente->nombre }}:</span>
                                        <strong class="col-6 float-right">
                                            @if(!is_null($antecedente->valor))
                                                @if($antecedente->valor)
                                                    SI
                                                @else
                                                    NO
                                                @endif
                                            @endif
                                        </strong><br>
                                    @endforeach
                                @endif
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <em>Antecedentes Personales</em>
                            <address>
                                @if($listarPersonales->isNotEmpty())
                                    @foreach($listarPersonales as $antecedente)
                                        <span>{{ $antecedente->nombre }}:</span>
                                        <strong class="col-6 float-right">
                                            @if(!is_null($antecedente->valor))
                                                @if($antecedente->valor)
                                                    SI
                                                @else
                                                    NO
                                                @endif
                                            @endif
                                        </strong><br>
                                    @endforeach
                                @endif
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <em>Otros</em>
                            <address>
                                @if($listarOtros->isNotEmpty())
                                    @foreach($listarOtros as $antecedente)
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

                    </div>
                </div>


            </div>

            {!! verSpinner() !!}

            <div class="modal-footer justify-content-end">
                <button type="button" {{--wire:click="limpiar()"--}} class="btn btn-default btn-sm"
                        data-dismiss="modal">{{ __('Close') }}</button>
            </div>

        </div>
    </div>
</div>
