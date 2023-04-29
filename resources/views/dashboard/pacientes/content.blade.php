<div class="row justify-content-center">
    <div class="col-md-5">
        @include('dashboard.pacientes.card_table')
    </div>
    <div class="col-md-7">
        @include('dashboard.pacientes.card_show')
        @include('dashboard.pacientes.modal_antecedentes')
        @include('dashboard.pacientes.modal_ginecostetricos')
        @include('dashboard.pacientes.modal_vacunas')
    </div>
</div>
