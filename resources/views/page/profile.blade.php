@php
$tPath = app()->environment('local') ? '' : '/public/';
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Profile | EduAksi</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="icon" type="image/png" href="{{ asset($tPath.'assets/images/logos/favicon.png') }}" />

    <!-- Google Fonts -->
    <!-- <link href="https://fonts.gstatic.com" rel="preconnect"> -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset($tPath.'assets1/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset($tPath.'assets1/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="{{ asset($tPath.'assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'assets1/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset($tPath.'css/popup.css') }}" rel="stylesheet">
    <style>
    div.drag#divImg {
        border: 4px solid black;
    }

    #divImg {
        position: relative;
        left: 0;
        max-width: 300px;
        width: 100%;
        max-height: 200px;
        height: 200px;
        cursor: pointer;
    }

    #divText {
        position: relative;
        left: 50%;
        top: 50%;
        translate: -50% -50%;
        font-size: 22px;
        text-align: center;
        display: flex;
        flex-direction: column;
    }

    #divText i {
        font-size: 65px;
    }

    #inpImg {
        display: block;
        margin: auto;
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
    }

    @media (max-width: 480px) {}

    @media (min-width: 481px) and (max-width: 767px) {}

    @media (min-width: 768px) {}
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
    var csrfToken = "{{ csrf_token() }}";
    var email = "{{ $userAuth['email'] }}";
    var number = "{{ $userAuth['number'] }}";
    var users = {!! json_encode($userAuth) !!};
    </script>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
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
                    <h1>Profile</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Profile</li>
                        </ol>
                    </nav>
                </div>
                <section class="section profile">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered">
                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#profile-overview">Profil</button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#profile-edit">Edit Profil</button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#profile-change-password">Ubah Password</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-2">
                                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                            <div
                                                class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                                <img src="{{ route('download.foto') }}" alt="Profile">
                                                <h2>
                                                    <center>
                                                        {{ $userAuth['nama_lengkap'] }}
                                                    </center>
                                                </h2>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Nama Lengkap</div>
                                                <div class="col-lg-9 col-md-8"> {{ $userAuth['nama_lengkap'] }} </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Nomor Telepon</div>
                                                <div class="col-lg-9 col-md-8">
                                                    {{ $userAuth['no_telpon'] }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                                <div class="col-lg-9 col-md-8"> {{ $userAuth['jenis_kelamin'] }} </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Email</div>
                                                <div class="col-lg-9 col-md-8"> {{ $userAuth['email'] }} </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                            <form onsubmit="uploadEdit(event)">
                                                <!-- Profile Edit Form -->
                                                <div class="row mb-3">
                                                    <label for="profileImage"
                                                        class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <div id="divImg" ondrop="dropHandler(event)"
                                                            ondragover="dragHandler(event,'over')"
                                                            ondragleave="dragHandler(event,'leave')">
                                                            <input class="form-control" type="file" multiple="false"
                                                                id="inpFile" name="foto" style="display:none">
                                                            <img src="{{ route('download.foto') }}" alt="Profile"
                                                                id="inpImg" class="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="Nama Lengkap"
                                                        class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="nama" type="text" class="form-control"
                                                            id="Nama Lengkap" value="{{ $userAuth['nama_lengkap'] }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="Nomor Telepon"
                                                        class="col-md-4 col-lg-3 col-form-label">Nomor Telepon</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="phone" type="text" class="form-control" id="phone"
                                                            value="{{ $userAuth['no_telpon'] }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-form-label col-md-4 col-lg-3">Jenis
                                                        Kelamin</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="jenisK"
                                                                value="laki-laki"
                                                                {{ ($userAuth['jenis_kelamin'] == 'laki-laki') ? 'checked' : '' }}>
                                                            Laki-Laki
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="jenisK"
                                                                value="perempuan"
                                                                {{ ($userAuth['jenis_kelamin'] == 'perempuan') ? 'checked' : '' }}>
                                                            Perempuan
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="Email"
                                                        class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="email" type="email" class="form-control" id="Email"
                                                            value="{{ $userAuth['email'] }}">
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                </div>
                                            </form><!-- End Profile Edit Form -->
                                        </div>
                                        <div class="tab-pane fade pt-3" id="profile-change-password">
                                            <!-- Change Password Form -->
                                            <form onsubmit="updatePassword(event)">
                                                <div class="row mb-3">
                                                    <label for="currentPassword"
                                                        class="col-md-4 col-lg-3 col-form-label">Password Lama</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="password_old" type="password" class="form-control"
                                                            id="currentPassword">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="newPassword"
                                                        class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="password" type="password" class="form-control"
                                                            id="newPassword">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="renewPassword"
                                                        class="col-md-4 col-lg-3 col-form-label">Masukkan Kembali
                                                        Password Baru</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="password_new" type="password" class="form-control"
                                                            id="renewPassword">
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary" name="changePass">Ubah
                                                        Password</button>
                                                </div>
                                            </form><!-- End Change Password Form -->
                                        </div>
                                    </div><!-- End Bordered Tabs -->
                                </div>
                            </div>
                        </div>
                </section>
                @include('page.Components.admin.footer')
            </div>
        </div>
    </div>
    <div id="preloader" style="display: none;"></div>
    <div id="greenPopup" style="display:none"></div>
    <div id="redPopup" style="display:none"></div>
    <!-- Vendor JS Files -->
    <script src="{{ asset($tPath.'assets1/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets1/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets1/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset($tPath.'/js/popup.js') }}"></script>
    <script>
    const maxSizeInBytes = 4 * 1024 * 1024; //max file 4MB
    var divImg = document.getElementById('divImg');
    var inpFile = document.getElementById('inpFile');
    var imgText = document.getElementById('imgText');
    var fileImg = '';
    var uploadStat = false;
    divImg.addEventListener("click", function() {
        inpFile.click();
    });

    function showLoading() {
        document.querySelector('div#preloader').style.display = 'block';
    }

    function closeLoading() {
        document.querySelector('div#preloader').style.display = 'none';
    }

    function uploadEdit(event) {
        event.preventDefault();
        var inpNama = document.querySelector("input[name='nama']").value;
        var inpTLP = document.querySelector("input[name='phone']").value;
        var inpJenis = document.querySelector("input[name='jenisK']:checked").value;
        var inpEmail = document.querySelector("input[name='email']").value;
        //check data if edit or not
        if (inpNama === users.nama_lengkap && inpTLP === users.no_telpon &&
            inpJenis === users.jenis_kelamin && inpEmail === users.email) {
            showRedPopup('Data belum diubah');
            return;
        }
        uploadStat = true;
        showLoading();
        const formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('email', email);
        formData.append('email_new', document.querySelector('input[name="email"]').value);
        formData.append('nama_lengkap', document.querySelector('input[name="nama"]').value);
        formData.append('jenis_kelamin', document.querySelector('input[name="jenisK"]:checked').value);
        formData.append('no_telpon', document.querySelector('input[name="phone"]').value);
        if (fileImg !== null && fileImg !== '') {
            formData.append('foto', fileImg, fileImg.name);
        }
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/admin/update/profile', true);
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.onload = function() {
            if (xhr.status === 200) {
                closeLoading();
                uploadStat = false;
                showGreenPopup(JSON.parse(xhr.responseText));
                setTimeout(() => {
                    window.location.href = '/profile';
                }, 1000);
                return;
            } else {
                closeLoading();
                uploadStat = false;
                showRedPopup(JSON.parse(xhr.responseText));
                return;
            }
        };
        xhr.onerror = function() {
            uploadStat = false;
            showRedPopup('Request gagal');
            return;
        };
        xhr.send(formData);
    }
    inpFile.addEventListener('change', function(e) {
        if (e.target.files.length === 1) {
            const file = e.target.files[0];
            if (file.type.startsWith('image/')) {
                if (file.size <= maxSizeInBytes) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        document.getElementById('inpImg').src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                    fileImg = file;
                    //delete inside box
                    divImg.style.borderStyle = "none";
                    divImg.style.borderWidth = "0px";
                    divImg.style.borderColor = "transparent";
                } else {
                    showRedPopup('Ukuran maksimal gambar 4MB !');
                }
            } else {
                showRedPopup('File harus Gambar !');
            }
        }
    });

    function dropHandler(event) {
        event.preventDefault();
        if (event.dataTransfer.items) {
            const file = event.dataTransfer.items[0].getAsFile();
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('inpImg').src = event.target.result;
                };
                reader.readAsDataURL(file);
                fileImg = file;
                //delete inside box
                divImg.style.borderStyle = "none";
                divImg.style.borderWidth = "0px";
                divImg.style.borderColor = "transparent";
            } else {
                showRedPopup('File harus Gambar !');
            }
        }
    }

    function dragHandler(event, con) {
        event.preventDefault();
        if (con == 'over') {
            imgText.innerText = 'Jatuhkan file';
            divImg.classList.add('drag');
        } else if (con == 'leave') {
            imgText.innerText = 'Pilih atau jatuhkan file Foto';
            divImg.classList.remove('drag');
        }
    }

    function updatePassword(event, ket) {
        event.preventDefault();
        showLoading();
        var xhr = new XMLHttpRequest();
        var requestBody = {
            email: email,
            password_old: event.target.querySelector('[name="password_old"]').value,
            password: event.target.querySelector('[name="password"]').value,
            password_confirm: event.target.querySelector('[name="password_new"]').value
        };
        xhr.open('PUT', domain + "/admin/update/password")
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(JSON.stringify(requestBody));
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    closeLoading();
                    var response = JSON.parse(xhr.responseText);
                    showGreenPopup(response);
                    setTimeout(() => {
                        window.location.href = '/profile';
                    }, 1000);
                } else {
                    closeLoading();
                    var response = JSON.parse(xhr.responseText);
                    showRedPopup(response);
                }
            }
        }
    }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentPageURL = window.location.href;
        var menuLinks = document.querySelectorAll('.nav-link');
        menuLinks.forEach(function(menuLink) {
            var menuLinkURL = menuLink.getAttribute('href');
            if (currentPageURL === menuLinkURL) {
                menuLink.parentElement.classList.add('active');
            }
        });
    });
    </script>
    <script src="{{ asset($tPath.'assets1/js/admin/main.js') }}"></script>
</body>

</html>