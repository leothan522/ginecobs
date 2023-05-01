<div wire:ignore.self class="modal fade" id="modal-examen-fisico" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Examen Fisico</h4>
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
