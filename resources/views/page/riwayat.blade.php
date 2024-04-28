<?php
$tPath = app()->environment('local') ? '' : '';
$constDB = ['ds'=>'digital_literasi', 'em'=>'emosi_mental', 'nt'=>'nutrisi', 'pn'=>'pengasuhan', 'ks'=>'konsultasi', 'ar'=>'article'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Riwayat | EduAksi</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset($tPath.'img/icon/icon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset($tPath.'assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/page/modalDelete.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/popup.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/preloader.css') }}" />
    <style>
    th {
        white-space: nowrap;
    }
    th:nth-child(3) {
        width: 20%;
    }
    td:last-child {
        position: relative;
        display: flex;
        flex-direction: row;
    }
    .btn-lihat{
        padding: 0px;
        display: flex;
        width: 100px;
        height: 40px;
        align-items: center;
        justify-content: space-evenly;
        border: none;
        font-size: 17px;
    }
    .btn-lihat img{
        width: 24px;
        height: 24px;
    }
    @media screen and (min-width: 700px) and (max-width: 1100px) {
        th:nth-child(3) {
            width: 23%;
        }
        .btn-lihat{
            width: 90px;
            height: 40px;
            font-size: 16px;
        }
        .btn-lihat img{
            width: 22px;
            height: 22px;
        }
    }
    @media screen and (min-width: 500px) and (max-width: 700px) {
        .table{
            margin-top: 7px;
        }
        .table>:not(caption)>*>*{
            padding: 7px 7px;
        }
        th h6{
            font-size: 14px;
        }
        th:nth-child(3){
            width: 27%;
        }
        td{
            font-size: 13px;
        }
        td:last-child {
            flex-direction: column;
        }
        .btn-lihat{
            width: 90px;
            height: 40px;
            font-size: 15px;
        }
        .btn-lihat img{
            width: 21px;
            height: 21px;
        }
    }
    @media screen and (max-width: 500px) {
        .table{
            margin-top: 7px;
        }
        .table>:not(caption)>*>*{
            padding: 5px 5px;
        }
        th h6{
            font-size: 12px;
        }
        th:nth-child(3){
            width: 27%;
        }
        td{
            font-size: 11px;
        }
        td:last-child {
            flex-direction: column;
        }
        .btn-lihat{
            width: 60px;
            height: 30px;
            font-size: 12px;
        }
        .btn-lihat img{
            width: 15px;
            height: 15px;
        }
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
    const domain = window.location.protocol + '//' + window.location.hostname + ":" + window.location.port;
    const reff = '/article';
    var csrfToken = "{{ csrf_token() }}";
    var email = "{{ $userAuth['email'] }}";
    var number = "{{ $userAuth['number'] }}";
    </script>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @php
            $nav = 'riwayat';
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
                    <h1>Kelola Riwayat</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item">Kelola Riwayat</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4"
                            style="box-shadow: rgba(145,158,171,0.2) 0px 0px 2px 0px, rgba(145,158,171,0.12) 0px 12px 24px -4px;">
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">No</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Judul</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Tanggal</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Aksi</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($dataRiwayat as $data)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">{{ $no++ }}</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <span class="fw-normal">{{ $data['judul'] }}
                                                </span>
                                            </td>
                                            <td class="border-bottom-0">
                                                <span class="fw-normal">{{ $data['created_at'] }}
                                                </span>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a href="/{{$constDB[$data['desc']]}}/edit/{{ $data['uuid'] }}" class="btn btn-warning btn-lihat m-1">
                                                    <img src="{{ asset($tPath.'img/icon/edit.svg') }}" alt="">
                                                    <span>Lihat</span>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @include('page.Components.admin.footer')
            </div>
        </div>
    </div>
    @php
    $modalDelete = 'artikel';
    @endphp
    @include('page.Components.preloader')
    <div id="greenPopup" style="display:none"></div>
    <div id="redPopup" style="display:none"></div>
    <script src="{{ asset($tPath.'assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset($tPath.'assets/js/app.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset($tPath.'assets/js/dashboard.js') }}"></script>
    <script src="{{ asset($tPath.'js/popup.js') }}"></script>
</body>

</html>