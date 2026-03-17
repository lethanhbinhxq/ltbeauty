var deleteModal = document.getElementById('deletePostModal');
if (deleteModal) {
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        if (!button) return;

        var id = button.getAttribute('data-bs-id');
        var title = button.getAttribute('data-title');

        var modalTitle = deleteModal.querySelector('#delete-title');
        var deleteForm = deleteModal.querySelector('#deleteForm');

        console.log('button:', button);
        console.log('id:', id);
        console.log('title:', title);
        console.log('modalTitle:', modalTitle);

        if (modalTitle) {
            modalTitle.textContent = title || '';
        }

        if (deleteForm) {
            deleteForm.action = '/admin/post/delete/' + id;
        }
    });
}