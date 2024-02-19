<?php
$tPath = app()->environment('local') ? '' : '/public/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{$title}}</title>
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
<link href="{{ asset($tPath.'css/page/forgotPassword.css') }}" rel="stylesheet">
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
  </script>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">
                <div class="card-body" id="sendEmail">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-left pb-0 fs-4">Lupa Password</h5>
                    <p class="text-left small">Pakai fitur ini apabila anda lupa dengan kata sandi.</p>
                  </div>
                  <form class="row g-3 needs-validation" method="post" novalidate id="ForgotPassword">
                    <div class="col-12">
                      <label for="email" class="form-label">Masukkan Email Terdaftar</label>
                      <div class="input-group has-validation">
                        <input type="email" name="email" class="form-control" id="email" required>
                        <div class="invalid-feedback">Masukkan  Email</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-success w-100" type="submit">Kirim Tautan Password</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Sudah punya akun? <a href="/login">Login Sekarang!</a></p>
                    </div>
                  </form>
                </div>
                <div id="otp" style="display: none;">
                  <form id="verifyOTP">
                    <h3>Lupa Password</h3>
                    <p>Pakai fitur ini apabila anda lupa dengan kata sandi</p>
                    <p>Verifikasi OTP</p>
                    <div id="inputs" class="input">
                        <input type="text" id="otp1">
                        <input type="text" id="otp2">
                        <input type="text" id="otp3">   
                        <input type="text" id="otp4">
                        <input type="text" id="otp5">
                        <input type="text" id="otp6">
                    </div>
                    <input type="submit" value="Konfirmasi">
                    <span>Tidak Menerima Kode OTP ? <a onclick="sendOtp()">kirim ulang</a></span>
                  </form>
                </div>
                <div id="gantiPassword" style="display: none;">
                  <form class="row g-3 needs-validation" novalidate id="verifyChange">
                    <div class="col-12">
                      @if(isset($description) && $description == 'createUser')
                      <label for="newPassword" class="form-label">Password</label>
                      <div class="input-group has-validation">
                        <input type="password" name="pass" class="form-control" id="password" required>
                        <div class="invalid-feedback">Masukkan Password</div>
                      </div>
                      @else
                      <label for="newPassword" class="form-label">Password Baru</label>
                      <div class="input-group has-validation">
                        <input type="password" name="pass" class="form-control" id="password" required>
                        <div class="invalid-feedback">Masukkan Password Baru</div>
                      </div>
                      @endif
                    </div>
                    <div class="col-12">
                      @if(isset($description) && $description == 'createUser')
                        <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                        <div class="input-group has-validation">
                            <input type="password" name="pass_new" class="form-control" id="password_new" required>
                            <div class="invalid-feedback">Masukkan Konfirmasi Password</div>
                        </div>
                        @else
                        <label for="confirmPassword" class="form-label">Konfirmasi Password Baru</label>
                        <div class="input-group has-validation">
                            <input type="password" name="pass_new" class="form-control" id="password_new" required>
                            <div class="invalid-feedback">Masukkan Konfirmasi Password Baru</div>
                        </div>
                      @endif
                    </div>
                    <div class="col-12">
                      @if(isset($description) && $description == 'createUser')
                        <button class="btn btn-success w-100" type="submit">Buat Akun</button>
                      @else
                        <button class="btn btn-success w-100" type="submit">Ganti Password</button>
                      @endif
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
  <div id="preloader" style="display: none;"></div>
  <div id="greenPopup" style="display:none;"></div>
  <div id="redPopup" style="display:none;"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script>
  var waktu = '';
    @if(empty($div) || is_null($div) || !isset($div))
        var email = "";
        var div = "";
        var description = "";
        var otp = "";
        var link = "";
        // console.log('kosoooong');
    @else
        var email = "{{$email}}";
        var div = "{{$div}}";
        var description = "{{$description}}";
        // var otp = "{{$code}}";
        var link = "{{$link}}";
        @if(isset($nama))
        var nama = "{{$nama}}";
        @endif
        console.log('divvv ');
        console.log("{{$email}}");
        console.log("{{$div}}");
        console.log("{{$description}}");
        console.log("{{$code}}");
        console.log("{{$link}}");
    @endif
    if(div == 'verifyDiv'){
      document.querySelector('div#sendEmail').style.display = 'none';
      document.querySelector('div#otp').style.display = 'none';
      document.querySelector('div#gantiPassword').style.display = 'block';
    }
  </script>
<!-- Vendor JS Files -->
<script src="{{ asset($tPath.'js/page/forgotPassword.js?') }}"></script>
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>

</body>

</html>