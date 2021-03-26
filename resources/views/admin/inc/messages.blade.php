@if (session('error'))
    <script>
        swal('Error!', "{{ session('error') }}", 'error')
    </script>
@endif

@if (session('success'))
    <script>
        swal('Success!', "{{ session('success') }}", 'success')
    </script>
@endif

@if (session('info'))
    <script>
        swal('Info!', "{{ session('info') }}", 'info')
    </script>
@endif
