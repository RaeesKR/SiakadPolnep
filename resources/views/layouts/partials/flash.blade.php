<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        const successMsg = @json(session('success'));
        const errorMsg = @json(session('error'));

        if (successMsg) {
            Toast.fire({ icon: 'success', title: successMsg });
        }
        if (errorMsg) {
            Toast.fire({ icon: 'error', title: errorMsg });
        }
    });
</script>