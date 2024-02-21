<?php
$tPath = app()->environment('local') ? '' : '/public/';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Disi | EduAksi</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset($tPath.'assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset($tPath.'assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/popup.css') }}" />
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
        const reff = '/disi';
        var csrfToken = "{{ csrf_token() }}";
        var email = "{{ $userAuth['email'] }}";
        var number = "{{ $userAuth['number'] }}";
    </script>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @php
        $nav = 'disi';
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
                    <h1>Edit Digital Literasi</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="/disi">Kelola Disi</a></li>
                            <li class="breadcrumb-item">Edit Digital Literasi</li>
                        </ol>
                    </nav>
                </div>
                <div class=" d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <form id="editForm">
                                <div class="mb-3">
                                    <label for="" class="form-label">Judul Digital Literasi</label>
                                    <input type="text" class="form-control" id="inpJudul" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <div>
                                        <label for="" class="form-label">Rentang Usia</label>
                                        <select class="form-select" aria-label="Default select example" id="inpRentangUsia" disabled>
                                            <option value="0-3 Tahun" selected="selected">0-3 Tahun</option>
                                            <option value="4-6 Tahun" selected="selected">4-6 Tahun</option>
                                            <option value="7-9 Tahun" selected="selected">7-9 Tahun</option>
                                            <option value="10-12 Tahun" selected="selected">10-12 Tahun</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="" class="form-label">Link Video</label>
                                        <input type="text" class="form-control" id="inpLinkVideo">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" id="inpDeskripsi" placeholder="Masukkan Isi Digital Literasi" class="form-control" style="height:120px"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Foto</label>
                                    <input type="file" class="form-control" id="inpFoto" aria-describedby="emailHelp" accept="image/*">
                                </div>
                                <div class="mb-3 form-check">
                                    <a href="/disi" class="btn btn-danger">Kembali</a>
                                    <button type="submit" class="btn btn-success"><img src="{{ asset($tPath.'img/icon/tambah.svg') }}" alt="" width="30" height="30">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
    <script src="{{ asset($tPath.'js/page/editData.js') }}"></script>
    <script src="{{ asset($tPath.'js/popup.js') }}"></script>
</body>

</html>