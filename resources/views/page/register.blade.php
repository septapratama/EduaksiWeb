<?php 
$tPath = app()->environment('local') ? '' : '/public/';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register</title>
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
<link href="{{ asset($tPath.'css/page/register.css') }}" rel="stylesheet">
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
  <div id="popup" style="display: none;"></div>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">
                <div class="card-body" id="registerDiv" style="display: block;">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-left pb-0 fs-4">Daftar Akun Sekarang!</h5>
                    <p class="text-left small">Daftar akun untuk mengakses halaman panel</p>
                  </div>
                  <script>
                    var csrfToken = "{{ csrf_token() }}";
                  </script>
                  <form class="row g-3 needs-validation" id="registerForm" novalidate>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Nama Lengkap</label>
                      <div class="input-group has-validation">
                        <input type="text" name="nama" class="form-control" id="inpNama" required>
                        <div class="invalid-feedback">Masukkan  Nama Lengkap</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="email" name="email" class="form-control" id="inpEmail" required>
                        <div class="invalid-feedback">Masukkan  Email</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Kata Sandi</label>
                      <input type="password" name="password" class="form-control" id="inpPassword" required>
                      <div class="invalid-feedback">Masukkan Kata Sandi</div>
                    </div>
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Konfirmasi Kata Sandi</label>
                      <input type="password" name="password_new" class="form-control" id="inpPassword1" required>
                      <div class="invalid-feedback">Masukkan Konfirmasi Kata Sandi</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-success w-100" type="submit" name="register">Daftar</button>
                    </div>

                    <div class="col-12">
                    <p class="text-center mb-0">atau</p>
                    </div>

                    <div class="col-12">
                      <a class="btn btn-outline-secondary w-100" href="/auth/redirect"><i class="bi bi-google"></i> Daftar dengan Google</a>
                    </div>

                    <div class="col-12">
                      <p class="small mb-0">Sudah punya akun? <a href="login">Login Sekarang!</a></p>
                    </div>
                  </form>
                </div>
                <div id="otp" style="display:none;">
                  <div class="bg"></div>
                  <form action="#" id="VerifyOTP">
                      <h3>Verifikasi Email</h3>
                      <p>Pakai fitur ini untuk Verifikasi Email</p>
                      <p>Verifikasi OTP</p>
                      <div id="inputs" class="input otp">
                          <input type="text" id="otp1">
                          <input type="text" id="otp2">
                          <input type="text" id="otp3">   
                          <input type="text" id="otp4">
                          <input type="text" id="otp5">
                          <input type="text" id="otp6">
                      </div>
                      <input type="submit" value="Konfirmasi OTP">
                      <span>Tidak Menerima Kode OTP ? <a href="#" onclick="sendOtp()">kirim ulang</a></span>
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
<script src="{{ asset($tPath.'js/page/register.js') }}"></script>
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
{{-- <script src="{{ asset($tPath.'js/page/register.js') }}"></script> --}}

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>


</body>

</html>