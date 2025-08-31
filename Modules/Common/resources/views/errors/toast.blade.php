<script>
    @if (Session::has('toast'))
    @foreach(Session::get('toast') as $toast)
    @switch($toast['alert-type'])
    @case('info')

    toastr.options.timeOut = 7000;
    toastr.info("{{ $toast['message'] }}");
    @break
    @case('success')

    toastr.options.timeOut = 8000;
    toastr.success("{{ $toast['message'] }}");

    @break
    @case('warning')

    toastr.options.timeOut = 9000;
    toastr.warning("{{ $toast['message'] }}");

    @break
    @case('error')


    toastr.options.timeOut = 10000;
    toastr.error("{{ $toast['message'] }}");

    @break
    @endswitch
    @endforeach
    @endif
</script>


