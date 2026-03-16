var editModal = document.getElementById('editPageModal')
editModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var id = button.getAttribute('data-bs-id')
    var title = button.getAttribute('data-bs-title')
    var detail = button.getAttribute('data-bs-detail')
    var status = button.getAttribute('data-bs-status');
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalName = editModal.querySelector('.modal-body #title')
    var form = editModal.querySelector('#editPageForm')

    modalName.value = title
    if (tinymce.get('detail')) {
        tinymce.get('detail').setContent(detail)
    }
    var statusRadios = editModal.querySelectorAll('input[name="status"]')
    statusRadios.forEach(function (radio) {
        radio.checked = (radio.value == status)
    })
    form.action = "/admin/page/update/" + id
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