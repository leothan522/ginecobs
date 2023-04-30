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
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist" xmlns:wire="http://www.w3.org/1999/xhtml">
                <li class="nav-item">
                    <a class="nav-link @if($pv_label_va) active @endif" id="custom-tabs-three-home-tab"
                       data-toggle="pill" href="#tabs_datos_basicos" role="tab"
                       aria-controls="custom-tabs-three-home" aria-selected="@if($pv_label_va) true @else false @endif">
                        Vacunas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($pv_label_ti) active @endif" id="custom-tabs-three-profile-tab"
                       data-toggle="pill" href="#tabs_datos_adicionales" role="tab"
                       aria-controls="custom-tabs-three-profile" aria-selected="@if($pv_label_ti) true @else false @endif">
                        Tipaje
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade @if($pv_label_va) active show @endif" id="tabs_datos_basicos" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">


                    <div class="row table-responsive p-0">
                        <form wire:submit.prevent="savePaciVacu" xmlns:wire="http://www.w3.org/1999/xhtml">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="text-navy">
                                    <th>Nombre</th>
                                    <th class="text-center" style="width: 15%;">1</th>
                                    <th class="text-center" style="width: 15%;">2</th>
                                    <th class="text-center" style="width: 15%;">Refuerzo</th>
                                    <th style="width: 5%;">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pv_listar as $vacuna)
                                    <tr>
                                        <th scope="row">{{ $vacuna->nombre }}</th>
                                        <td class="text-center">
                                            {{ $vacuna->dosis_1 }}
                                        </td>
                                        <td class="text-center">
                                            {{ $vacuna->dosis_2 }}
                                        </td>
                                        <td class="text-center">
                                            {{ $vacuna->refuerzo }}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" wire:click="editPaciVacu({{ $vacuna->id }}, 'personales')" class="btn btn-primary btn-sm"
                                                        {{--@if(!comprobarPermisos('paciante.edit')) disabled @endif--}} >
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <button type="button" wire:click="destroyPaciVacu({{ $vacuna->pv_id }})" class="btn btn-primary btn-sm"
                                                        @if(/*!comprobarPermisos('paciante.destroy') || */!$vacuna->pv_id) disabled @endif >
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr class="table-sm">
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                @if($form_vacunas)
                                    <tr class="table-primary">
                                        <th scope="row">{{ $form_vacunas }}</th>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" wire:model.defer="pv_dosis_1" placeholder="Dosis 1">
                                                    @error('pv_dosis_1')
                                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                                        <i class="icon fas fa-exclamation-triangle"></i>
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" wire:model.defer="pv_dosis_2" placeholder="Dosis 2">
                                                    @error('pv_dosis_2')
                                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                                        <i class="icon fas fa-exclamation-triangle"></i>
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" wire:model.defer="pv_refuerzo" placeholder="Refuerzo">
                                                    @error('pv_refuerzo')
                                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                                        <i class="icon fas fa-exclamation-triangle"></i>
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">

                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-save"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </form>
                    </div>


                </div>
                <div class="tab-pane fade @if($pv_label_ti) active show @endif" id="tabs_datos_adicionales" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">

                    <form wire:submit.prevent="saveTipaje" xmlns:wire="http://www.w3.org/1999/xhtml">
                        <div class="row table-responsive p-0">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row" style="width: 20%">Madre:</th>
                                <td colspan="4">
                                    @if($tipaje_id)
                                        <span class="">{{ $pt_madre }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Padre:</th>
                                <td colspan="4">
                                    @if($tipaje_id)
                                        <span class="">{{ $pt_padre }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Sensibilidad:</th>
                                <td colspan="4">
                                    @if($tipaje_id)
                                        <span class="">{{ $pt_sensibilidad }}</span>
                                    @endif
                                </td>
                            </tr>
                            @if($form_tipaje)
                                <tr class="table-sm">
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                <tr class="table-primary">
                                    <th scope="row">Tipaje</th>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" wire:model.defer="pt_madre" placeholder="Madre">
                                                @error('pt_madre')
                                                <span class="col-sm-12 text-sm text-bold text-danger">
                                                        <i class="icon fas fa-exclamation-triangle"></i>
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" wire:model.defer="pt_padre" placeholder="Padre">
                                                @error('pt_padre')
                                                <span class="col-sm-12 text-sm text-bold text-danger">
                                                        <i class="icon fas fa-exclamation-triangle"></i>
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" wire:model.defer="pt_sensibilidad" placeholder="Sensibilidad">
                                                @error('pt_sensibilidad')
                                                <span class="col-sm-12 text-sm text-bold text-danger">
                                                        <i class="icon fas fa-exclamation-triangle"></i>
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">

                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="5" class="text-right">
                                        <div class="btn-group">
                                            <button type="button" wire:click="editTipaje" class="btn btn-primary btn-sm"
                                                {{--@if(!comprobarPermisos('paciante.edit')) disabled @endif--}} >
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <button type="button" wire:click="destroyTipaje" class="btn btn-primary btn-sm"
                                                    @if(/*!comprobarPermisos('paciante.destroy') || */!$tipaje_id) disabled @endif >
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
