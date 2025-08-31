<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets-front/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/printThis.js') }}"></script>
<script type="text/javascript">
    function sweetConfirm(e) {
        e.preventDefault();
        var url = e.currentTarget.getAttribute('href');

        swal.fire({
            icon: 'warning',
            title: 'آیا اطمینان دارید؟',
            text: 'این عملیات غیر قابل بازگشت می باشد',
            showCancelButton: true,
            cancelButtonText: 'انصراف',
            confirmButtonText: 'بله اطمینان دارم'
        }).then(function(result) {
            if (result.value) {
                window.location.href = url;
            }
        })
    }
</script>
@yield('js')
<script>
    var select2 = $(".select2").select2({});
    $('[data-plugin="switchery"]').each(function(e,t){new Switchery($(this)[0],$(this).data())})
</script>
<!-- App js -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>


