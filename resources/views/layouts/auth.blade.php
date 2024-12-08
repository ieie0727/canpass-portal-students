<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ config('app.name', 'Laravel') }} - Login</title>

  <!-- Bootstrap CSS -->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

  <!-- Font Awesome Icons (必要なら) -->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
  <div class="container">
    @yield('content')
  </div>

  <!-- Bootstrap JS & jQuery -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>