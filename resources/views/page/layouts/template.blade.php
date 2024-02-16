<?php
if(app()->environment('local')){
  $tPath = '';
}else{
  $tPath = '/public/';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{  $title }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset($tPath.'assets3/img/smarttrashku.png') }}" rel="icon">
  <link href="{{ asset($tPath.'assets3/img/smarttrashku.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset($tPath.'assets3/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset($tPath.'assets3/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset($tPath.'assets3/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset($tPath.'assets3/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset($tPath.'assets3/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset($tPath.'assets3/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Impact
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/impact-bootstrap-business-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
@include('page/layouts.navbar')
@yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="/" class="logo d-flex align-items-center">
            <span>SmartTrashKu</span>
          </a>
          <p>Politeknik Negeri Jember.</p>
          <div class="social-links d-flex mt-4">
            <a href="https://www.instagram.com/smartrashku/" class="instagram"><i class="bi bi-instagram"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Halaman</h4>
          <ul>
            <li><a href="/">Beranda</a></li>
            <li><a href="/blog">Artikel</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Alamat</h4>
          <p>
            Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Kontak</h4>
            <strong>Email:</strong> pkmki2023.thegsteam@gmail.com<br>
          </p>

        </div>

      </div>
    </div>

    <div class="container mt-4">
      <div class="copyright">
        &copy; Copyright <strong><span>SmartTrashKu</span></strong>. All Rights Reserved
      </div>
     
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset($tPath.'assets3/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset($tPath.'assets3/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset($tPath.'assets3/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset($tPath.'assets3/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset($tPath.'assets3/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset($tPath.'assets3/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset($tPath.'assets3/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset($tPath.'assets3/js/main.js') }}"></script>

</body>

</html>