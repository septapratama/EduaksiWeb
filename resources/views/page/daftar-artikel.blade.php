<?php
$tPath = app()->environment('local') ? '' : '/public/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home | EduAksi</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset($tPath.'assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/page/daftar-artikel.css') }}" />
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    @php
        $nav = 'daftar-artikel';
    @endphp
    @include('page.Components.user.header')
    <section id="daftar-artikel">
        <div>
            <h1>Daftar Artikel</h1>
            <select class="" aria-label="Default select example" id="inpJenisKelamin">
                <option value="" selected>Pilih Kategori</option>
                <option value="disi">Digital Literasi</option>
                <option value="emotal">Emosi Mental</option>
                <option value="nutrisi">Nutrisi</option>
                <option value="pengasuhan">Pengasuhan</option>
            </select>
        </div>
        <ul>
            <li class="card">
                <img src="{{ asset($tPath.'img/artikel/hitler1.jpg') }}" alt="">
                <span class="tanggal">Minggu, 16 Juli 2023</span>
                <h3>Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator</h3>
                <p>Digital Literasi</p>
            </li>
            <li class="card">
                <img src="{{ asset($tPath.'img/artikel/hitler2.jpg') }}" alt="">
                <span class="tanggal">Minggu, 16 Juli 2023</span>
                <h3>Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator</h3>
                <p>Digital Literasi</p>
            </li>
            <li class="card">
                <img src="{{ asset($tPath.'img/artikel/hitler3.png') }}" alt="">
                <span class="tanggal">Minggu, 16 Juli 2023</span>
                <h3>Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator</h3>
                <p>Digital Literasi</p>
            </li>
            <li class="card">
                <img src="{{ asset($tPath.'img/artikel/hitler1.jpg') }}" alt="">
                <span class="tanggal">Minggu, 16 Juli 2023</span>
                <h3>Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator</h3>
                <p>Digital Literasi</p>
            </li>
            <li class="card">
                <img src="{{ asset($tPath.'img/artikel/hitler2.jpg') }}" alt="">
                <span class="tanggal">Minggu, 16 Juli 2023</span>
                <h3>Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator</h3>
                <p>Digital Literasi</p>
            </li>
            <li class="card">
                <img src="{{ asset($tPath.'img/artikel/hitler3.png') }}" alt="">
                <span class="tanggal">Minggu, 16 Juli 2023</span>
                <h3>Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator</h3>
                <p>Digital Literasi</p>
            </li>
            <li class="card">
                <img src="{{ asset($tPath.'img/artikel/hitler1.jpg') }}" alt="">
                <span class="tanggal">Minggu, 16 Juli 2023</span>
                <h3>Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator</h3>
                <p>Digital Literasi</p>
            </li>
            <li class="card">
                <img src="{{ asset($tPath.'img/artikel/hitler2.jpg') }}" alt="">
                <span class="tanggal">Minggu, 16 Juli 2023</span>
                <h3>Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator</h3>
                <p>Digital Literasi</p>
            </li>
            <li class="card">
                <img src="{{ asset($tPath.'img/artikel/hitler3.png') }}" alt="">
                <span class="tanggal">Minggu, 16 Juli 2023</span>
                <h3>Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator</h3>
                <p>Digital Literasi</p>
            </li>
        </ul>
    </section>
    @include('page.Components.user.footer')
    <script>
        const navItems = document.querySelectorAll('header li a');
        navItems.forEach(navItem => {
            navItem.addEventListener('click',function(){
                navItems.forEach(item => {
                    item.classList.remove('active');
                });
                this.classList.add('active');
            })
        });
    </script>
</body>
</html>