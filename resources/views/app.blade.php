<!DOCTYPE html>
<html lang="en" class="layout-menu-fixed layout-wide"
      data-assets-path="{{ asset('themes/sneat/assets') }}"
      data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Vue Todo</title>

    {{-- Sneat CSS (same files you use in AU-AIS) --}}
    <link rel="stylesheet" href="{{ asset('themes/sneat/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('themes/sneat/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('themes/sneat/assets/vendor/fonts/iconify-icons.css') }}" />

    {{-- Remixicon (you already use these) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" />

    {{-- Vite assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    {{-- Vue mounts here --}}
    <div id="app"></div>
</body>
</html>
