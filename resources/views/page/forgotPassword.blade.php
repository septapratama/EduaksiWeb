<?php
$tPath = app()->environment('local') ? '' : '';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}} | Eduaksi</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset($tPath.'img/icon/icon.png') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'assets/css/styles.min.css') }}">
    <link rel="stylesheet" href="{{ asset($tPath.'css/popup.css') }}">
    <link rel="stylesheet" href="{{ asset($tPath.'css/preloader.css') }}" />
    <link href="{{ asset($tPath.'css/page/forgotPassword.css') }}" rel="stylesheet">
    <style>
        html{
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Poppins', sans-serif;
            user-select: none;
        }
        body img{
            pointer-events: none;
        }
    </style>
</head>

<body>
    @if(app()->environment('local'))
    <script>
    var tPath = '';
    </script>
    @else
    <script>
    var tPath = '';
    </script>
    @endif
    <script>
    var csrfToken = "{{ csrf_token() }}";
    // @if(isset($logout))
    // var logoutt = "{{$logout}}";
    // showPopup(logoutt);
    // @endif
    </script>
    <!--  Body Wrapper -->
    <div class=" page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <div style="display: flex; justify-content: center; gap:10px;">
                                        <img src="{{ asset($tPath.'img/icon/logo.png') }}" alt="" style="width: 80px; height:40px;"></img>
                                        <span class="hide-menu" style="color:black; text-decoration: none; font-size:27px; font-weight:600;">EduAksi</span>
                                    </div>
                                </a>
                                @if(empty($div) || is_null($div) || !isset($div) || $div != 'red')
                                <div id="sendEmail">
                                    <p class="">Masukkan email untuk lupa password.</p>
                                    <form id="ForgotPassword">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Email</label>
                                            <input type="email" id="inpEmail" class="form-control" aria-describedby="emailHelp">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-4"></div>
                                        <input type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Kirim Lupa Password">
                                    </form>
                                </div>
                                <div id="otp" style="display: none;">
                                    <form id="verifyOTP">
                                        <p>Verifikasi OTP</p>
                                        <div class="input">
                                            <input type="text" id="otp1">
                                            <input type="text" id="otp2">
                                            <input type="text" id="otp3">   
                                            <input type="text" id="otp4">
                                            <input type="text" id="otp5">
                                            <input type="text" id="otp6">
                                        </div>
                                        <span>Tidak Menerima Kode OTP ? <a onclick="sendOtp()">kirim ulang</a></span>
                                        <input type="submit" value="Konfirmasi">
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
                                @else
                                <div id="red">
                                    <p>{{ $message }}</p>
                                    <a href="/password/reset" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Kembali</a>
                                </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('page.Components.preloader')
    <div id="greenPopup" style="display:none"></div>
    <div id="redPopup" style="display:none"></div>
    <script>
        var waktu = '';
        @if(empty($div) || is_null($div) || !isset($div))
            var email = "";
            var div = "";
            var description = "";
            var otp = "";
            var link = "";
        @else
            @if($div != 'red')
                var email = "{{$email}}";
                var div = "{{$div}}";
                var description = "{{$description}}";
                // var otp = "{{$code}}";
                var link = "{{$link}}";
                @if(isset($nama))
                var nama = "{{$nama}}";
                @endif
            @endif
        @endif
        if(div == 'verifyDiv'){
            document.querySelector('div#sendEmail').style.display = 'none';
            document.querySelector('div#otp').style.display = 'none';
            document.querySelector('div#gantiPassword').style.display = 'block';
        }
        </script>
    <script src="{{ asset($tPath.'assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset($tPath.'js/page/forgotPassword.js?') }}"></script>
</body>

</html>