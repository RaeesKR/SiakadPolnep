<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('judul')</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        h2 { text-align: center; margin-bottom: 4px; }
        .sub { text-align: center; margin-bottom: 14px; color: #555; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 5px 7px; }
        th { background: #e9ecef; }
        .center { text-align: center; }
        th, td { border: 1px solid #333; padding: 5px 7px; vertical-align: top; }
    </style>
</head>
<body>
    <h2>@yield('judul')</h2>
    <div class="sub">Dicetak: {{ now()->format('d-m-Y H:i') }}</div>
    @yield('isi')
</body>
</html>