<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
  <meta name="author" content="AdminKit">
  <meta name="keywords"
    content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
  <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />
  <title>E-Masjid | {{ $title ?? '' }}</title>
  @vite('resources/sass/app.scss')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

  {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

</head>

<body>
  <div class="wrapper">
    <div class="main">
      <main class="content">
        <div class="container p-0">
          @yield('content')
        </div>
      </main>
    </div>
  </div>

  <script src="{{ asset('adminkit/js/app.js') }}"></script>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
