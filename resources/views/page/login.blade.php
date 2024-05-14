<?php
$tPath = app()->environment('local') ? '' : '';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | EduAksi</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset($tPath.'img/icon/icon.png') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'assets/css/styles.min.css') }}">
    <link rel="stylesheet" href="{{ asset($tPath.'css/popup.css') }}">
    <link rel="stylesheet" href="{{ asset($tPath.'css/preloader.css') }}" />
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
        #iconPass{
            background-color: transparent;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 7px;
            width: max-content;
            cursor: pointer;
        }
        #iconPass img{
            width: 28px;
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
    @if(isset($logout))
    var logoutt = "{{$logout}}";
    showPopup(logoutt);
    @endif
    </script>
    <!--  Body Wrapper -->
    <div class=" page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <div style="display: flex; justify-content: center;">
                                        <img src="{{ asset($tPath.'img/icon/logo.png') }}" alt="" style="width: 80px; height:40px;"></img>
                                        <span class="hide-menu" style="color:black; text-decoration: none; font-size:27px; font-weight:600;">EduAksi</span>
                                    </div>
                                </a>
                                <form id="loginForm">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="email" id="inpEmail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <div style="position: relative">
                                            <input id="inpPassword" type="password" class="form-control" id="exampleInputPassword1" style="padding-right: 45px;" oninput="showEyePass()">
                                            <div id="iconPass" onclick="showPass()" style="display: none;">
                                                <img src="{{ asset($tPath.'img/icon/eye-slash.svg') }}" alt="" id="passClose">
                                                <img src="{{ asset($tPath.'img/icon/eye.svg') }}" alt="" id="passShow" style="display: none">
                                            </div>
                                        </div>
                                        <a href="/password/reset">Lupa Password ?</a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4"></div>
                                    <input type="submit" href="/admin/login" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Login">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('page.Components.preloader')
    <div id="greenPopup" style="display:none"></div>
    <div id="redPopup" style="display:none"></div>
    <script src="{{ asset($tPath.'assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset($tPath.'js/page/login.js') }}"></script>
</body>

</html>