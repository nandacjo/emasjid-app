<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="index.html">
      <span class="align-middle">E-Masjid App</span>
    </a>

    <ul class="sidebar-nav">
      <li class="sidebar-header">
        Pages
      </li>

      <!-- Beranda -->
      <li class="sidebar-item @activeMenu('home')">
        <a class="sidebar-link" href="{{ route('home') }}">
          <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Beranda</span>
        </a>
      </li>

      <li class="sidebar-header">
        Masjid Management
      </li>

      <!-- Data Masjid -->
      <li class="sidebar-item @activeMenu('masjid.*')">
        <a class="sidebar-link" href="{{ route('masjid.create') }}">
          <i class="align-middle" data-feather="user"></i> <span class="align-middle">Mesjid</span>
        </a>
      </li>

      <!-- Infaq Masjid -->
      <li class="sidebar-item @activeMenu('infaq.*')">
        <a class="sidebar-link" href="{{ route('infaq.index') }}">
          <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data Infaq
            Mesjid</span>
        </a>
      </li>

      <!-- Kas Masjid -->
      <li class="sidebar-item @activeMenu('kas.*')">
        <a class="sidebar-link" href="{{ route('kas.index') }}">
          <i class="align-middle" data-feather="user"></i> <span class="align-middle">Kas
            Mesjid</span>
        </a>
      </li>

      <!-- Profil Masjid -->
      <li class="sidebar-item @activeMenu('profil.*')">
        <a class="sidebar-link" href="{{ route('profil.index') }}">
          <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil
            Masjid</span>
        </a>
      </li>

      <!-- Kategori -->
      <li class="sidebar-item @activeMenu('kategori.*')">
        <a class="sidebar-link" href="{{ route('kategori.index') }}">
          <i class="align-middle" data-feather="user"></i> <span class="align-middle">Kategori
            Masjid</span>
        </a>
      </li>

      <li class="sidebar-header">
        Informasi
      </li>

      <!-- Informasi -->
      <li class="sidebar-item @activeMenu('informasi.*')">
        <a class="sidebar-link" href="{{ route('informasi.index') }}">
          <i class="align-middle" data-feather="user"></i> <span class="align-middle">Informasi
            Masjid</span>
        </a>
      </li>

      <!-- Data bank -->
      <li class="sidebar-item @activeMenu('masjid-bank.*')">
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
