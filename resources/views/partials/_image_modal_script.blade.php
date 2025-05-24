{{--
    Variables:
    $modalId: (string) ID unik untuk modal yang ditargetkan oleh script ini
--}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    var imageModal = document.getElementById('{{ $modalId }}');
    if (imageModal) {
        imageModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var imageUrl = button.getAttribute('data-bs-image');
            var imageTitle = button.getAttribute('data-bs-title'); // Ambil judul dari atribut
            var modalImage = imageModal.querySelector('#{{ $modalId }}Image');
            var modalTitleElement = imageModal.querySelector('#{{ $modalId }}Label');
            modalImage.src = imageUrl;
            if (imageTitle && modalTitleElement) modalTitleElement.textContent = imageTitle;
        });
    }
});
</script>