@props(['title' => 'AABU Talk', 'lang'])

<!doctype html>
<html lang="{{ $lang }}" dir="{{ $lang == 'en' ? 'ltr' : 'rtl' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @if($lang == 'en')
        <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @else
        <link rel="stylesheet" href="{{asset('css/sidebar-rtl.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @endif

    <link rel="stylesheet" href="{{asset('css/common.css')}}">

    <title>{{ $title }}</title>
</head>
<body>
    <script>0</script>

    <x-header></x-header>
    <x-side-bar></x-side-bar>

    <main class="container-md" style="margin-top: 4rem">
        <div class="row justify-content-center">
            <div class="col col-md-9 offset-md-3 col-lg-9 col-xl-10">
                {{ $slot }}
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/sidebar.js')}}"></script>
</body>
</html>
