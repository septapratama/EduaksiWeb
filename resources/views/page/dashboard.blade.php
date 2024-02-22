<?php
$tPath = app()->environment('local') ? '' : '/public/';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | EduAksi</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset($tPath.'assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset($tPath.'assets/css/styles.min.css') }}" />
    <style>
    #kotak{
        background-color:blue;
        display: flex;
        flex-wrap: wrap;
        height: 100%;
        align-content: space-around;
        justify-content: space-around;
    }
    .card{
        width: 47%;
        height:150px;
        display: flex;
        justify-content:center;
        margin-bottom: 0px;
    }
    .card h5, .card div{
        position: relative;
        display: flex;
        left:8%;
    }
    .card h5 {
        font-size: xx-large;
        font-weight: 600;
    }
    .card div {
        display: flex;
        gap:3%;
        align-items:center;
        font-size: x-large;
        font-weight: 600;
    }
    </style>
</head>

<body style="user-select: none;">
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
    const domain = window.location.protocol + '//' + window.location.hostname + ":" + window.location.port;
    var csrfToken = "{{ csrf_token() }}";
    var email = "{{ $userAuth['email'] }}";
    var number = "{{ $userAuth['number'] }}";
    </script>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @php
        $nav = 'dashboard';
        @endphp
        @include('page.Components.admin.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('page.Components.admin.header')
            <!--  Header End -->
            <div class="container-fluid">
                <div class="pagetitle">
                    <h1>Beranda</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Beranda</li>
                        </ol>
                    </nav>
                </div>
                <div id="kotak">
                    <div class="card" style="">
                        <h5 class="">Jumlah Disi</h5>
                        <div class="">
                            <img src="{{ asset($tPath.'img/icon/sidebar/disi.svg') }}" alt="" width="70" height="70">
                            <span>1000</span>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="">Jumlah Disi</h5>
                        <div class="">
                            <img src="{{ asset($tPath.'img/icon/sidebar/disi.svg') }}" alt="" width="70" height="70">
                            <span>1000</span>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="">Jumlah Disi</h5>
                        <div class="">
                            <img src="{{ asset($tPath.'img/icon/sidebar/disi.svg') }}" alt="" width="70" height="70">
                            <span>1000</span>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="">Jumlah Disi</h5>
                        <div class="">
                            <img src="{{ asset($tPath.'img/icon/sidebar/disi.svg') }}" alt="" width="70" height="70">
                            <span>1000</span>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="">Jumlah Disi</h5>
                        <div class="">
                            <img src="{{ asset($tPath.'img/icon/sidebar/disi.svg') }}" alt="" width="70" height="70">
                            <span>1000</span>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="">Jumlah Disi</h5>
                        <div class="">
                            <img src="{{ asset($tPath.'img/icon/sidebar/disi.svg') }}" alt="" width="70" height="70">
                            <span>1000</span>
                        </div>
                    </div>
                </div>
                @include('page.Components.admin.footer')
            </div>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>