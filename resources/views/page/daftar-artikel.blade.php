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
    <script>
        var errCards = [];
        function imgError(errCard){
            errCards.push(errCard);
        }
    </script>
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
            <li class="card" id="card4">
                <a href="">
                    <img src="{{ asset($tPath.'img/artikel/hitler.jpg') }}" alt="" onerror="imgError('card4')">
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
            <li class="card" id="card5">
                <a href="">
                    <img src="{{ asset($tPath.'img/artikel/hitler2.jpg') }}" alt="" onerror="imgError('card5')">
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
            <li class="card" id="card6">
                <a href="">
                    <img src="{{ asset($tPath.'img/artikel/hitler3.png') }}" alt="" onerror="imgError('card6')">
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
            <li class="card" id="card7">
                <a href="">
                    <img src="{{ asset($tPath.'img/artikel/hitler.jpg') }}" alt="" onerror="imgError('card7')">
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
            <li class="card" id="card8">
                <a href="">
                    <img src="{{ asset($tPath.'img/artikel/hitler2.jpg') }}" alt="" onerror="imgError('card8')">
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
            <li class="card" id="card9">
                <a href="">
                    <img src="{{ asset($tPath.'img/artikel/hitler3.png') }}" alt="" onerror="imgError('card9')">
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
        document.body.addEventListener('dragstart', event => {
            event.preventDefault();
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