<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/icon/favicon.ico') }}">
    @yield('style')
   
</head>
<body>
    <div class="dashboard-container">
        @include('partials.sidebar')
        @include('partials.topbar')
        @yield('content')
    </div>
</body>
</html>