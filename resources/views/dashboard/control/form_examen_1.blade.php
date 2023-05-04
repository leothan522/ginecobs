<div class="row" xmlns:wire="http://www.w3.org/1999/xhtml">

    <form class="row col-md-12" wire:submit.prevent="saveLaboratorio1">

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
                        <label for="name">FECHA:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>--}}
                            <input type="date" class="form-control" wire:model.defer="ex1_fecha" placeholder="FECHA">
                            @error('ex1_fecha')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">HB:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex1_hb" placeholder="HB">
                            @error('ex1_hb')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">LEUCO:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex1_leuco" placeholder="LEUCO">
                            @error('ex1_leuco')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">PLAQUETA:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex1_plaqueta" placeholder="PLAQUETA">
                            @error('ex1_plaqueta')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">GLICEMIA:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex1_glicemia" placeholder="GLICEMIA">
                            @error('ex1_glicemia')
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
                        <label for="email">UREA:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-vial"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex1_urea" placeholder="UREA">
                            @error('ex1_urea')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">CREA:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex1_crea" placeholder="CREA">
                            @error('ex1_crea')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">AC. URICO:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex1_ac" placeholder="AC. URICO">
                            @error('ex1_ac')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">TP:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-female"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex1_tp" placeholder="TP">
                            @error('control_edema')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">TPT:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-female"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex1_tpt" placeholder="TPT">
                            @error('ex1_tpt')
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
                    <i class="fas fa-save"></i> Guardar @if($ex1_id) Cambios @endif
                </button>
            </div>
        </div>


    </form>
</div>
