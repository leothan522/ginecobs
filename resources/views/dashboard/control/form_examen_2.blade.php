<div class="row" xmlns:wire="http://www.w3.org/1999/xhtml">

    <form class="row col-md-12" wire:submit.prevent="saveLaboratorio2">

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
                            <input type="date" class="form-control" wire:model.defer="ex2_fecha" placeholder="FECHA">
                            @error('ex2_fecha')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">HIV:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex2_hiv" placeholder="HIV">
                            @error('ex2_hiv')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">VDRL:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex2_vdrl" placeholder="VDRL">
                            @error('ex2_vdrl')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">ANTICORE:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex2_anticore" placeholder="ANTICORE">
                            @error('ex2_anticore')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">TGO:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex2_tgo" placeholder="TGO">
                            @error('ex2_tgo')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">TPG:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-vial"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex2_tpg" placeholder="TPG">
                            @error('ex2_tpg')
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
                        <label for="email">LDH:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex2_ldh" placeholder="LDH">
                            @error('ex2_ldh')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">TOXO IGM:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex2_igm" placeholder="TOXO IGM">
                            @error('ex2_igm')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">TOXO IGG:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-female"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex2_igg" placeholder="TOXO IGG">
                            @error('ex2_igg')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">TSH:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-female"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex2_tsh" placeholder="TSH">
                            @error('ex2_tsh')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">T4:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-female"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex2_t4" placeholder="T4">
                            @error('ex2_t4')
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
                    <i class="fas fa-save"></i> Guardar @if($ex2_id) Cambios @endif
                </button>
            </div>
        </div>


    </form>
</div>
