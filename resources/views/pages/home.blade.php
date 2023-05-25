<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords"
        content="​Lessons &amp;amp; Practice, ​Meet some of our partners!, ​Integrity. Uniqueness. Enjoyment. Ever Forward., ​Our Mission, Contact Us">
    <meta name="description" content="">
    <title>Home</title>
    <link rel="stylesheet" href="{{ url('frontend/nicepage.css') }}" media="screen">
    <link rel="stylesheet" href="{{ url('frontend/Home.css') }}" media="screen">
    <script class="u-script" type="text/javascript" src="{{ url('frontend/jquery.js') }}" defer=""></script>
    <script class="u-script" type="text/javascript" src="{{ url('frontend/nicepage.js') }}" defer=""></script>
    <meta name="generator" content="Nicepage 5.7.9, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "",
            "logo": "{{ url('logo_1.jpg') }}"
        }
    </script>
    <meta name="theme-color" content="#4551dd">
    <meta property="og:title" content="Home">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/">
</head>
<body class="u-body u-xl-mode" data-lang="en">
    <header class="u-clearfix u-header u-header" id="sec-fe69">
        <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
            <a href="https://nicepage.com" class="u-image u-logo u-image-1">
                <img src="{{ url('logo_1.jpg') }}" class="u-logo-image u-logo-image-1">
            </a>
            <nav class="u-menu u-menu-hamburger u-offcanvas u-menu-1" data-responsive-from="XL">
                <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px; font-weight: 700;">
                    <a class="u-button-style u-custom-border u-custom-border-color u-custom-borders u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-color u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base"
                        href="#">
                        <svg class="u-svg-link" viewBox="0 0 24 24">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use>
                        </svg>
                        <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px"
                            xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <rect y="1" width="16" height="2"></rect>
                                <rect y="7" width="16" height="2"></rect>
                                <rect y="13" width="16" height="2"></rect>
                            </g>
                        </svg>
                    </a>
                </div>
                <div class="u-nav-container">
                    <ul class="u-nav u-spacing-20 u-unstyled u-nav-1">
                        <li class="u-nav-item"><a
                                class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base"
                                href="{{ route('home') }}" style="padding: 10px;">Home</a>
                        </li>
                        @if (Auth::user())
                        <li class="u-nav-item"><a
                            class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base"
                            href="{{ route('dashboard') }}" style="padding: 10px;">Dashboard</a>
                        </li>
                        <li class="u-nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base" href="{{ route('logout') }}" style="padding: 10px; color: #FFF !important;" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </a>
                            </form>
                        </li>
                        @else
                        <li class="u-nav-item"><a
                            class="u-button-style u-nav-link u-text-active-palette-1-base u-text-grey-90 u-text-hover-palette-2-base"
                            href="{{ route('login') }}" style="padding: 10px;">Login</a>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="u-nav-container-collapse">
                    <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
                        <div class="u-inner-container-layout u-sidenav-overflow">
                            <div class="u-menu-close"></div>
                            <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2">
                                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="{{ route('home') }}">Home</a>
                                </li>
                                @if (Auth::user())
                                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="u-nav-item">
                                    <a class="u-button-style u-nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </a>
                            </li>
                                @else
                                <li class="u-nav-item"><a class="u-button-style u-nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
                </div>
            </nav>
        </div>
    </header>
    <section
        class="u-align-center-sm u-align-center-xs u-align-right-lg u-align-right-md u-align-right-xl u-clearfix u-palette-1-base u-section-1"
        id="sec-d422">
        <div
            class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-sheet-1">
            <div alt="" class="u-image u-image-circle u-image-1" data-image-width="1080" data-image-height="1080"
                data-animation-name="customAnimationIn" data-animation-duration="1500" data-animation-delay="250"></div>
            <div class="u-bottom-left-radius-19 u-container-align-left u-container-style u-group u-palette-1-base u-shape-round u-top-left-radius-19 u-group-1"
                data-animation-name="customAnimationIn" data-animation-duration="1500" data-animation-delay="500">
                <div class="u-container-layout u-valign-middle-md u-valign-middle-sm u-container-layout-1">
                    <h1 class="u-align-left u-text u-text-body-alt-color u-text-default u-text-1"> SMKN 4 Kota Bengkulu</h1>
                </div>
            </div>
            <div class="u-list u-list-1">
                <div class="u-repeater u-repeater-1">
                    <div class="u-container-style u-list-item u-radius-20 u-repeater-item u-shape-round u-video-cover u-white u-list-item-1"
                        data-animation-name="customAnimationIn" data-animation-duration="1500"
                        data-animation-delay="750">
                        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-2"><span
                                class="u-file-icon u-icon u-icon-circle u-palette-2-base u-text-palette-1-base u-icon-1"
                                data-animation-name="customAnimationIn" data-animation-duration="1750"
                                data-animation-delay="500"><img src="{{ url('1.png') }}" alt=""></span>
                            <h4 class="u-align-center u-text u-text-palette-1-base u-text-2">Nautika Kapal Penangkap Ikan</h4>
                        </div>
                    </div>
                    <div class="u-align-center u-container-style u-list-item u-radius-20 u-repeater-item u-shape-round u-video-cover u-white u-list-item-2"
                        data-animation-name="customAnimationIn" data-animation-duration="1500"
                        data-animation-delay="750">
                        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-3"><span
                                class="u-file-icon u-icon u-icon-circle u-palette-2-base u-text-palette-1-base u-icon-2"
                                data-animation-name="customAnimationIn" data-animation-duration="1750"
                                data-animation-delay="500"><img src="{{ url('2.png') }}" alt=""></span>
                            <h4 class="u-text u-text-palette-1-base u-text-3">Teknik Kapal Penangkap Ikan</h4>
                        </div>
                    </div>
                    <div class="u-align-center u-container-style u-list-item u-radius-20 u-repeater-item u-shape-round u-video-cover u-white u-list-item-3"
                        data-animation-name="customAnimationIn" data-animation-duration="1500"
                        data-animation-delay="750">
                        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-4"><span
                                class="u-file-icon u-icon u-icon-circle u-palette-2-base u-text-palette-1-base u-icon-3"
                                data-animation-name="customAnimationIn" data-animation-duration="1750"
                                data-animation-delay="500"><img src="{{ url('3.png') }}" alt=""></span>
                            <h4 class="u-text u-text-palette-1-base u-text-4"> Agribisnis Pengolahan Hasil Perikanan</h4>
                        </div>
                    </div>
                    <div class="u-align-center u-container-style u-list-item u-radius-20 u-repeater-item u-shape-round u-video-cover u-white u-list-item-4"
                        data-animation-name="customAnimationIn" data-animation-duration="1500"
                        data-animation-delay="750">
                        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-5"><span
                                class="u-file-icon u-icon u-icon-circle u-palette-2-base u-text-palette-1-base u-icon-4"
                                data-animation-name="customAnimationIn" data-animation-duration="1750"
                                data-animation-delay="500"><img src="{{ url('4.png') }}" alt=""></span>
                            <h4 class="u-text u-text-palette-1-base u-text-5">Pengembangan Perangkat Lunak dan Gin</h4>
                        </div>
                    </div>
                    <div class="u-align-center u-container-style u-list-item u-radius-20 u-repeater-item u-shape-round u-video-cover u-white u-list-item-5"
                        data-animation-name="customAnimationIn" data-animation-duration="1500"
                        data-animation-delay="750">
                        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-6"><span
                                class="u-file-icon u-icon u-icon-circle u-palette-2-base u-text-palette-1-base u-icon-5"
                                data-animation-name="customAnimationIn" data-animation-duration="1750"
                                data-animation-delay="500"><img src="{{ url('5.png') }}" alt=""></span>
                            <h4 class="u-text u-text-palette-1-base u-text-6"> Teknik Kendaraan Ringan Otomotif</h4>
                        </div>
                    </div>
                    <div class="u-align-center u-container-style u-list-item u-radius-20 u-repeater-item u-shape-round u-video-cover u-white u-list-item-6"
                        data-animation-name="customAnimationIn" data-animation-duration="1500"
                        data-animation-delay="750">
                        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-7"><span
                                class="u-file-icon u-icon u-icon-circle u-palette-2-base u-text-palette-1-base u-icon-6"
                                data-animation-name="customAnimationIn" data-animation-duration="1750"
                                data-animation-delay="500"><img src="{{ url('6.png') }}" alt=""></span>
                            <h4 class="u-text u-text-palette-1-base u-text-7"> Teknik dan Bisnis Sepeda Motor</h4>
                        </div>
                    </div>
                    <div class="u-align-center u-container-style u-list-item u-radius-20 u-repeater-item u-shape-round u-video-cover u-white u-list-item-7"
                        data-animation-name="customAnimationIn" data-animation-duration="1500"
                        data-animation-delay="750">
                        <div class="u-container-layout u-similar-container u-valign-top u-container-layout-8"><span
                                class="u-file-icon u-icon u-icon-circle u-palette-2-base u-text-palette-1-base u-icon-7"
                                data-animation-name="customAnimationIn" data-animation-duration="1750"
                                data-animation-delay="500"><img src="{{ url('7.png') }}" alt=""></span>
                            <h4 class="u-text u-text-palette-1-base u-text-8"> Teknik Body Otomotif</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="u-clearfix u-section-5" id="carousel_a589">
        <div class="u-expanded-width u-palette-1-base u-shape u-shape-rectangle u-shape-1"></div>
        <div class="u-align-left u-image u-image-circle u-image-1" data-image-width="1080" data-image-height="1080"
            data-animation-name="customAnimationIn" data-animation-duration="1500" data-animation-delay="250"></div>
        <div class="u-align-left u-container-style u-group u-radius-20 u-shape-round u-white u-group-1"
            data-animation-name="customAnimationIn" data-animation-duration="1500" data-animation-delay="500">
            <div class="u-container-layout u-valign-middle u-container-layout-1">
                <h2 class="u-align-left u-text u-text-1"> Tentang Sekolah</h2>
                <p class="u-align-left u-text u-text-2">Sekolah Menengah Kejuruan Negeri 4 Kota Bengkulu berakreditasi A yang terletak dijalan Jalan Enggano, Pasar Bengkulu, Kecamatan Sungai Serut, Kota Bengkulu, Bengkulu 38119.</p>
                <a href="https://nicepage.one"
                    class="u-active-palette-1-base u-align-left u-border-none u-btn u-btn-round u-button-style u-hover-feature u-hover-palette-1-base u-palette-2-base u-radius-50 u-text-active-white u-text-hover-white u-text-palette-1-base u-btn-2"
                    data-animation-name="" data-animation-duration="0" data-animation-delay="0"
                    data-animation-direction="">learn more</a>
            </div>
        </div>
    </section>
    <section class="u-clearfix u-section-6" id="carousel_4970">
        <div class="u-clearfix u-sheet u-valign-middle-sm u-valign-middle-xs u-sheet-1">
            <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
                <div class="u-gutter-0 u-layout">
                    <div class="u-layout-col">
                        <div class="u-size-20">
                            <div class="u-layout-row">
                                <div class="u-container-align-right u-container-style u-layout-cell u-size-23 u-layout-cell-1"
                                    data-animation-name="customAnimationIn" data-animation-duration="1250"
                                    data-animation-delay="500">
                                    <div class="u-container-layout u-valign-middle u-container-layout-1">
                                        <h6
                                            class="u-align-right u-custom-font u-font-montserrat u-text u-text-default u-text-palette-1-base u-text-1">
                                            Dr. Paidi, M.TPd <br><br> Jabatan - Kepala Sekolah</h6>
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="u-container-align-left-sm u-container-align-left-xs u-container-style u-layout-cell u-size-14 u-layout-cell-2">
                                    <div class="u-container-layout u-valign-middle u-container-layout-2">
                                        <img class="u-border-8 u-border-palette-2-base u-image u-image-circle u-image-1"
                                            src="{{ url('photo/pak paidi.png') }}" alt=""
                                            data-image-width="1500" data-image-height="1000"
                                            data-animation-name="customAnimationIn" data-animation-duration="1500"
                                            data-animation-delay="0">
                                    </div>
                                </div>
                                <div
                                    class="u-container-align-right-sm u-container-align-right-xs u-container-style u-layout-cell u-size-23 u-layout-cell-3">
                                    <div class="u-container-layout u-valign-middle u-container-layout-3">
                                        <div class="u-social-icons u-spacing-10 u-social-icons-1"
                                            data-animation-name="customAnimationIn" data-animation-duration="1500">
                                            <a class="u-social-url" title="twitter" target="_blank"
                                                href="https://twitter.com/name"><span
                                                    class="u-icon u-social-icon u-social-twitter u-text-palette-1-base u-icon-1"><img src="{{ url('logo_1.jpg') }}" alt=""></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="u-size-20">
                            <div class="u-layout-row">
                                <div
                                    class="u-container-align-left-sm u-container-align-left-xs u-container-align-right-lg u-container-align-right-md u-container-align-right-xl u-container-style u-layout-cell u-size-23 u-layout-cell-4">
                                    <div class="u-container-layout u-valign-middle u-container-layout-4">
                                        <div class="u-social-icons u-spacing-10 u-social-icons-2"
                                            data-animation-name="customAnimationIn" data-animation-duration="1500">
                                            <a class="u-social-url" title="twitter" target="_blank"
                                                href="https://twitter.com/name"><span
                                                    class="u-icon u-social-icon u-social-twitter u-text-palette-1-base u-icon-2"><img src="{{ url('logo_1.jpg') }}" alt=""></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="u-container-align-right-sm u-container-align-right-xs u-container-style u-layout-cell u-size-14 u-layout-cell-5">
                                    <div class="u-container-layout u-valign-middle u-container-layout-5">
                                        <img class="u-border-8 u-border-palette-2-base u-image u-image-circle u-image-2"
                                            src="{{ url('profil.jpg') }}" alt=""
                                            data-image-width="1619" data-image-height="1080"
                                            data-animation-name="customAnimationIn" data-animation-duration="1500"
                                            data-animation-delay="250">
                                    </div>
                                </div>
                                <div class="u-container-align-left u-container-style u-layout-cell u-size-23 u-layout-cell-6"
                                    data-animation-name="customAnimationIn" data-animation-duration="1500"
                                    data-animation-delay="500">
                                    <div class="u-container-layout u-valign-middle u-container-layout-6">
                                        <h6
                                            class="u-align-left u-custom-font u-font-montserrat u-text u-text-default u-text-palette-1-base u-text-3">
                                            Erniyati <br><br> Jabatan - Kepala Tenaga Administrasi Sekolah </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="u-size-20">
                            <div class="u-layout-row">
                                <div class="u-container-align-right u-container-style u-layout-cell u-size-23 u-layout-cell-1"
                                    data-animation-name="customAnimationIn" data-animation-duration="1250"
                                    data-animation-delay="500">
                                    <div class="u-container-layout u-valign-middle u-container-layout-1">
                                        <h6
                                            class="u-align-right u-custom-font u-font-montserrat u-text u-text-default u-text-palette-1-base u-text-1">
                                            Yulina Wetsy, M.Pd.Si <br><br> Jabatan - Wakil Kepala Sekolah Bidang Manajemen Mutu
                                        </h6>
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="u-container-align-left-sm u-container-align-left-xs u-container-style u-layout-cell u-size-14 u-layout-cell-2">
                                    <div class="u-container-layout u-valign-middle u-container-layout-2">
                                        <img class="u-border-8 u-border-palette-2-base u-image u-image-circle u-image-1"
                                            src="{{ url('photo/Wetsi.png') }}" alt=""
                                            data-image-width="1500" data-image-height="1000"
                                            data-animation-name="customAnimationIn" data-animation-duration="1500"
                                            data-animation-delay="0">
                                    </div>
                                </div>
                                <div
                                    class="u-container-align-right-sm u-container-align-right-xs u-container-style u-layout-cell u-size-23 u-layout-cell-3">
                                    <div class="u-container-layout u-valign-middle u-container-layout-3">
                                        <div class="u-social-icons u-spacing-10 u-social-icons-1"
                                            data-animation-name="customAnimationIn" data-animation-duration="1500">
                                            <a class="u-social-url" title="twitter" target="_blank"
                                                href="https://twitter.com/name"><span
                                                    class="u-icon u-social-icon u-social-twitter u-text-palette-1-base u-icon-1"><img src="{{ url('logo_1.jpg') }}" alt=""></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="u-size-20">
                            <div class="u-layout-row">
                                <div
                                    class="u-container-align-left-sm u-container-align-left-xs u-container-align-right-lg u-container-align-right-md u-container-align-right-xl u-container-style u-layout-cell u-size-23 u-layout-cell-4">
                                    <div class="u-container-layout u-valign-middle u-container-layout-4">
                                        <div class="u-social-icons u-spacing-10 u-social-icons-2"
                                            data-animation-name="customAnimationIn" data-animation-duration="1500">
                                            <a class="u-social-url" title="twitter" target="_blank"
                                                href="https://twitter.com/name"><span
                                                    class="u-icon u-social-icon u-social-twitter u-text-palette-1-base u-icon-2"><img src="{{ url('logo_1.jpg') }}" alt=""></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="u-container-align-right-sm u-container-align-right-xs u-container-style u-layout-cell u-size-14 u-layout-cell-5">
                                    <div class="u-container-layout u-valign-middle u-container-layout-5">
                                        <img class="u-border-8 u-border-palette-2-base u-image u-image-circle u-image-1"
                                            src="{{ url('photo/pak hafidh zaini.png') }}" alt=""
                                            data-image-width="1619" data-image-height="1080"
                                            data-animation-name="customAnimationIn" data-animation-duration="1500"
                                            data-animation-delay="250">
                                    </div>
                                </div>
                                <div class="u-container-align-left u-container-style u-layout-cell u-size-23 u-layout-cell-6"
                                    data-animation-name="customAnimationIn" data-animation-duration="1500"
                                    data-animation-delay="500">
                                    <div class="u-container-layout u-valign-middle u-container-layout-6">
                                        <h6
                                            class="u-align-left u-custom-font u-font-montserrat u-text u-text-default u-text-palette-1-base u-text-3">
                                            Hafidh Zaini, M.Pd <br><br> Jabatan - Wakil Kepala Sekolah Bidang Akademik </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="u-size-20">
                            <div class="u-layout-row">
                                <div class="u-container-align-right u-container-style u-layout-cell u-size-23 u-layout-cell-1"
                                    data-animation-name="customAnimationIn" data-animation-duration="1250"
                                    data-animation-delay="500">
                                    <div class="u-container-layout u-valign-middle u-container-layout-1">
                                        <h6
                                            class="u-align-right u-custom-font u-font-montserrat u-text u-text-default u-text-palette-1-base u-text-1">
                                            Nursyahid, S.Pd <br><br> Jabatan - Wakil Kepala Sekolah Bidang Kesiswaan
                                        </h6>
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="u-container-align-left-sm u-container-align-left-xs u-container-style u-layout-cell u-size-14 u-layout-cell-2">
                                    <div class="u-container-layout u-valign-middle u-container-layout-2">
                                        <img class="u-border-8 u-border-palette-2-base u-image u-image-circle u-image-1"
                                            src="{{ url('photo/nursahid.png') }}" alt=""
                                            data-image-width="1500" data-image-height="1000"
                                            data-animation-name="customAnimationIn" data-animation-duration="1500"
                                            data-animation-delay="0">
                                    </div>
                                </div>
                                <div
                                    class="u-container-align-right-sm u-container-align-right-xs u-container-style u-layout-cell u-size-23 u-layout-cell-3">
                                    <div class="u-container-layout u-valign-middle u-container-layout-3">
                                        <div class="u-social-icons u-spacing-10 u-social-icons-1"
                                            data-animation-name="customAnimationIn" data-animation-duration="1500">
                                            <a class="u-social-url" title="twitter" target="_blank"
                                                href="https://twitter.com/name"><span
                                                    class="u-icon u-social-icon u-social-twitter u-text-palette-1-base u-icon-1"><img src="{{ url('logo_1.jpg') }}" alt=""></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="u-size-20">
                            <div class="u-layout-row">
                                <div
                                    class="u-container-align-left-sm u-container-align-left-xs u-container-align-right-lg u-container-align-right-md u-container-align-right-xl u-container-style u-layout-cell u-size-23 u-layout-cell-4">
                                    <div class="u-container-layout u-valign-middle u-container-layout-4">
                                        <div class="u-social-icons u-spacing-10 u-social-icons-2"
                                            data-animation-name="customAnimationIn" data-animation-duration="1500">
                                            <a class="u-social-url" title="twitter" target="_blank"
                                                href="https://twitter.com/name"><span
                                                    class="u-icon u-social-icon u-social-twitter u-text-palette-1-base u-icon-2"><img src="{{ url('logo_1.jpg') }}" alt=""></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="u-container-align-right-sm u-container-align-right-xs u-container-style u-layout-cell u-size-14 u-layout-cell-5">
                                    <div class="u-container-layout u-valign-middle u-container-layout-5">
                                        <img class="u-border-8 u-border-palette-2-base u-image u-image-circle u-image-1"
                                            src="{{ url('photo/Selvi.png') }}" alt=""
                                            data-image-width="1619" data-image-height="1080"
                                            data-animation-name="customAnimationIn" data-animation-duration="1500"
                                            data-animation-delay="250">
                                    </div>
                                </div>
                                <div class="u-container-align-left u-container-style u-layout-cell u-size-23 u-layout-cell-6"
                                    data-animation-name="customAnimationIn" data-animation-duration="1500"
                                    data-animation-delay="500">
                                    <div class="u-container-layout u-valign-middle u-container-layout-6">
                                        <h6
                                            class="u-align-left u-custom-font u-font-montserrat u-text u-text-default u-text-palette-1-base u-text-3">
                                            Selvi, M.Pd <br><br> Jabatan - Wakil Kepala Sekolah Bidang Hubungan Masyarakat dan Industri </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="u-size-20">
                            <div class="u-layout-row">
                                <div class="u-container-align-right u-container-style u-layout-cell u-size-23 u-layout-cell-1"
                                    data-animation-name="customAnimationIn" data-animation-duration="1250"
                                    data-animation-delay="500">
                                    <div class="u-container-layout u-valign-middle u-container-layout-1">
                                        <h6
                                            class="u-align-right u-custom-font u-font-montserrat u-text u-text-default u-text-palette-1-base u-text-1">
                                            Endrawan Eko Hertanto, S.Pd <br><br> Jabatan - Wakil Kepala Sekolah Bidang Sarana dan Prasarana
                                        </h6>
                                        </p>
                                    </div>
                                </div>
                                <div
                                    class="u-container-align-left-sm u-container-align-left-xs u-container-style u-layout-cell u-size-14 u-layout-cell-2">
                                    <div class="u-container-layout u-valign-middle u-container-layout-2">
                                        <img class="u-border-8 u-border-palette-2-base u-image u-image-circle u-image-1"
                                            src="{{ url('photo/pak eko.png') }}" alt=""
                                            data-image-width="1500" data-image-height="1000"
                                            data-animation-name="customAnimationIn" data-animation-duration="1500"
                                            data-animation-delay="0">
                                    </div>
                                </div>
                                <div
                                    class="u-container-align-right-sm u-container-align-right-xs u-container-style u-layout-cell u-size-23 u-layout-cell-3">
                                    <div class="u-container-layout u-valign-middle u-container-layout-3">
                                        <div class="u-social-icons u-spacing-10 u-social-icons-1"
                                            data-animation-name="customAnimationIn" data-animation-duration="1500">
                                            <a class="u-social-url" title="twitter" target="_blank"
                                                href="https://twitter.com/name"><span
                                                    class="u-icon u-social-icon u-social-twitter u-text-palette-1-base u-icon-1"><img src="{{ url('logo_1.jpg') }}" alt=""></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="u-clearfix u-container-align-center u-white u-section-8" id="carousel_2cb7">
        <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
            <div class="u-expanded-width u-list u-list-1">
                <div class="u-repeater u-repeater-1">
                    <div class="u-align-left u-container-style u-list-item u-palette-1-base u-radius-20 u-repeater-item u-shape-round u-list-item-1"
                        data-animation-name="bounceIn" data-animation-duration="1500" data-animation-direction="Right"
                        data-animation-delay="200">
                        <div class="u-container-layout u-similar-container u-container-layout-3">
                            <h5 class="u-text u-text-2"><span class="u-file-icon u-icon u-text-white"><img
                                        src="images/597177-de35359a.png" alt=""></span>Hubungi Kami
                            </h5>
                            <p class="u-text u-text-3">
                                Telepon : (0736) 20286 <br>
                                Facebook : OTO Maritim SE <br>
                                Instagram : @smkn4Kotabengkulu <br>
                                TikTok : @smkn4kotabengkulu <br>
                                Youtube : SMKN 4 Kota Bengkulu
                            </p>
                        </div>
                    </div>
                    <div class="u-align-left u-container-style u-list-item u-palette-1-base u-radius-20 u-repeater-item u-shape-round u-list-item-2"
                        data-animation-name="bounceIn" data-animation-duration="1500" data-animation-direction="Right"
                        data-animation-delay="200">
                        <div class="u-container-layout u-similar-container u-container-layout-4">
                            <h5 class="u-text u-text-4"><span class="u-file-icon u-icon u-text-white"><img
                                        src="images/484167-0f572cc8.png" alt=""></span>Lokasi
                            </h5>
                            <p class="u-text u-text-5">Jalan Enggano, Pasar Bengkulu, Kecamatan Sungai Serut, Kota Bengkulu, Bengkulu 38119</p>
                        </div>
                    </div>
                    <div class="u-align-left u-container-style u-list-item u-palette-1-base u-radius-20 u-repeater-item u-shape-round u-list-item-3"
                        data-animation-name="bounceIn" data-animation-duration="1500" data-animation-direction="Right"
                        data-animation-delay="200">
                        <div class="u-container-layout u-similar-container u-container-layout-5">
                            <h5 class="u-text u-text-6"><span class="u-file-icon u-icon u-text-white"><img
                                        src="images/1827379-21b799be.png" alt=""></span>Jam Sekolah
                            </h5>
                            <p class="u-text u-text-7">Senin s/d Kamis 07.15 - 16.00 <br>
                                Jum'at 07.15 - 15.40</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
