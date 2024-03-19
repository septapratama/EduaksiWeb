<?php
$tPath = app()->environment('local') ? '' : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $dataArtikel['judul'] }} | EduAksi</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset($tPath.'img/icon/icon.png') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/page/detail-artikel.css') }}" />
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <script>
    var errCards = [];

    function imgError(errCard) {
        errCards.push(errCard);
    }
    </script>
    @php
    $nav = 'detail';
    @endphp
    @include('page.Components.user.header')
    <main id="artikel">
        <a href="/artikel">
            <img src="{{ asset($tPath.'img/icon/arrow-left.svg') }}" alt="">
            <span>Kembali</span>
        </a>
        <div>
            <h1>{{ $dataArtikel['judul'] }}</h1>
            <span class="tanggal">{{ $dataArtikel['created_at'] }}</span>
            <img id="imgMain" src="{{ asset($tPath.'img/artikel/' . $dataArtikel['foto']) }}" alt=""
                onerror="imgError('imgMain')">
            <div class="main-loading"></div>
            <span>
                {!! $dataArtikel['deskripsi'] !!}
            </span>
            @if(isset($dataArtikel['link_video']) && !empty($dataArtikel['link_video']))
            <div id="video">
                <h3>Video Terkait</h3>
                <iframe src="{{ $dataArtikel['link_video'] }}" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
            @endif
        </div>
    </main>
    <section id="rekomendasi">
        <div>
            <h1>Rekomendasi Artikel</h1>
            <a href="/artikel">
                <span>Lainnya</span>
                <img src="{{ asset($tPath.'img/icon/arrow-right.svg') }}" alt="">
            </a>
        </div>
        <ul>
            @php $noArtikel = 1; @endphp
            @foreach($artikel as $data)
            <li class="card" id="{{ $noArtikel }}">
                <a href="/artikel/{{ str_replace(' ', '-', $data['judul']) }}">
                    <img src="{{ asset($tPath.'img/artikel/'.$data['foto']) }}" alt=""
                        onerror="imgError('{{ $noArtikel++ }}')">
                    <span class="tanggal">{{ $data['created_at'] }}</span>
                    <h3>{{ $data['judul'] }}</h3>
                    <p>Digital Literasi</p>
                </a>
                <div class="card-loading">
                    <div></div>
                    <span></span>
                    <h3></h3>
                    <p></p>
                </div>
            </li>
            @endforeach
        </ul>
    </section>
    @include('page.Components.user.footer')
    <script>
    const navItems = document.querySelectorAll('header li a');
    navItems.forEach(navItem => {
        navItem.addEventListener('click', function() {
            navItems.forEach(item => {
                item.classList.remove('active');
            });
            this.classList.add('active');
        })
    });
    document.body.addEventListener('dragstart', event => {
        event.preventDefault();
    });
    window.addEventListener('load', function() {
        //for main
        const main = document.querySelector('main div');
        var imgMain = main.querySelector('img');
        imgMain.addEventListener('load', function() {
            var mainLoading = main.querySelector('.main-loading');
            if (mainLoading) {
                mainLoading.remove();
            }
            imgMain.style.display = 'block';
        });
        var hasError = false;
        errCards.forEach(function(errCard) {
            if (errCard === imgMain.id) {
                hasError = true;
            }
        });
        if (!hasError && (imgMain.complete || imgMain.naturalWidth === 0)) {
            var mainLoading = main.querySelector('.main-loading');
            if (mainLoading) {
                mainLoading.remove();
            }
            imgMain.style.display = 'block';
        }
        //for cards
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