<?php
  $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
  // $tPath = app()->environment('local') ? '' : '/public/';
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

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
<link href="{{ asset($tPath.'assets2/img/favicon.png') }}" rel="icon">
<link href="{{ asset($tPath.'assets2/img/apple-touch-icon.png') }}" rel="apple-touch-icon">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

 <!-- Vendor CSS Files -->
<link href="{{ asset($tPath.'assets2/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets2/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets2/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets2/vendor/quill/quill.snow.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets2/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets2/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets2/vendor/simple-datatables/style.css') }}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ asset($tPath.'assets2/css/style.css') }}" rel="stylesheet">


</head>

<body>
  @if(app()->environment('local'))
    <script>
      var tPath = '';
    </script>
  @else
    <script>
      var tPath = '/public/';
    </script>
  @endif
  <script>
    var csrfToken = "{{ csrf_token() }}";
    var email = "{{ $userAuth['email'] }}";
    var number = "{{ $userAuth['number'] }}";
    var role = "{{ $userAuth['role'] }}";
  </script>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/dashboard" class="logo d-flex align-items-center">
        
        <span class="d-none d-lg-block">EduAksi</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

  
       

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ asset($tPath.'assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{$userAuth['nama_lengkap']}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
       
          <li>
            <form method="post" id="logoutForm">
              <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#konfirmasiKeluarModal">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
              </a>
              </form>
            </li>


          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
    <a class="nav-link collapsed" href="/edukasi">
      <i class="bi bi-book"></i>
      <span>Edukasi</span>
    </a>
  </li><!-- End Device Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="/device">
          <i class="bi bi-hdd"></i>
          <span>Device</span>
        </a>
      </li><!-- End Device Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="/page/laporan">
          <i class="bi bi-clipboard-data"></i>
          <span>Laporan</span>
        </a>
      </li><!-- End Device Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href=""  data-bs-toggle="modal" data-bs-target="#konfirmasiKeluarModal">
          <i class="bi bi-box-arrow-right"></i>
          <span>Keluar</span>
        </a>
      </li><!-- End Keluar Nav -->


    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Total Device</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-hdd"></i>
                    </div>
                    <div class="ps-3">
                      {{-- <h6>{{$total}}</h6> --}}
                      <a href="device"><span class="text-muted small pt-2 ps-1">Cek Selengkapnya <i class="bi bi-arrow-right-circle"></i></span></a>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Total Artikel</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-trash2"></i>
                    </div>
                    <div class="ps-3">
                      {{-- <h6>{{$totalArtikel}}</h6> --}}
                      <a href="laporan"><span class="text-muted small pt-2 ps-1">Cek Selengkapnya <i class="bi bi-arrow-right-circle"></i></span></a>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

              
                <div class="filter">
                  <a class="icon" href="" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Total Laporan</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-trash2-fill"></i>
                    </div>
                    <div class="ps-3">
                      {{-- <h6>{{$kosong}}</h6> --}}
                      <a href="laporan"><span class="text-muted small pt-2 ps-1">Cek Selengkapnya <i class="bi bi-arrow-right-circle"></i></span></a>

                    </div>
                  </div>

                </div>
              </div>

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>SmartTrashku</span></strong>. All Rights Reserved
    </div>
    
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<!-- Vendor JS Files -->
<script src="{{ asset($tPath.'assets2/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset($tPath.'assets2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset($tPath.'assets2/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset($tPath.'assets2/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset($tPath.'assets2/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset($tPath.'assets2/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset($tPath.'assets2/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset($tPath.'assets2/vendor/php-email-form/validate.js') }}"></script>

<!-- Modal -->
  <div class="modal fade" id="konfirmasiKeluarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Keluar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin keluar?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form method="post" id="logoutForm">
          <button type="submit" class="btn btn-success">
            <i class="bi bi-box-arrow-right"></i>
            <span>Keluar</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Template Main JS File -->
<script src="{{ asset($tPath.'assets2/js/main.js') }}"></script>
<script src="{{ asset($tPath.'js/page/dashboard.js') }}"></script>

</body>

</html>