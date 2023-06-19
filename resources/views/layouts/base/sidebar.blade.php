<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <!-- Beranda -->
            <li class="sidebar-item {{ Route::is('home') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('home') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Beranda</span>
                </a>
            </li>

            <!-- Data Masjid -->
            <li class="sidebar-item {{ Route::is('masjid.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('masjid.create') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Mesjid</span>
                </a>
            </li>

            <!-- Kas Masjid -->
            <li class="sidebar-item {{ Route::is('kas.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('kas.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Kas
                        Mesjid</span>
                </a>
            </li>

            <!-- Profil Masjid -->
            <li class="sidebar-item {{ Route::is('profil.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('profil.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil
                        Masjid</span>
                </a>
            </li>

            <!-- Kategori -->
            <li class="sidebar-item {{ Route::is('kategori.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('kategori.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Kategori
                        Masjid</span>
                </a>
            </li>

            <!-- Informasi -->
            <li class="sidebar-item {{ Route::is('informasi.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('informasi.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Informasi
                        Masjid</span>
                </a>
            </li>

            <!-- Data bank -->
            <li class="sidebar-item {{ Route::is('masjid-bank.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('masjid-bank.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">
                        Data Bank</span>
                </a>
            </li>

            <!-- Data Kurban -->
            <li
                class="sidebar-item {{ Route::is('kurban.*') ? 'active' : '' }} {{ Route::is('kurban-hewan.*') ? 'active' : '' }} {{ Route::is('kurban-peserta.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('kurban.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">
                        Data Kurban</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
