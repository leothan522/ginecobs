<div class="col-12 table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th style="width: 5%">Nº</th>
            <th>AÑO</th>
            <th>SEMANAS</th>
            <th>VIA</th>
            <th>SEXO</th>
            <th>PESO</th>
            <th style="width: 5%;">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>9 meses</td>
            <td>78,00 kg</td>
            <td>TA</td>
            <td>AU</td>
            <td>AUPRES</td>
            <td>
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
