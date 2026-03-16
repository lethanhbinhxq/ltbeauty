document.addEventListener("DOMContentLoaded", function () {

    const toastEl = document.getElementById('liveToast');

    if (toastEl) {
        const toast = new bootstrap.Toast(toastEl, {
            delay: 4000
        });
        toast.show();
    }

});

var editModal = document.getElementById('editModal')
editModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var id = button.getAttribute('data-bs-id')
    var name = button.getAttribute('data-bs-name')
    var status = button.getAttribute('data-bs-status');
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalName = editModal.querySelector('.modal-body #name')
    var modalStatus = editModal.querySelector('.modal-body #status')
    var form = editModal.querySelector('#editForm')

    modalName.value = name
    modalStatus.value = status
    form.action = "/admin/user/update/" + id
})

var deleteModal = document.getElementById('deleteModal')
deleteModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    var id = button.getAttribute('data-bs-id')
    var name = button.getAttribute('data-bs-name')

    var modalName = deleteModal.querySelector('.modal-body #delete-name')
    var deleteForm = deleteModal.querySelector('#deleteForm')

    modalName.textContent = name
    deleteForm.action = '/admin/user/delete/' + id
})