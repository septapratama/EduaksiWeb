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

  <title>Device</title>
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


  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <script>
    var csrfToken = "{{ csrf_token() }}";
    var email = "{{$email}}";
    var number = "{{$number}}";
  </script>
  <div class="loading" style="display:none;">
    <div class="bg"></div>
        <div class="content">
          <span>loading...</span>
        <div class="ring"></div>
      </div>
    </div>
  </div>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/page/dashboard" class="logo d-flex align-items-center">
        
        <span class="d-none d-lg-block">SmartTrashKu</span>
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
            <span class="d-none d-md-block dropdown-toggle ps-2">{{$nama}}</span>
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
        <a class="nav-link collapsed" href="/page/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
    <a class="nav-link collapsed" href="/page/edukasi">
      <i class="bi bi-book"></i>
      <span>Edukasi</span>
    </a>
  </li><!-- End Device Nav -->

      <li class="nav-item">
        <a class="nav-link " href="/page/device">
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
        <a class="nav-link collapsed" href="#" data-bs-toggle="modal" data-bs-target="#konfirmasiKeluarModal">
          <i class="bi bi-box-arrow-right"></i>
          <span>Keluar</span>
        </a>
      </li><!-- End Keluar Nav -->
      


    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Device</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Device</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    {{-- menampilkan error validasi --}}
    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <p></p>
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahDeviceModal" onclick="getTambahDevice()">
                <i class="bi bi-plus"></i> Tambahkan Device
              </button>
              <p></p>
              <!-- Modal -->
<div class="modal fade" id="tambahDeviceModal" tabindex="-1" aria-labelledby="tambahDeviceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahDeviceModalLabel">Tambahkan Device</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="tambahDeviceForm" action="{{ route('page.device') }}" method="POST">
        @csrf
        <div class="modal-body">

        <input type="hidden" class="form-control" id="email" name="email" value="{{$email}}">
          <div class="mb-3">
            <label for="tokenInput" class="form-label" >ID Device</label>
            <input type="text" class="form-control  " readonly id="idDeviceInput" name="idDevice">
          </div>
          <div class="mb-3">
            <label for="tokenInput" class="form-label">Token</label>
            <input type="text" class="form-control" readonly id="tokenInput" name="token">
          </div>
          <div class="mb-3">
            <label for="namaDeviceInput" class="form-label">Nama Device</label>
            <input type="text" class="form-control" id="namaDeviceInput" name="namaDeviceInput" value="{{ old('namaDeviceInput') }}">
          </div>
          <div class="mb-3">
            <label for="gpsInput" class="form-label">GPS</label>
            <input type="text" class="form-control" id="gpsInput" name="gpsInput" value="{{ old('gpsInput') }}">
          </div>
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID Device</th>
                    <th scope="col">Nama Device</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  @php $no = 1; @endphp
                @foreach($device as $e)
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{$e->id_device}}</td>
                    <td>{{$e->nama_device}}</td>
                    {{-- <td>{{$e->gps}}</td> --}}
                    <td><a href="#"  data-bs-toggle="modal" data-bs-target="#largeModalEdit{{ $e->id_device }}" type="button"  class="btn btn-success"><i class="bi bi-pencil-square"></i> Edit</a>
                    <a href="#" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModalHapus1{{ $e->id_device }}"><i class="bi bi-trash"></i> Hapus</a>
                    </td>

                                    <!-- Tampilan Modal -->
                <div class="modal fade" id="largeModalHapus1{{ $e->id_device }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="largeModalHapus{{ $e->id_device }}">Konfirmasi Hapus Device</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus device ini?  
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('device.destroy', $e->id_device) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-success">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Basic Modal-->

  
                <!-- modal update -->
                <div class="modal fade" id="largeModalEdit{{ $e->id_device}}" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Update Device</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                      <!-- General Form Elements -->
                      <form class="form-validate" id="artikeledukasiform" method="POST" action="{{ route('device.update', $e->id_device) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
               
               <input type="hidden" name="id" value="{{ isset($device) ? $e->id_device : '' }}">
               <div class="mb-3">
            <label for="namaDeviceInput" class="form-label">Nama Device</label>
            <input type="text" class="form-control" id="namaDeviceInput" name="namaDeviceInput" value="{{ isset($device) ? $e->nama_device : '' }}">
          </div>
          {{-- <div class="mb-3">
            <label for="tokenInput" class="form-label">Token</label>
            <input type="text" class="form-control" id="tokenInput" name="tokenInput"  value="{{ isset($device) ? $e->token : '' }}">
          </div> --}}
          <div class="mb-3">
            <label for="gpsInput" class="form-label">GPS</label>
            <input type="text" class="form-control" id="gpsInput" name="gpsInput"  value="{{ isset($device) ? $e->gps : '' }}">
          </div>
           
                
        
                <div class="row mb-3">
</div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-success">Update</button>
                    </div>
                      </form><!-- End General Form Elements -->
                  </div>
                </div> 

                
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
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
<script src="{{ asset($tPath.'js/page/device.js') }}"></script>

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



<!-- ======= popup =======
<div id="popUpSuccess" style="display:none;">
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
      <button type="submit" class="btn btn-success" onclick="closePopup()">
          <i class="bi bi-box-arrow-right"></i>
          <span>ok</span>
      </button>
  </div>
  </div>
</div> -->
</div>



</body>

</html>