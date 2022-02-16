<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Promobit</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">

    <link rel="stylesheet" href="{{ mix('adm/css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

</head>

<body class="g-sidenav-show bg-gray-100">

    @auth()
        @include('layouts.navbars.navbar')
    @endauth

    @yield('content')

    <script src="{{ mix('adm/js/admin.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>

    @stack('scripts-footer')

    <script>
        $(function() {
            $('.dataTable').DataTable({
                language: {
                    paginate: {
                        next: '&#8594;',
                        previous: '&#8592;'
                    }
                }
            });
        });
    </script>

    @if (Session::has('type') && Session::get('type') == 'success')
        <script>
            $(function() {
                toastr.success('{{ Session::get('message') }}')
            })
        </script>
    @endif

    @if (Session::has('type') && Session::get('type') == 'error')
        <script>
            $(function() {
                toastr.error('{{ Session::get('message') }}')
            })
        </script>
    @endif
</body>

</html>
