<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/icon/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main-content.css') }}">
    @yield('style')
   
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            @include('partials.sidebar')            
        </div>
        <div class="main-content">
           
                @include('partials.topbar')
           
           
                @yield('content')
           
        </div> 

    </div>
    @yield('javascript')
</body>
</html>