<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel - QS - Local</title>

    <!-- See: http://styleguide.auth0.com/ -->
    <link rel="stylesheet" href="https://cdn.auth0.com/styleguide/core/2.0.5/core.min.css" />
    <link rel="stylesheet" href="https://cdn.auth0.com/styleguide/components/2.0.0/components.min.css" />
    <link rel="stylesheet" href="/css/main.css" />

</head>
<body>
    <div class="content">
        @yield('content')
        <hr>
        @yield('menu')
    </div>
</body>
</html>
