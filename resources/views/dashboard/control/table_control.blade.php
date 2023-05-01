<div class="col-12 table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>FECHA</th>
            <th>EDAD GESTACIONAL</th>
            <th>PESO</th>
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
        <tr>
            <td>24/02/2023</td>
            <td>9 meses</td>
            <td>78,00 kg</td>
            <td>TA</td>
            <td>AU</td>
            <td>AUPRES</td>
            <td>FCF</td>
            <td>MOV FETALES</td>
            <td>DU</td>
            <td>EDEMA</td>
            <td>FIebre, Dolor de cabeza</td>
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
