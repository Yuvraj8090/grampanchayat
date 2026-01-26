@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="modal-content border-0 shadow-lg">
        
        <div class="modal-header border-bottom-0 p-4 pb-0">
            <h5 class="modal-title fw-bold text-dark">
                {{ $title }}
            </h5>
            {{-- Note: The close button is usually handled by the parent modal trigger --}}
        </div>

        <div class="modal-body p-4 text-muted small">
            {{ $content }}
        </div>

        <div class="modal-footer bg-light border-top-0 p-4">
            <div class="d-flex justify-content-end gap-2 w-100">
                {{ $footer }}
            </div>
        </div>
    </div>
</x-modal>