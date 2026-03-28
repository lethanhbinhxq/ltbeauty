var deleteModal = document.getElementById('deletePermissionModal')
deleteModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    var id = button.getAttribute('data-bs-id')
    var name = button.getAttribute('data-bs-name')

    var modalName = deleteModal.querySelector('.modal-body #delete-name')
    var deleteForm = deleteModal.querySelector('#deleteForm')

    modalName.textContent = name
    deleteForm.action = '/admin/permission/delete/' + id
})