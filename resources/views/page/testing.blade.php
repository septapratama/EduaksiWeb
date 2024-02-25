<?php
$tPath = app()->environment('local') ? '' : '/public/';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Disi | EduAksi</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset($tPath.'assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset($tPath.'assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/popup.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/testing.css') }}" />
</head>

<body>
    <script>
        var errCards = [];
        function imgError(errCard){
            errCards.push(errCard);
        }
    </script>
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
        </ul>
    </section>
    <script>
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
                errCards.find(function(errCard){
                    if(errCard === card.id){
                        console.log('Image failed to load:', image.src);
                    }else{
                        if (image.complete || image.naturalWidth === 0) {
                            var cardLoading = card.querySelector('.card-loading');
                            if (cardLoading) {
                                cardLoading.remove();
                            }
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>