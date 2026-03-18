document.addEventListener('DOMContentLoaded', function () {

    const editModal = document.getElementById('editProductCatModal');

    editModal.addEventListener('show.bs.modal', function (event) {

        const button = event.relatedTarget;

        const id = button.getAttribute('data-bs-id');
        const name = button.getAttribute('data-bs-name');
        const status = button.getAttribute('data-bs-status');
        const parentId = button.getAttribute('data-bs-parent-id');

        const form = document.getElementById('editForm');
        const nameInput = document.getElementById('edit_name');
        const parentSelect = document.getElementById('edit_parent_id');
        const statusPending = document.getElementById('edit_status_pending');
        const statusPublic = document.getElementById('edit_status_public');

        // set name
        nameInput.value = name;

        // set parent category
        parentSelect.value = parentId ? parentId : '';

        // set status
        if (status === 'pending') {
            statusPending.checked = true;
        } else if (status === 'public') {
            statusPublic.checked = true;
        }

        // set form action
        form.action = `/admin/product/cat/edit/${id}`;

    });

    var deleteModal = document.getElementById('deleteProductCatModal')
    deleteModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        var id = button.getAttribute('data-bs-id')
        var name = button.getAttribute('data-bs-name')

        var modalName = deleteModal.querySelector('.modal-body #delete-cat')
        var deleteForm = deleteModal.querySelector('#deleteForm')

        modalName.textContent = name
        deleteForm.action = '/admin/product/cat/delete/' + id
    })

});
