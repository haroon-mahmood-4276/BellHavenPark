<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Report' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('css')
</head>

<body class="p-3">
    @yield('content')
    @stack('js')
</body>

</html>
