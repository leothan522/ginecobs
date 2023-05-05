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
                        <label for="name">Año:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex1_year" placeholder="Año">
                            @error('ex1_year')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Semanas:</label>
                        <div class="input-group mb-3">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex1_semanas" placeholder="Semanas">
                            @error('ex1_semanas')
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
                        <label for="email">Via:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-vial"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex1_via" placeholder="Via">
                            @error('ex1_via')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Sexo:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex1_sexo" placeholder="Sexo">
                            @error('ex1_sexo')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Peso:</label>
                        <div class="input-group">
                            {{--<div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-book-medical"></i></span>
                            </div>--}}
                            <input type="text" class="form-control" wire:model.defer="ex1_peso" placeholder="Peso">
                            @error('ex1_peso')
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
