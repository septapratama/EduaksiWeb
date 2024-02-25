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
    <script>
        var errCards = [];
        function imgError(errCard){
            errCards.push(errCard);
        }
    </script>
    @php
        $nav = 'home';
    @endphp
    @include('page.Components.user.header')
    <main id="beranda">
        <div>
            <h1>EduAksi</h1>
            <span>EduAksi adalah aplikasi yang menyediakan panduan dan dukungan untuk orang tua dalam mendidik anak-anak dengan baik. Mulai dari keamanan online hingga kesehatan, dari emosi hingga pertumbuhan anak, kami hadir untuk membantu. Nikmati fitur kalender anak, kalkulator gizi, dan konsultasi dengan profesional. EduAksi - Solusi Praktis untuk Orang Tua yang Pintar dan Peduli!</span>
            <button type="button">
                <img src="{{ asset($tPath.'img/icon/download.svg') }}" alt="">
                <span>Unduh Aplikasi</span>
            </button>
        </div>
        <img src="{{ asset($tPath.'img/app.png') }}" alt="">
    </main>
    <section id="artikel">
        <div>
            <h1>Artikel Terbaru</h1>
            <a href="/blog">
                <span>Lainnya</span>
                <img src="{{ asset($tPath.'img/icon/arrow-right.svg') }}" alt="">
            </a>
        </div>
        <ul>
            <li class="card" id="card1">
                <a href="/blog/detail">
                    <img src="{{ asset($tPath.'img/artikel/hitler.jpg') }}" alt="" onerror="imgError('card1')">
                    <span class="tanggal">Minggu, 16 Juli 2023</span>
                    <h3>Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator</h3>
                    <p>Digital Literasi</p>
                </a>
                <div class="card-loading">
                    <div></div>
                    <span></span>
                    <h3></h3>
                    <p></p>
                </div>
            </li>
            <li class="card" id="card2">
                <a href="/blog/detail">
                    <img src="{{ asset($tPath.'img/artikel/hitler2.jpg') }}" alt="" onerror="imgError('card2')">
                    <span class="tanggal">Minggu, 16 Juli 2023</span>
                    <h3>Luka Perang Dunia II: Menjelajahi Warisan Rezim Nazi di Eropa</h3>
                    <p>Digital Literasi</p>
                </a>
                <div class="card-loading">
                    <div></div>
                    <span></span>
                    <h3></h3>
                    <p></p>
                </div>
            </li>
            <li class="card" id="card3">
                <a href="/blog/detail">
                    <img src="{{ asset($tPath.'img/artikel/hitler3.png') }}" alt="" onerror="imgError('card3')">
                    <span class="tanggal">Minggu, 16 Juli 2023</span>
                    <h3>Melampaui Medan Perang: Dampak Sosial dan Budaya Era Nazi</h3>
                    <p>Digital Literasi</p>
                </a>
                <div class="card-loading">
                    <div></div>
                    <span></span>
                    <h3></h3>
                    <p></p>
                </div>
            </li>
        </ul>
    </section>
    <section id="kategori">
        <div>
            <h1>Kategori</h1>
            <a href="/blog">
                <span>Lainnya</span>
                <img src="{{ asset($tPath.'img/icon/arrow-right.svg') }}" alt="">
            </a>
        </div>
        <ul>
            <li class="card" id="card1">
                <a href="/blog/detail">
                    <img src="{{ asset($tPath.'img/artikel/hitler.jpg') }}" alt="" onerror="imgError('card1')">
                    <span class="tanggal">Minggu, 16 Juli 2023</span>
                    <h3>Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator</h3>
                    <p>Digital Literasi</p>
                </a>
                <div class="card-loading">
                    <div></div>
                    <span></span>
                    <h3></h3>
                    <p></p>
                </div>
            </li>
            <li class="card" id="card2">
                <a href="/blog/detail">
                    <img src="{{ asset($tPath.'img/artikel/hitler2.jpg') }}" alt="" onerror="imgError('card2')">
                    <span class="tanggal">Minggu, 16 Juli 2023</span>
                    <h3>Luka Perang Dunia II: Menjelajahi Warisan Rezim Nazi di Eropa</h3>
                    <p>Digital Literasi</p>
                </a>
                <div class="card-loading">
                    <div></div>
                    <span></span>
                    <h3></h3>
                    <p></p>
                </div>
            </li>
            <li class="card" id="card3">
                <a href="/blog/detail">
                    <img src="{{ asset($tPath.'img/artikel/hitler3.png') }}" alt="" onerror="imgError('card3')">
                    <span class="tanggal">Minggu, 16 Juli 2023</span>
                    <h3>Melampaui Medan Perang: Dampak Sosial dan Budaya Era Nazi</h3>
                    <p>Digital Literasi</p>
                </a>
                <div class="card-loading">
                    <div></div>
                    <span></span>
                    <h3></h3>
                    <p></p>
                </div>
            </li>
        </ul>
    </section>
    @include('page.Components.user.footer')
    <script>
        const navItems = document.querySelectorAll('header a a');
        document.body.addEventListener('dragstart', event => {
            event.preventDefault();
        });
        navItems.forEach(navItem => {
            navItem.addEventListener('click',function(){
                navItems.forEach(item => {
                    item.classList.remove('active');
                });
                this.classList.add('active');
            })
        });
        window.addEventListener('load', function() {
            var cards = document.querySelectorAll('.card');
            cards.forEach(function(card) {
                var image = card.querySelector('img');
                image.addEventListener('load', function() {
                    var cardLoading = card.querySelector('.card-loading');
                    if (cardLoading) {
                        cardLoading.remove();
                    }
                });
                var hasError = false;
                errCards.forEach(function(errCard) {
                    if (errCard === card.id) {
                        hasError = true;
                    }
                });
                if (!hasError && (image.complete || image.naturalWidth === 0)) {
                    var cardLoading = card.querySelector('.card-loading');
                    if (cardLoading) {
                        cardLoading.remove();
                    }
                }
            });
        });
    </script>
</body>
</html>