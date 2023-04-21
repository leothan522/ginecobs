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
                        Control de Peso
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade active show" id="tabs_datos_basicos" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

                    <div class="row table-responsive p-0">
                        <form wire:submit.prevent="savePeso" xmlns:wire="http://www.w3.org/1999/xhtml">
                            <table class="table">
                                <thead>
                                <tr class="text-navy">
                                    <th style="width: 10%">&nbsp;</th>
                                    <th class="text-center">Fecha</th>
                                    <th style="width: 20%">&nbsp;</th>
                                    <th class="text-right">Peso KG.</th>
                                    <th style="width: 10%;">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($getPeso as $peso)
                                    <tr>
                                        <td class="text-center">
                                            <button type="button"  class="btn btn-xs btn-danger"
                                                wire:click="destroyPeso({{ $peso->id }})">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <span>{{ fecha($peso->fecha) }}</span>
                                        </td>
                                        <td></td>
                                        <td class="text-right">
                                            <span class="">{{ formatoMillares($peso->peso, 3) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button"  class="btn btn-xs btn-primary"
                                                wire:click="editPeso({{ $peso->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr class="table-sm {{--@if(!$btn_und_form) d-none @endif--}}">
                                    <td colspan="5">&nbsp;</td>
                                </tr>

                                <tr class="table-primary {{--@if(!$btn_und_form) d-none @endif--}}">
                                    <td class="text-center">
                                        <label>{{ $labelPeso }}:</label>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="date" class="form-control" wire:model.defer="peso_fecha" placeholder="Fecha">
                                            </div>
                                            @error('peso_fecha')
                                            <span class="col-sm-12 text-sm text-bold text-danger">
                                                <i class="icon fas fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control" wire:model.defer="peso_kg" placeholder="Peso KG.">
                                            </div>
                                            @error('peso_kg')
                                            <span class="col-sm-12 text-sm text-bold text-danger">
                                                <i class="icon fas fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="submit"  class="btn btn-success">
                                            <i class="fas fa-save"></i>
                                        </button>
                                    </td>
                                </tr>

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
