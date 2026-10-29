<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SIAKAD') | {{ config('app.name') }}</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}"
          rel="stylesheet">
    <link href="{{ asset('css/siakad.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-body-tertiary">
    @include('layouts.partials.navbar')
    <div class="container-fluid">
        <div class="row">
            @include('layouts.partials.sidebar')

            <main class="col-lg-9 col-xl-10 px-3 px-md-4 py-4">
                @include('layouts.partials.flash')
                @yield('content')

                <footer class="text-center text-body-secondary small mt-5">
                    &copy; {{ date('Y') }} {{ config('app.name') }}
                    - D3 Teknik Informatika
                </footer>
            </main>
        </div>
    </div>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}">
    </script>
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnTheme = document.getElementById('btn-theme');
            const htmlEl = document.documentElement;
            const themeIcon = document.getElementById('theme-icon');
            const savedTheme = localStorage.getItem('theme') || 'light';
            htmlEl.setAttribute('data-bs-theme', savedTheme);
            updateIcon(savedTheme);

            if (btnTheme) {
                btnTheme.addEventListener('click', function () {
                    let currentTheme = htmlEl.getAttribute('data-bs-theme');
                    let newTheme = currentTheme === 'dark' ? 'light' : 'dark';

                    // Ubah atribut data-bs-theme pada elemen <html>
                    htmlEl.setAttribute('data-bs-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    updateIcon(newTheme);
                });
            }
            function updateIcon(theme) {
                if (theme === 'dark') {
                    if (themeIcon) themeIcon.className = 'bi bi-moon-fill';
                } else {
                    if (themeIcon) themeIcon.className = 'bi bi-sun-fill';
                }
            }
        });
    </script>
    @endpush
    @stack('scripts')
</body>
</html>