<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        @yield('title')
    </title>

    @include('includes.style')

    @stack('addon-style')

</head>

<body>
    <div class="container-scroller">

        @include('includes.navbar')

        <div class="container-fluid page-body-wrapper">

            @include('includes.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">

                    @yield('content')

                </div>
                <!-- content-wrapper ends -->

                @include('includes.footer')

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    @include('includes.script')

    @stack('addon-script')

</body>

</html>
