<?php
$tPath = app()->environment('local') ? '' : '/public/';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset($tPath.'assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset($tPath.'assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="{{ asset($tPath.'assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ asset($tPath.'assets/css/style.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'css/page/login.css') }}" rel="stylesheet">
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
    @if(isset($logout))
      var logoutt = "{{$logout}}";
      showPopup(logoutt);
    @endif
    </script>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">

          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">
                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-left pb-0 fs-4">Selamat Datang Kembali!</h5>
                    <p class="text-left small">Login untuk mengakses halaman panel</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate id="loginForm">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="text" name="email" class="form-control" id="inpEmail" required>
                        <div class="invalid-feedback">Masukkan  email</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Kata Sandi</label>
                      <input type="password" name="password" class="form-control" id="inpPassword" required>
                      <div class="invalid-feedback">Masukkan Kata Sandi</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-success w-100" type="submit">Masuk</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader" style="display: none;"></div>
  <div id="greenPopup" style="display:none"></div>
  <div id="redPopup" style="display:none"></div>
<!-- Vendor JS Files -->
<script src="{{ asset($tPath.'js/page/login.js?') }}"></script>
<script src="{{ asset($tPath.'assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset($tPath.'assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset($tPath.'assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset($tPath.'assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset($tPath.'assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset($tPath.'assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset($tPath.'assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset($tPath.'assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset($tPath.'assets/js/main.js') }}"></script>


</body>

</html>