var deleteModal = document.getElementById('deleteOrderModal');
if (deleteModal) {
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        if (!button) return;

        var id = button.getAttribute('data-bs-id');
        var code = button.getAttribute('data-bs-code');

        var modalCode = deleteModal.querySelector('#delete-code');
        var deleteForm = deleteModal.querySelector('#deleteForm');

        if (modalCode) {
            modalCode.textContent = code || '';
        }

        if (deleteForm) {
            deleteForm.action = '/admin/order/delete/' + id;
        }
    });
}