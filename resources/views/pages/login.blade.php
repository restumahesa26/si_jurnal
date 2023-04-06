<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIAS | Login</title>
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ url('backend/assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ url('logo_si_mini.svg') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{ url('logo_si_2.svg') }}">
                            </div>
                            <h4 class="text-dark">Halo! Selamat Datang</h4>
                            <h6 class="font-weight-light">Masukkan email dan password untuk lanjut</h6>
                            @if ($errors->all())
                            <ul>
                                @foreach ($errors->all() as $item)
                                <li class="text-danger">{{ $item }}</li>
                                @endforeach
                            </ul>
                            @endif
                            <form class="pt-3" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="login" placeholder="NIP atau Email" name="login">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="password" placeholder="Password" name="password">
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">LOGIN</button>
                                </div>
                                <div class="my-2 ml-4 d-flex justify-content-between align-items-center">
                                    <input type="checkbox" class="form-check-input" name="remember_me"> Keep me signed in
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('backend/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ url('backend/assets/js/off-canvas.js') }}"></script>
    <script src="{{ url('backend/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ url('backend/assets/js/misc.js') }}"></script>
</body>

</html>
