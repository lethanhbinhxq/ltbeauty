document.addEventListener("DOMContentLoaded", function () {

    const successToastEl = document.getElementById('successToast');
    const errorToastEl = document.getElementById('errorToast');

    if (successToastEl) {
        const successToast = new bootstrap.Toast(successToastEl, {
            delay: 4000
        });
        successToast.show();
    }

    if (errorToastEl) {
        const errorToast = new bootstrap.Toast(errorToastEl, {
            delay: 4000
        });
        errorToast.show();
    }

});