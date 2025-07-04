<!DOCTYPE html>
<html lang = 'en'>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>@yield('title', 'App')</title>
        @stack('styles')
        @stack('scripts')
    </head>
    <body class="{{$theme === 'dark' ? 'bg-dark text-light' : 'bg-white text-dark'}} {{$density === 'compact' ? 'density-compact' : ''}}">

    <x-navbar
            :username="Auth::user()?->login ?? __('User')"
            :lang="__('Language')"
        />
        @yield('content')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="{{asset('/js/navbarlang.js')}}"></script>
    </body>
</html>
