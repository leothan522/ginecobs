<div class="row" xmlns:wire="http://www.w3.org/1999/xhtml">

    <form class="row col-md-12" wire:submit.prevent="saveControl">

        <div class="col-md-6">

            <div class="card card-outline card-navy">

                <div class="card-header">
                    <h5 class="card-title">Historia</h5>
                    {{--<div class="card-tools">
                        <span class="btn-tool"><i class="fas fa-book"></i></span>
                    </div>--}}
                </div>

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
                        <label for="name">MC:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_mc" placeholder="MC">
                            @error('control_mc')
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
                        <label for="name">MAMA:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_mama" placeholder="MAMA">
                            @error('control_mama')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">CUE:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_cue" placeholder="CUE">
                            @error('control_cue')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">ZT:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_zt" placeholder="ZT">
                            @error('control_zt')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Observacion:</label>
                        <div class="input-group">
                            <textarea class="form-control" wire:model.defer="control_observacion" placeholder="Observacion"></textarea>
                            @error('control_observacion')
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
                <div class="card-header">
                    <h5 class="card-title">Examen Fisico</h5>
                    {{--<div class="card-tools">
                        <span class="btn-tool"><i class="fas fa-book"></i></span>
                    </div>--}}
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="email">Cabeza:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-vial"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_cabeza" placeholder="Cabeza">
                            @error('control_cabeza')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Cuello:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_cuello" placeholder="Cuello">
                            @error('control_cuello')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Torax:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_torax" placeholder="Torax">
                            @error('control_torax')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Abdomen:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-female"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_abdomen" placeholder="Abdomen">
                            @error('control_abdomen')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Extremidades:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-female"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_extremidades" placeholder="Extremidades">
                            @error('control_extremidades')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">SNC:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-female"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_snc" placeholder="SNC">
                            @error('control_snc')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Genitales:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-female"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="control_genitales" placeholder="Genitales">
                            @error('control_genitales')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Plan:</label>
                        <div class="input-group">
                            <textarea class="form-control" wire:model.defer="control_plan" placeholder="Plan"></textarea>
                            @error('control_plan')
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
