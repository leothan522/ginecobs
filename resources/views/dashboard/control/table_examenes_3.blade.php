<div class="col-6 table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="text-center">FECHA</th>
            <th colspan="3">UROANALISIS</th>
            <th class="text-center" style="width: 25%;">
                <button type="button" class="btn btn-default btn-sm" @if(!$paciente_id) disabled @endif>
                    <i class="fas fa-plus-circle"></i> Agregar
                </button>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-center">24/02/2023</td>
            <td style="width: 25%">
                LUE:
            </td>
            <td style="width: 25%">
                BAC:
            </td>
            <td style="width: 25%"></td>
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
<div class="col-6 table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="text-center" style="width: 20%">FECHA</th>
            <th>UROCULTIVO</th>
            <th class="text-center" style="width: 25%;">
                <button type="button" class="btn btn-default btn-sm" @if(!$paciente_id) disabled @endif>
                    <i class="fas fa-plus-circle"></i> Agregar
                </button>
            </th>
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
