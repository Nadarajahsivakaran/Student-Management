<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap Links --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    {{-- jquery cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    {{-- Custom css --}}
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    {{-- Data table links --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

    {{-- font awesome cdn --}}
    <script src="https://kit.fontawesome.com/9e456acc2a.js" crossorigin="anonymous"></script>

    <title>Student</title>
</head>

<body>




    {{-- Nav bar --}}
    <nav class="navbar navbar-expand-lg navbar--dark bg-dark">
        <div class="container-fluid">
            <h4>Student Management</h4>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/view">Guardian</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/getDatas">Report</a>
                    </li>


                </ul>

            </div>
        </div>
    </nav>

    @if (\Session::has('sucess'))
        <div class="alert alert-success fade-message">
            <p>{{ \Session::get('sucess') }}</p>
        </div><br />
    @endif

    @if (\Session::has('error'))
        <div class="alert alert-danger fade-message">
            <p>{{ \Session::get('error') }}</p>
        </div><br />
    @endif
    {{-- Nav bar --}}

    @yield('content')

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });


        $(function() {
            setTimeout(function() {
                $('.fade-message').slideUp();
            }, 2000);
        });
    </script>

</body>

</html>
