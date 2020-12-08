<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
  <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
</head>
<body class="hold-transition register-page">
<!-- /.register-box -->

<div class="container">
    @include('admin.inc.messages')
</div>

@yield('content')

<script src="{{ asset('admin/js/admin.js') }}"></script>
</body>
</html>
