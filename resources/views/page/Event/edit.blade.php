<?php
$tPath = app()->environment('local') ? '' : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Acara | EduAksi</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset($tPath.'img/icon/icon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset($tPath.'assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/popup.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/preloader.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/page/editAcara.css') }}" />
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
    const domain = window.location.protocol + '//' + window.location.hostname + ":" + window.location.port;
    var csrfToken = "{{ csrf_token() }}";
    var email = "{{ $userAuth['email'] }}";
    var number = "{{ $userAuth['number'] }}";
    var uuid = "{{ $event['uuid'] }}";
    var data = {!! json_encode($event) !!};
    </script>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @php
            $nav = 'event';
        @endphp
        @include('page.Components.admin.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('page.Components.admin.header')
            <!--  Header End -->
            <div class="container-fluid" style="background-color: #F6F9FF">
                <div class="pagetitle">
                    <h1>Edit Acara</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="/article">Kelola Acara</a></li>
                            <li class="breadcrumb-item">Edit Acara</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex align-items-stretch"
                    style="background-color: #ffffff; border-radius: 20px; box-shadow: rgba(145,158,171,0.2) 0px 0px 2px 0px, rgba(145,158,171,0.12) 0px 12px 24px -4px;">
                    <form id="editForm">
                        <div class="crow">
                            <label for="">Nama Acara</label>
                            <input type="text" id="inpNamaEvent" value="{{ $event['nama_event'] }}">
                        </div>
                        <div class="crow">
                            <div>
                                <label for="">Tanggal mulai</label>
                                <input type="date" id="tanggal_awal" value="{{ $event['tanggal_awal'] }}">
                            </div>
                            <div>
                                <label for="">Tanggal selesai</label>
                                <input type="date" id="tanggal_akhir" value="{{ $event['tanggal_akhir'] }}">
                            </div>
                        </div>
                        <div class="crow">
                            <label for="">Tempat Acara</label>
                            <input type="text" id="inpTempat" value="{{ $event['tempat'] }}">
                        </div>
                        <div class="crow">
                            <label for="">Deskripsi Acara</label>
                            <textarea name="deskripsi" id="inpDeskripsi" placeholder="Masukkan Deskripsi Acara" class="">{{ $event['deskripsi'] }}</textarea>
                        </div>
                        <div class="crow">
                            <a href="/acara" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-success">
                                <img src="{{ asset($tPath.'img/icon/edit.svg') }}" alt="">
                                <span>Edit</span>
                            </button>
                        </div>
                    </form>
                </div>
                @include('page.Components.admin.footer')
            </div>
        </div>
    </div>
    @include('page.Components.preloader')
    <div id="greenPopup" style="display:none"></div>
    <div id="redPopup" style="display:none"></div>
    <script>
        const currentDate = new Date();
    </script>
    <script src="{{ asset($tPath.'assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset($tPath.'assets/js/app.min.js') }}"></script>
    <script src="{{ asset($tPath.'js/page/editAcara.js') }}"></script>
    <script src="{{ asset($tPath.'js/popup.js') }}"></script>
</body>
</html>