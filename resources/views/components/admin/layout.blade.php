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
<div class="d-flex d-lg-none position-fixed top-0 left-0 vw-100 vh-100 bg-danger-subtle text-danger-emphasis align-items-center justify-content-center">
    <div class="text-center">
        <h1 style="font-size: 8rem"><i class="bi bi-x-octagon-fill"></i></h1>
        <h1>Screen Size not supported</h1>
        <h5>In order to view this page, you must use a proper computer screen.</h5>
    </div>
</div>

<div class="bg-dark text-light fs-3 px-4 py-2 shadow-sm"><i class="bi bi-menu-button-wide"></i> Control Panel</div>

<div class="row g-0" style="height: calc(100% - 58px)">
    <div class="col-4 col-xl-3 col-xxl-2 bg-body-tertiary border-end">

    </div>
    <div class="col">
        {{-- breadcrumbs nav div --}}
        <div class="bg-body-secondary px-4 py-2 fs-5">
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
        <main class="px-4 py-2">
            {{ $slot }}
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>
