<div wire:ignore.self class="modal fade" id="modal-form" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar</h4>
                <button type="button" {{--wire:click="limpiar()"--}} class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">



            </div>

            {!! verSpinner() !!}

            <div class="modal-footer justify-content-end">
                <button type="button" {{--wire:click="limpiar()"--}} class="btn btn-default btn-sm" data-dismiss="modal">{{ __('Close') }}</button>
            </div>

        </div>
    </div>
</div>
