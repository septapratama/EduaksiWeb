<?php
$tPath = app()->environment('local') ? '' : '/public/';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Admin | EduAksi</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset($tPath.'assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset($tPath.'assets/css/styles.min.css') }}" />
    <style>
        th{
            white-space: nowrap;
        }
        th:nth-child(2) {
            width: 100%;
        }
        td:last-child{
            position: relative;
            display: flex;
            flex-direction: row;
        }
        td:last-child a, td:last-child button{
            display: flex;
            align-items: center;
            gap: 7px;
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
    var tPath = '/public/';
    </script>
    @endif
    <script>
        const domain = window.location.protocol + '//' + window.location.hostname + ":" + window.location.port;
        const reff = '/admin';
        var csrfToken = "{{ csrf_token() }}";
        var email = "{{ $userAuth['email'] }}";
        var number = "{{ $userAuth['number'] }}";
    </script>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @php
        $nav = 'admin';
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
                    <h1>Kelola Admin</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item">Kelola Admin</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <a href="/admin/tambah" class="btn btn-success"><img
                                    src="{{ asset($tPath.'img/icon/tambah.svg') }}" alt="" width="30" height="30">Tambah
                                Admin</a>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">No</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Nama Lengkap</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">No Telpon</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Email</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Aksi</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($adminData as $data)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">{{ $no++ }}</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <span class="fw-normal">{{ $data['nama_lengkap'] }}
                                                </span>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $data['no_telpon']}}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $data['email']}}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a href="/admin/edit/{{ $data['uuid'] }}" class="btn btn-warning m-1"><img src="{{ asset($tPath.'img/icon/edit.svg') }}" alt=""><span>Edit</span></a>
                                                <button type="button" class="btn btn-danger m-1"><img src="{{ asset($tPath.'img/icon/delete.svg') }}" alt=""><span>Hapus</span></button>
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
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>