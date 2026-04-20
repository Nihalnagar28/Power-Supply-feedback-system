{{-- Master Layout --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Power Supply Feedback System — Report and track electricity supply issues in your area.">
    <title>@yield('title', 'Power Supply Feedback System')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('head')
</head>
<body>

    @include('components.navbar')

    <div class="page-wrapper">
        @yield('content')
    </div>

    <footer class="footer">
        <div class="container">
            &copy; {{ date('Y') }} Power Supply Feedback System. All rights reserved.
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
