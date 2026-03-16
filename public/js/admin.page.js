var editModal = document.getElementById('editPageModal');
if (editModal) {
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        if (!button) return;

        var id = button.getAttribute('data-bs-id');
        var title = button.getAttribute('data-bs-title');
        var detail = button.getAttribute('data-bs-detail') || '';
        var status = button.getAttribute('data-bs-status');

        var modalName = editModal.querySelector('#title');
        var form = editModal.querySelector('#editPageForm');

        if (modalName) {
            modalName.value = title || '';
        }

        var editor = tinymce.get('detail');
        if (editor && typeof detail === 'string') {
            editor.setContent(detail);
        }

        var statusRadios = editModal.querySelectorAll('input[name="status"]');
        statusRadios.forEach(function (radio) {
            radio.checked = (radio.value == status);
        });

        if (form) {
            form.action = "/admin/page/update/" + id;
        }
    });
}

var deleteModal = document.getElementById('deletePageModal');
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
            deleteForm.action = '/admin/page/delete/' + id;
        }
    });
}