<div class="card card-outline card-navy" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card-header">
        <h3 class="card-title">
            @if($keywordGinecostetricos)
                Resultados de la Busqueda { <b class="text-danger">{{ $keywordGinecostetricos }}</b> }
                <button class="btn btn-tool text-danger" wire:click="limpiarGinecostetricos"><i class="fas fa-times-circle"></i>
                </button>
            @else
                Ginecostetricos Registrados [ <b class="text-navy">{{ $rowsGinecostetricos }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            <ul class="pagination pagination-sm float-right m-1">
                {{--{{ $listarAntecedentes->links() }}--}}
            </ul>
        </div>
    </div>
    <div class="card-body table-responsive p-0" style="height: 610px;">
        <table class="table table-head-fixed table-hover text-nowrap">
            <thead>
            <tr class="text-navy">
                <th>Nombre</th>
                <th style="width: 5%;">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @if($listarGinecostetricos->isNotEmpty())
                @foreach($listarGinecostetricos as $antecedente)
                    <tr>
                        <td>{{ $antecedente->nombre }}</td>
                        <td class="justify-content-end">
                            <div class="btn-group">
                                <button wire:click="editGinecostetrico({{ $antecedente->id }})" class="btn btn-primary btn-sm"
                                {{--@if(!comprobarPermisos('antecedentes.edit')) disabled @endif--}} >
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button wire:click="destroyGinecostetrico({{ $antecedente->id }})" class="btn btn-primary btn-sm"
                                {{--@if(!comprobarPermisos('antecedentes.destroy')) disabled @endif--}} >
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @else
                <tr class="text-center">
                    <td colspan="2">
                        <span>Aún se se ha creado un Ginecostetrico.</span>
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
</div>
