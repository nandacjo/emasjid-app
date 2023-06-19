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
    <link href="{{ asset('adminkit/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

</head>

<body>
    <div class="wrapper">
        {{-- Sidebar --}}
        @include('layouts.base.sidebar')

        <div class="main">

            {{-- Navbar --}}
            @include('layouts.base.navbar')

            <main class="content">
                <div class="row">
                    <div class="col-md-12">

                        <!-- Flash message dari library laracast-->
                        @include('flash::message')

                        <!-- Menampilkan semua error di laravel-->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </main>

            @include('layouts.base.footer')
        </div>
    </div>

    <script src="{{ asset('adminkit/js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Summer note -->
    <!-- include summernote css/js-->
    <link href="{{ asset('summernote/sm/summernote-bs4.css') }}" rel="stylesheet">
    <script src="{{ asset('summernote/sm/summernote-bs4.js') }}"></script>
    <link href="{{ asset('select2/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('select2/js/select2.min.js') }}"></script>

    <script type="module">
    $(document).ready(function() {

        // select2
        $('.select2').select2();

      // summer note
      $('#summernote').summernote({
        tabsize: 2
        , height: 200
      });

      //   library js jquery musk
      $('.rupiah').mask("#.##0", {
        reverse: true
      });

      window.setTimeout(function() {
            $(".alert").fadeTo(300, 0).slideUp(300, function() {
                $(this).remove();
            })
        }, 1000)
    });
  </script>
</body>

</html>
