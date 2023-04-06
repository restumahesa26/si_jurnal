<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">Menu Utama</li>
        <li class="nav-item @if(Route::is('dashboard.*')) active @endif">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="icon-bg"><i class="mdi mdi-checkerboard menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->role == 'Admin')
            <li class="nav-item @if(Route::is('admin-absensi.*')) active @endif">
                <a class="nav-link" href="{{ route('admin-absensi.index') }}">
                    <span class="icon-bg"><i class="mdi mdi-cellphone-link menu-icon"></i></span>
                    <span class="menu-title">Absensi</span>
                </a>
            </li>
            <li class="nav-item @if(Route::is('admin-jurnal.*')) active @endif">
                <a class="nav-link" href="{{ route('admin-jurnal.index') }}">
                    <span class="icon-bg"><i class="mdi mdi-bookmark-check menu-icon"></i></span>
                    <span class="menu-title">Jurnal</span>
                </a>
            </li>
            <li class="nav-item @if(Route::is('siswa.*')) active @endif">
                <a class="nav-link" href="{{ route('siswa.index') }}">
                    <span class="icon-bg"><i class="mdi mdi-account-multiple menu-icon"></i></span>
                    <span class="menu-title">Data Siswa</span>
                </a>
            </li>
            <li class="nav-item @if(Route::is('guru.*')) active @endif">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <span class="icon-bg"><i class="mdi mdi-account-circle menu-icon"></i></span>
                    <span class="menu-title">Data Pengguna</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse @if(Route::is('guru.*') || Route::is('data-admin.*') || Route::is('wali-kelas.*') || Route::is('waka-kurikulum.*')) show @endif" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link @if(Route::is('guru.*')) active @endif" href="{{ route('guru.index') }}">Data Guru</a></li>
                        <li class="nav-item"> <a class="nav-link @if(Route::is('waka-kurikulum.*')) active @endif" href="{{ route('waka-kurikulum.index') }}">Data Waka Kurikulum</a></li>
                        <li class="nav-item"> <a class="nav-link @if(Route::is('data-admin.*')) active @endif" href="{{ route('data-admin.index') }}">Data Admin</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item @if(Route::is('mata-pelajaran.*')) active @endif">
                <a class="nav-link" href="{{ route('mata-pelajaran.index') }}">
                    <span class="icon-bg"><i class="mdi mdi-book-multiple-variant menu-icon"></i></span>
                    <span class="menu-title">Data Mata Pelajaran</span>
                </a>
            </li>
            <li class="nav-item @if(Route::is('kelas.*') || Route::is('kelas-siswa.*')) active @endif">
                <a class="nav-link" href="{{ route('kelas.index') }}">
                    <span class="icon-bg"><i class="mdi mdi-bulletin-board menu-icon"></i></span>
                    <span class="menu-title">Data Kelas</span>
                </a>
            </li>
            <li class="nav-item @if(Route::is('tahun-ajaran.*')) active @endif">
                <a class="nav-link" href="{{ route('tahun-ajaran.index') }}">
                    <span class="icon-bg"><i class="mdi mdi-calendar-multiple-check menu-icon"></i></span>
                    <span class="menu-title">Data Tahun Ajaran</span>
                </a>
            </li>
            <li class="nav-item @if(Route::is('laporan.*')) active @endif">
                <a class="nav-link" href="{{ route('laporan.index') }}">
                    <span class="icon-bg"><i class="mdi mdi-printer menu-icon"></i></span>
                    <span class="menu-title">Laporan</span>
                </a>
            </li>
        @elseif (Auth::user()->role == 'Guru')
            <li class="nav-item @if(Route::is('absensi.*')) active @endif">
                <a class="nav-link" href="{{ route('absensi.select') }}">
                    <span class="icon-bg"><i class="mdi mdi-cellphone-link menu-icon"></i></span>
                    <span class="menu-title">Absensi</span>
                </a>
            </li>
            <li class="nav-item @if(Route::is('laporan.*')) active @endif">
                <a class="nav-link" href="{{ route('laporan.index2') }}">
                    <span class="icon-bg"><i class="mdi mdi-printer menu-icon"></i></span>
                    <span class="menu-title">Laporan</span>
                </a>
            </li>
        @elseif (Auth::user()->role == 'Waka-Kurikulum')
        <li class="nav-item @if(Route::is('waka-kurikulum-jurnal.*')) active @endif">
            <a class="nav-link" href="{{ route('waka-kurikulum-jurnal.index') }}">
                <span class="icon-bg"><i class="mdi mdi-bookmark-check menu-icon"></i></span>
                <span class="menu-title">Jurnal</span>
            </a>
        </li>
        <li class="nav-item @if(Route::is('laporan.*')) active @endif">
            <a class="nav-link" href="{{ route('laporan.index') }}">
                <span class="icon-bg"><i class="mdi mdi-printer menu-icon"></i></span>
                <span class="menu-title">Laporan</span>
            </a>
        </li>
        @endif
        <li class="nav-item sidebar-user-actions mt-3">
            <div class="user-details">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="d-flex align-items-center">
                            <div class="sidebar-profile-text">
                                <p class="mb-1" style="text-transform: uppercase">{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item sidebar-user-actions">
            <div class="sidebar-user-menu">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
                        <span class="menu-title">Log Out</span></a>
                </form>
            </div>
        </li>
    </ul>
</nav>
