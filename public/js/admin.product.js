var deleteModal = document.getElementById('deleteProductModal');
if (deleteModal) {
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        if (!button) return;

        var id = button.getAttribute('data-bs-id');
        var title = button.getAttribute('data-title');

        var modalTitle = deleteModal.querySelector('#delete-name');
        var deleteForm = deleteModal.querySelector('#deleteForm');

        if (modalTitle) {
            modalTitle.textContent = title || '';
        }

        if (deleteForm) {
            deleteForm.action = '/admin/product/delete/' + id;
        }
    });
}