<?php
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]";
$tPath = app()->environment('local') ? '' : '/public/';
// echo asset($tPath.'asse');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>testing</title>
    <link rel="stylesheet" href="{{ asset('css/page/testing.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
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
    <div id="greenPopup">
        <div class="bg"></div>
        <div class="kotak">
            <div class="bunder1"></div>
            <div class="icon"><img src="{{ asset($tPath.'assets/img/check.png') }}" alt=""></div>
        </div>
        <span class="closePopup">X</span>
        <label>Login berhasil</label>
    </div>
    {{-- <div id="redPopup">
        <div class="bg"></div>
        <div class="kotak">
            <div class="bunder1"></div>
            <span>!</span>
        </div>
        <span class="closePopup">X</span>
        <label>Password konfirmasi minimal ada 1 karakter unik !</label>
    </div> --}}
    {{-- <div id="popup">
        <div class="bg"></div>
        <div class="content">
            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos architecto voluptates quam quisquam totam, ad itaque aspernatur perferendis odio deleniti numquam dolores eligendi quos recusandae ullam similique harum cum animi.</p>
            <button class="single" onclick="dashboardPage()">Login</button>
            <button class="cancel"> cancel </button>
            <button class="success"> submit </button>
        </div>
    </div> --}}
    {{-- <div class="editPopup" style="display: none;" id="edit1">
        <div class="bg">
        </div>  
        <div class="content">
            <div class="header">
                <h5>Tambah Artikel </h5>
            </div>
            <form action="" id="tambahArtikel">
                <div class="row">
                    <label>Judul Artikel</label>
                    <input type="text" id="judul">
                </div>
                <div class="row">
                    <label>isi Artikel</label>
                    <textarea type="text" id="isi_artikel"></textarea>
                </div>
                <div class="row">
                    <div id="drag-area-tambah">
                        <header>Drop File</header>
                        <input type="file" id="inpFile" hidden>
                    </div>
                </div>
                <div class="button">
                    <button type="submit">Update</button>
                    <button type="button" onclick="closeEdit('div#edit1')">Batal</button>
                </div>
            </form>
        </div>
    </div> --}}
    {{-- <div class="tambahDevice" style="display: block;" id="tambah">
        <div class="bg">
        </div>
        <div class="content">
            <div class="header">
                <h5>Tambah Device</h5>
            </div>
            <form action="" id="tambahDevice">
                <div class="row">
                    <label>Nama Device</label>
                    <input type="text" id="inpNama">
                </div>
                <div class="row">
                    <label>token</label>
                    <input type="text" id="inpToken" disable>
                    <button onclick="generateToken()" id="token">Generate Token</button>
                </div>
                <div class="row">
                    <label>GPS</label>
                    <input type="text" id="inpGps">
                </div>
                <div class="button">
                    <button type="submit">Tambah</button>
                    <button type="button" onclick="closeEdit('div#tambah')">Batal</button>
                </div>
            </form>
        </div>
    </div> --}}
    {{-- <div class="loading">
        <div class="bg"></div>
            <div class="content">
                <span>loading...</span>
                <div class="ring"></div>
            </div>
        </div>
    </div> --}}
    {{-- <div id="otp" style="display:block;">
        <div class="bg"></div>
        <form action="#">
            <h3>Lupa Password</h3>
            <p>Pakai fitur ini apabila anda lupa dengan kata sandi</p>
            <p>Verifikasi OTP</p>
            <div class="input">
                <input type="text" id="otp1">
                <input type="text" id="otp2">
                <input type="text" id="otp3">   
                <input type="text" id="otp4">
                <input type="text" id="otp5">
                <input type="text" id="otp6">
            </div>
            <input type="submit" value="Konfirmasi">
            <span>Tidak Menerima Kode OTP ? <a>kirim ulang</a></span>
        </form>
    </div> --}}
    {{-- <div id="preloader" ></div> --}}
    <button onclick="showEdit('div#tambah')">show edit</button>
    <script src="{{ asset('js/page/testing.js') }}"></script>
</body>

</html>
