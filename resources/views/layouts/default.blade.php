<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials.head')
    </head>
    <body class="sb-nav-fixed">
        @include('partials.nav')
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                @include('partials.sidenav')
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @yield('content')
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    @include('partials.footer')
                </footer>
            </div>
        </div>
        @include('partials.script')
    </body>
</html>
