<div class="row col-12 mb-2">
    <div class="col-md-2">
        <label>Cedula:</label>
    </div>
    <div class="col-md-5 mb-2">
        <span class="border badge-pill">{{ $getPaciente->cedula }}</span>
    </div>
    <div class="col-md-2 text-md-right">
        <label>Edad</label>
    </div>
    <div class="col-md-3">
        <span class="border badge-pill">{{ $getEdad }} años</span>
    </div>
</div>

<div class="row col-12 mb-2">
    <div class="col-md-2">
        <label>Nombre:</label>
    </div>
    <div class="col-md-10">
        <span class="border badge-pill">{{ $getPaciente->nombre }}</span>
    </div>
</div>

<div class="col-12">
    <div class="card card-navy card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab"
                       data-toggle="pill" href="#tabs_datos_basicos" role="tab"
                       aria-controls="custom-tabs-three-home" aria-selected="true">
                        Datos Básicos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab"
                       data-toggle="pill" href="#tabs_datos_adicionales" role="tab"
                       aria-controls="custom-tabs-three-profile" aria-selected="false">
                        Datos Adicionales
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade active show" id="tabs_datos_basicos" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">


                    <div class="row table-responsive p-0">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row" style="width: 20%">Fecha Nac:</th>
                                <td>
                                    <span class="">{{ fecha($getPaciente->fecha_nac) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Telefono:</th>
                                <td>
                                    <span class="">{{ $getPaciente->telefono }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Direccion:</th>
                                <td>
                                    <span class="">{{ $getPaciente->direccion }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="tab-pane fade" id="tabs_datos_adicionales" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">


                    <div class="row table-responsive p-0">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row" style="width: 20%">Grupo:</th>
                                <td colspan="3">
                                    <span class="">{{ $getPaciente->grupo }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">FUR:</th>
                                <td colspan="3">
                                    <span class="">{{ $getPaciente->fur }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">FPP:</th>
                                <td colspan="3">
                                    <span class="">{{ $getPaciente->fpp }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="text-bold">Gestas: </span>&nbsp;<span class="border badge-pill">{{ formatoMillares($getPaciente->gestas, 0) }}</span>
                                </td>
                                <td>
                                    <span class="text-bold">Partos:</span>&nbsp;<span class="border badge-pill">{{ formatoMillares($getPaciente->partos, 0) }}</span>
                                </td>
                                <td>
                                    <span class="text-bold">Cesaria:</span>&nbsp;<span class="border badge-pill">{{ formatoMillares($getPaciente->cesarias, 0) }}</span>
                                </td>
                                <td>
                                    <span class="text-bold">Aborto:</span>&nbsp;<span class="border badge-pill">{{ formatoMillares($getPaciente->abortos, 0) }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
