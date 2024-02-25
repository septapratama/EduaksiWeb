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
    <link rel="stylesheet" href="{{ asset($tPath.'css/page/detail-artikel.css') }}" />
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
        $nav = 'detail';
    @endphp
    @include('page.Components.user.header')
    <main id="artikel">
        <a href="/artikel">
            <img src="{{ asset($tPath.'img/icon/arrow-left.svg') }}" alt="">
            <span>Kembali</span>
        </a>
        <div>
            <h1>Melampaui Medan Perang: Dampak Sosial dan Budaya Era Nazi</h1>
            <span class="tanggal">Minggu, 16 Juli 2023</span>
            <img id="imgMain" src="{{ asset($tPath.'img/artikel/hitler3.png') }}" alt="" onerror="imgError('imgMain')">
            <div class="main-loading"></div>
            <span>
                <p>
                    Era Nazi di Jerman tidak hanya menandai periode perang dan kehancuran fisik, tetapi juga menyebabkan dampak yang mendalam pada masyarakat dan budaya. Meskipun kebijakan politik dan militer menjadi sorotan utama dalam sejarah Nazi, penting untuk diakui bahwa dampaknya juga merasuk ke dalam struktur sosial dan budaya yang lebih luas. Dalam artikel ini, kita akan mengeksplorasi beberapa aspek dari dampak sosial dan budaya dari masa kekuasaan Nazi.
                </p>
                <p>
                    1. Manipulasi Ideologi dan Propaganda Salah satu ciri khas rezim Nazi adalah penggunaan propaganda yang luas untuk memanipulasi pemikiran masyarakat. Melalui kontrol yang ketat atas media dan institusi pendidikan, rezim Nazi berhasil menanamkan ideologi rasial dan kebangsaan yang merusak dalam pikiran banyak orang Jerman. Konsep superioritas ras Arya dan demonisasi terhadap kelompok-kelompok yang dianggap tidak sesuai, seperti Yahudi, Romani, dan homoseksual, menjadi terintegrasi ke dalam budaya sehari-hari. Propaganda tersebut menciptakan polarisasi sosial yang mendalam dan memecah belah masyarakat.
                </p>
                <p>
                    2. Penganiayaan Terhadap Minoritas Dampak sosial paling mengerikan dari era Nazi adalah penganiayaan yang sistematis terhadap minoritas, terutama Yahudi. Undang-undang rasial Nuremberg dan program eugenik seperti program eutanasia mengekang kebebasan individu dan menghilangkan hak-hak mereka secara bertahap. Pembersihan etnis dan genosida yang terjadi di kamp-kamp konsentrasi menjadi contoh paling ekstrim dari bagaimana pemerintahan Nazi secara langsung menghancurkan kelompok-kelompok minoritas.
                </p>
                <p>
                    3. Perubahan dalam Struktur Keluarga dan Masyarakat Pemerintahan Nazi juga memiliki dampak yang signifikan pada struktur keluarga dan masyarakat. Program-program eugenik mendorong kebijakan-kebijakan sterilisasi dan pernikahan yang didasarkan pada kriteria rasial tertentu. Selain itu, penindasan politik dan keberadaan konstanta dalam ketakutan menyebabkan banyak keluarga hidup dalam ketidakstabilan dan kecemasan yang konstan. Hal ini memicu perubahan dramatis dalam pola-pola keluarga dan interaksi sosial.
                </p>
                <p>
                    4. Warisan Trauma dan Refleksi Pasca-Perang Meskipun kejatuhan rezim Nazi menandai akhir dari era kegelapan ini, dampaknya terus dirasakan jauh setelah perang berakhir. Generasi yang selamat dari Holocaust, bersama dengan keturunan mereka, mewarisi trauma psikologis yang mendalam. Selain itu, refleksi tentang masa lalu Nazi menjadi bagian integral dari budaya Jerman pasca-perang. Inisiatif pendidikan dan memorial bertujuan untuk memperingatkan generasi mendatang tentang bahaya intoleransi dan memastikan bahwa kengerian masa lalu tidak terlupakan.
                </p>
                <p>
                    Melalui pemahaman yang lebih dalam tentang dampak sosial dan budaya era Nazi, kita dapat memahami betapa pentingnya mempertahankan nilai-nilai kemanusiaan, toleransi, dan kedamaian dalam masyarakat kita saat ini. Sejarah Nazi harus dijadikan pengingat yang kuat tentang bahaya ideologi ekstrem dan kekuatan solidaritas dan empati dalam membangun masa depan yang lebih baik.
                </p>
            </span>
            <div id="video">
                <h3>Video Terkait</h3>
                <iframe  src="https://www.youtube.com/embed/llEXqB4YyiE?si=bnzlQTcFZVypMdGH" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="border-radius: 15px;"></iframe>
            </div>
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
            <li class="card" id="card1">
                <a href="">
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
                <a href="">
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
                <a href="">
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
        const navItems = document.querySelectorAll('header li a');
        navItems.forEach(navItem => {
            navItem.addEventListener('click',function(){
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