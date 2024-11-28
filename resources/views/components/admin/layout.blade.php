@php
    use Illuminate\Support\Str;
    $pathArray = Str::of(request()->path())->explode('/')->toArray();

    // remove 'admin' from start
    array_shift($pathArray);
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    <title>Admin | {{ $pathArray[sizeof($pathArray) - 1] }}</title>
</head>
<body class="vh-100">

{{-- small screen lock out --}}
<div class="d-flex d-lg-none position-fixed top-0 left-0 vw-100 vh-100 bg-danger-subtle text-danger-emphasis align-items-center justify-content-center z-3">
    <div class="text-center">
        <h1 style="font-size: 8rem"><i class="bi bi-x-octagon-fill"></i></h1>
        <h1>Screen Size not supported</h1>
        <h5>In order to view this page, you must use a proper computer screen.</h5>
    </div>
</div>

{{-- site header --}}
<div class="bg-dark text-light px-4 py-2 shadow-sm d-flex align-items-center">
    <div class="fs-3"><i class="bi bi-menu-button-wide"></i> Control Panel</div>
    <a class="ms-auto px-4 btn btn-outline-light rounded-0" href="/">Go to Website</a>
</div>

<div class="row g-0" style="height: calc(100% - 58px)">
    <div class="col-3 col-xl-3 col-xxl-2 bg-body-tertiary border-end px-4 py-3">
        <nav class="h-100">
            <ul class="nav flex-column gap-2 h-100">
                <li><a href="/admin/dashboard" class="d-block text-decoration-none"><i class="bi bi-house fs-4 me-2"></i> Dashboard</a></li>

                <li class="text-secondary mt-3 pb-1 border-bottom fs-5">Users</li>
                <li><a href="/admin/dashboard/registration_requests" class="d-block text-decoration-none"><i class="bi bi-person-check fs-4 me-2"></i> Registration Requests</a></li>
                <li><a href="/admin/dashboard/users" class="d-block text-decoration-none"><i class="bi bi-people fs-4 me-2"></i> Users</a></li>
                <li><a href="/admin/dashboard/majors" class="d-block text-decoration-none"><i class="bi bi-mortarboard fs-4 me-2"></i> Majors</a></li>

                <li class="text-secondary mt-3 pb-1 border-bottom fs-5">Colleges & Faculties</li>
                <li><a href="/admin/dashboard/faculties" class="d-block text-decoration-none"><i class="bi bi-buildings fs-4 me-2"></i> View All</a></li>
                <li><a href="/admin/dashboard/faculties/create" class="d-block text-decoration-none"><i class="bi bi-building-add fs-4 me-2"></i> Create</a></li>


                <li class="mt-auto">
                    <form action="/logout" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn link-primary rounded-0 p-0"><i class="bi bi-box-arrow-left fs-4 me-2"></i> Log Out</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>

    <div class="col">
        {{-- breadcrumbs nav div --}}
        <div class="bg-body-tertiary px-4 py-2 fs-5 border-bottom">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item text-capitalize">Admin</li>
                    @php
                        $currentURL = '/admin';

                        foreach ($pathArray as $segment) {
                            $currentURL .= "/$segment";

                            echo '<li class="breadcrumb-item text-capitalize">' . "<a href='$currentURL'>$segment</a>" . '</li>';
                        }
                    @endphp
                </ol>
            </nav>
        </div>

        {{-- main content --}}
        <main class="px-4 py-2 overflow-y-scroll" style="height:  calc(100vh - 105px)">
            {{ $slot }}
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>
