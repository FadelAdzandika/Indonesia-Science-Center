{{--
    Variables:
    $modalId: (string) ID unik untuk modal
    $modalTitle: (string) Judul untuk modal header
--}}
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalId }}Label">{{ $modalTitle ?? 'Pratinjau Gambar' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="{{ $modalId }}Image" class="img-fluid" alt="Image Preview">
            </div>
        </div>
    </div>
</div>