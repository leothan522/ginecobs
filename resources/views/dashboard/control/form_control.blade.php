<div class="row" xmlns:wire="http://www.w3.org/1999/xhtml">

    <form class="row col-md-12" wire:submit.prevent="saveControl">

        <div class="col-md-6">

            <div class="card card-outline card-navy">

                {{--<div class="card-header">
                    <h5 class="card-title">Datos Básicos</h5>
                    <div class="card-tools">
                        <span class="btn-tool"><i class="fas fa-book"></i></span>
                    </div>
                </div>--}}

                <div class="card-body">


                    <div class="form-group">
                        <label for="name">Fecha:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>--}}
                            <input type="date" class="form-control" wire:model.defer="control_fecha" placeholder="Fecha">
                            @error('control_fecha')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Edad Gestacional:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_edad" placeholder="Edad Gestacional">
                            @error('control_edad')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Peso:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_peso" placeholder="Peso KG.">
                            @error('control_peso')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">TA:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_ta" placeholder="TA">
                            @error('control_ta')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">AU:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_au" placeholder="AU">
                            @error('control_au')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">PRES:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_pres" placeholder="PRES">
                            @error('control_pres')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card card-outline card-navy">
                {{--<div class="card-header">
                    <h5 class="card-title">Datos Adicionales</h5>
                    <div class="card-tools">
                        <span class="btn-tool"><i class="fas fa-book"></i></span>
                    </div>
                </div>--}}
                <div class="card-body">

                    <div class="form-group">
                        <label for="email">FCF:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-vial"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_fcf" placeholder="FCF">
                            @error('control_fcf')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">MOV FETALES:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="contol_mov" placeholder="MOV FETALES">
                            @error('contol_mov')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">DU:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_du" placeholder="DU">
                            @error('control_du')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">EDEMA:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-female"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_edema" placeholder="EDEMA">
                            @error('control_edema')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Sintomas:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-female"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_sintomas" placeholder="Sintomas">
                            @error('control_sintomas')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Observaciones:</label>
                        <div class="input-group">
                            <textarea class="form-control" wire:model.defer="control_observaciones" placeholder="Observaciones"></textarea>
                            @error('control_observaciones')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-md-12">
            <div class="col-md-4 float-right">
                <button type="submit" class="btn btn-block btn-success">
                    <i class="fas fa-save"></i> Guardar @if($control_id) Cambios @endif
                </button>
            </div>
        </div>


    </form>
</div>
