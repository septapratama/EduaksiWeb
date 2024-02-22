<?php
$tPath = app()->environment('local') ? '' : '/public/';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Nutrisi | EduAksi</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset($tPath.'assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset($tPath.'assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/popup.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/page/tambahData.css') }}" />
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
    const domain = window.location.protocol + '//' + window.location.hostname + ":" + window.location.port;
    const reff = '/nutrisi';
    var csrfToken = "{{ csrf_token() }}";
    var email = "{{ $userAuth['email'] }}";
    var number = "{{ $userAuth['number'] }}";
    </script>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @php
        $nav = 'nutrisi';
        @endphp
        @include('page.Components.admin.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper" style="background-color: #efefef;">
            <!--  Header Start -->
            @include('page.Components.admin.header')
            <!--  Header End -->
            <div class="container-fluid">
                <div class="pagetitle">
                    <h1>Tambah Nutrisi</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="/nutrisi">Kelola Nutrisi</a></li>
                            <li class="breadcrumb-item">Tambah Nutrisi</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex align-items-stretch" style="background-color: #ffffff; border-radius: 20px;">
                    <form id="tambahForm">
                        <div class="crow">
                            <label for="">Judul Nutrisi</label>
                            <input type="text" id="inpJudul">
                        </div>
                        <div class="crow">
                            <div>
                                <label for="">Rentang Usia</label>
                                <select class="" aria-label="Default select example" id="inpRentangUsia">
                                    <option value="" selected>Pilih Umur</option>
                                    <option value="0-3 Tahun">0-3 Tahun</option>
                                    <option value="4-6 Tahun">4-6 Tahun</option>
                                    <option value="7-9 Tahun">7-9 Tahun</option>
                                    <option value="10-12 Tahun">10-12 Tahun</option>
                                </select>
                            </div>
                            <div>
                                <label for="">Link Video</label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="crow">
                            <label for="">Deskripsi</label>
                            <textarea name="deskripsi" id="inpDeskripsi" placeholder="Masukkan Isi Nutrisi" class=""
                                style="height:120px"></textarea>
                        </div>
                        <div class="img" onclick="handleFileClick()" ondragover="handleDragOver(event)"
                            ondrop="handleDrop(event)">
                            <img src="{{ asset($tPath.'img/icon/upload.svg') }}" alt="">
                            <span>Pilih File atau Jatuhkan File</span>
                            <input type="file" id="inpFoto" hidden onchange="handleFileChange(event)">
                        </div>
                        <div class="crow">
                            <a href="/nutrisi" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-success"><img
                                    src="{{ asset($tPath.'img/icon/tambah.svg') }}" alt="" width="30"
                                    height="30"><span>Tambah</span></button>
                        </div>
                    </form>
                </div>
                @include('page.Components.admin.footer')
            </div>
        </div>
    </div>
    <div id="preloader" style="display: none;"></div>
    <div id="greenPopup" style="display:none"></div>
    <div id="redPopup" style="display:none"></div>
    <script src="{{ asset($tPath.'assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset($tPath.'assets/js/app.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset($tPath.'assets/js/dashboard.js') }}"></script>
    <script src="{{ asset($tPath.'js/page/tambahData.js') }}"></script>
    <script src="{{ asset($tPath.'js/popup.js') }}"></script>
</body>

</html>