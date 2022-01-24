<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | {{app['name']}}</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="icon" href="/favicon.png">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand">{{app['name']}}</a>
        </div>
    </nav>

    <main>
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">@yield('title')</div>
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery.min.js"></script>
</body>
</html>