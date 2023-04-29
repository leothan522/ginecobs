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
                    <a class="nav-link @if($pa_label_pe) active @endif" id="custom-tabs-three-home-tab"
                       data-toggle="pill" href="#tabs_datos_basicos" role="tab"
                       aria-controls="custom-tabs-three-home" aria-selected="@if($pa_label_pe) true @else false @endif">
                        Antecedentes Personales
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($pa_label_fa) active @endif" id="custom-tabs-three-profile-tab"
                       data-toggle="pill" href="#tabs_datos_adicionales" role="tab"
                       aria-controls="custom-tabs-three-profile" aria-selected="@if($pa_label_fa) true @else false @endif">
                        Antecedetes Familiares
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($pa_label_ot) active @endif" id="custom-tabs-three-otros-tab"
                       data-toggle="pill" href="#tabs_datos_otros" role="tab"
                       aria-controls="custom-tabs-three-otros" aria-selected="@if($pa_label_ot) true @else false @endif">
                        Otros
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade @if($pa_label_pe) active show @endif" id="tabs_datos_basicos" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">


                    <div class="row table-responsive p-0">
                        <form wire:submit.prevent="savePaciAnte" xmlns:wire="http://www.w3.org/1999/xhtml">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="text-navy">
                                    <th>Nombre</th>
                                    <th class="text-center" style="width: 5%;">SI</th>
                                    <th class="text-center" style="width: 5%;">NO</th>
                                    <th style="width: 35%;">Detalles</th>
                                    <th style="width: 5%;">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pa_personales as $antecedente)
                                    <tr>
                                        <th scope="row">{{ $antecedente->nombre }}</th>
                                        <td class="text-center">
                                            @if($antecedente->si)
                                                <i class="far fa-check-circle text-danger"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($antecedente->no)
                                                <i class="far fa-check-circle text-success"></i>
                                            @endif
                                        </td>
                                        <td><p class="text-sm">{{ $antecedente->detalles }}</p></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" wire:click="editPaciAnte({{ $antecedente->id }}, 'personales')" class="btn btn-primary btn-sm"
                                                        {{--@if(!comprobarPermisos('paciante.edit')) disabled @endif--}} >
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <button type="button" wire:click="destroyPaciAnte({{ $antecedente->pa_id }})" class="btn btn-primary btn-sm"
                                                        @if(/*!comprobarPermisos('paciante.destroy') || */!$antecedente->pa_id) disabled @endif >
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr class="table-sm">
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                @if($form_personales)
                                    <tr class="table-primary">
                                        <th scope="row">{{ $form_personales }}</th>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="paValor" value="1">
                                                <label class="form-check-label">SI</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="paValor" value="0">
                                                <label class="form-check-label">NO</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" wire:model.defer="pa_detalles" placeholder="Detalles">
                                                    @error('pa_detalles')
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
                <div class="tab-pane fade @if($pa_label_fa) active show @endif" id="tabs_datos_adicionales" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">


                    <div class="row table-responsive p-0">
                        <form wire:submit.prevent="savePaciAnte" xmlns:wire="http://www.w3.org/1999/xhtml">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="text-navy">
                                    <th>Nombre</th>
                                    <th class="text-center" style="width: 5%;">SI</th>
                                    <th class="text-center" style="width: 5%;">NO</th>
                                    <th style="width: 35%;">Detalles</th>
                                    <th style="width: 5%;">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pa_familiares as $antecedente)
                                    <tr>
                                        <th scope="row">{{ $antecedente->nombre }}</th>
                                        <td class="text-center">
                                            @if($antecedente->si)
                                                <i class="far fa-check-circle text-danger"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($antecedente->no)
                                                <i class="far fa-check-circle text-success"></i>
                                            @endif
                                        </td>
                                        <td><p class="text-sm">{{ $antecedente->detalles }}</p></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" wire:click="editPaciAnte({{ $antecedente->id }}, 'familiares')" class="btn btn-primary btn-sm"
                                                        {{--@if(!comprobarPermisos('paciante.edit')) disabled @endif--}} >
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <button type="button" wire:click="destroyPaciAnte({{ $antecedente->pa_id }})" class="btn btn-primary btn-sm"
                                                        @if(/*!comprobarPermisos('paciante.destroy') ||*/ !$antecedente->pa_id) disabled @endif >
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr class="table-sm">
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                @if($form_familiares)
                                    <tr class="table-primary">
                                        <th scope="row">{{ $form_familiares }}</th>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="paValor" value="1">
                                                <label class="form-check-label">SI</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="paValor" value="0">
                                                <label class="form-check-label">NO</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" wire:model.defer="pa_detalles" placeholder="Detalles">
                                                    @error('pa_detalles')
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
                <div class="tab-pane fade @if($pa_label_ot) active show @endif" id="tabs_datos_otros" role="tabpanel" aria-labelledby="custom-tabs-three-otros-tab">


                    <div class="row table-responsive p-0">
                        <form wire:submit.prevent="savePaciAnte" xmlns:wire="http://www.w3.org/1999/xhtml">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="text-navy">
                                    <th>Nombre</th>
                                    <th class="text-center" style="width: 5%;">SI</th>
                                    <th class="text-center" style="width: 5%;">NO</th>
                                    <th style="width: 35%;">Detalles</th>
                                    <th style="width: 5%;">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pa_otros as $antecedente)
                                    <tr>
                                        <th scope="row">{{ $antecedente->nombre }}</th>
                                        <td class="text-center">
                                            @if($antecedente->si)
                                                <i class="far fa-check-circle text-danger"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($antecedente->no)
                                                <i class="far fa-check-circle text-success"></i>
                                            @endif
                                        </td>
                                        <td><p class="text-sm">{{ $antecedente->detalles }}</p></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" wire:click="editPaciAnte({{ $antecedente->id }}, 'otros')" class="btn btn-primary btn-sm"
                                                        {{--@if(!comprobarPermisos('paciante.edit')) disabled @endif--}} >
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <button type="button" wire:click="destroyPaciAnte({{ $antecedente->pa_id }})" class="btn btn-primary btn-sm"
                                                        @if(/*!comprobarPermisos('paciante.destroy') ||*/ !$antecedente->pa_id) disabled @endif >
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr class="table-sm">
                                    <td colspan="5">&nbsp;</td>
                                </tr>
                                @if($form_otros)
                                    <tr class="table-primary">
                                        <th scope="row">{{ $form_otros }}</th>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="paValor" value="1">
                                                <label class="form-check-label">SI</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="paValor" value="0">
                                                <label class="form-check-label">NO</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" wire:model.defer="pa_detalles" placeholder="Detalles">
                                                    @error('pa_detalles')
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
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
