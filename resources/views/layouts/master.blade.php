<!DOCTYPE html>
<html lang="pt-br">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Telivoz</title>

<!-- Fontfaces CSS-->
<link href="/css/font-face.css" rel="stylesheet" media="all">
<link href="/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
<link href="/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
<link href="/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

<!-- Bootstrap CSS-->
<link href="/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<!-- Vendor CSS-->
<link href="/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
<link href="/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
<link href="/vendor/wow/animate.css" rel="stylesheet" media="all">
<link href="/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
<link href="/vendor/slick/slick.css" rel="stylesheet" media="all">
<link href="/vendor/select2/select2.min.css" rel="stylesheet" media="all">
<link href="/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

<!-- Main CSS-->
<link href="/css/theme.css" rel="stylesheet" media="all">

<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!--script type='text/javascript' src="js/jquery.js"></script-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script src="/js/moment.js"></script>
<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body class="">
  <div class="page-wrapper">@include('partials.header') @include('partials.sidebar')

    <div class="main-content">
      <div class="section__content section__content--p30">
        <div>@yield('content')</div>
      </div>
    </div>
    <div>@include('partials.footer')</div>

  </div>
  <!-- JS-->
  <!-- Jquery JS-->
  <script src="/vendor/jquery-3.2.1.min.js"></script>
  <!-- Bootstrap JS-->
  <script src="/vendor/bootstrap-4.1/popper.min.js"></script>
  <script src="/vendor/bootstrap-4.1/bootstrap.min.js"></script>
  <!-- Vendor JS       -->
  <script src="/vendor/slick/slick.min.js">
  </script>
  <script src="/vendor/wow/wow.min.js"></script>
  <script src="/vendor/animsition/animsition.min.js"></script>
  <script src="/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
  </script>
  <script src="/vendor/counter-up/jquery.waypoints.min.js"></script>
  <script src="/vendor/counter-up/jquery.counterup.min.js">
  </script>
  <script src="/vendor/circle-progress/circle-progress.min.js"></script>
  <script src="/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="/vendor/chartjs/Chart.bundle.min.js"></script>
  <script src="/vendor/select2/select2.min.js">
  </script>

  <!-- Main JS-->
  <script src="/js/main.js"></script>
</body>
