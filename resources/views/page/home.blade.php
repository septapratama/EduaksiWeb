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
    <link rel="stylesheet" href="{{ asset($tPath.'css/page/home.css') }}" />
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    @include('page.Components.user.header')
    {{-- <section id="beranda">
        <div>
            <h1>EduAksi</h1>
            <span>EduAksi adalah aplikasi yang menyediakan panduan dan dukungan untuk orang tua dalam mendidik anak-anak dengan baik. Mulai dari keamanan online hingga kesehatan, dari emosi hingga pertumbuhan anak, kami hadir untuk membantu. Nikmati fitur kalender anak, kalkulator gizi, dan konsultasi dengan profesional. EduAksi - Solusi Praktis untuk Orang Tua yang Pintar dan Peduli!</span>
            <button type="button">
                <img src="{{ asset($tPath.'img/icon/download.svg') }}" alt="">
                <span>Unduh Aplikasi</span>
            </button>
        </div>
        <img src="{{ asset($tPath.'img/app.png') }}" alt="">
    </section> --}}
    <section id="artikel">
        <div>
            <h1>Artikel Terbaru</h1>
            <a href="/daftar-artikel">
                <span>Lainnya</span>
                <img src="{{ asset($tPath.'img/icon/arrow-right.svg') }}" alt="">
            </a>
        </div>
        <ul>
            <li class="card">
                <img src="{{ asset($tPath.'img/artikel/hitler1.jpg') }}" alt="">
                <span class="tanggal">Minggu, 16 Juli 2023</span>
                <h3>Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator</h3>
                <span>Digital Literasi</span>
            </li>
            <li class="card">
                <img src="{{ asset($tPath.'img/artikel/hitler2.jpg') }}" alt="">
                <span class="tanggal">Minggu, 16 Juli 2023</span>
                <h3>Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator</h3>
                <span>Digital Literasi</span>
            </li>
            <li class="card">
                <img src="{{ asset($tPath.'img/artikel/hitler3.png') }}" alt="">
                <span class="tanggal">Minggu, 16 Juli 2023</span>
                <h3>Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator</h3>
                <span>Digital Literasi</span>
            </li>
        </ul>
    </section>
    @include('page.Components.user.footer')
</body>
</html>