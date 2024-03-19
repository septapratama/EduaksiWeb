<?php
$tPath = app()->environment('local') ? '' : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Disi | EduAksi</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset($tPath.'img/icon/icon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset($tPath.'assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/popup.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/testing.css') }}" />
    <style>
        div{
            position: fixed;
            left:0px;
            top:0px;
            width:100%;
            height:100%;
        }
        div div:nth-child(1){
            background-color: rgba(255, 255, 255, 0.6);
        }
        .lds-ring {
            display: inline-block;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
        }
        .lds-ring div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 64px;
            height: 64px;
            margin: 8px;
            border: 8px solid black;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: black transparent transparent transparent;
        }
        .lds-ring div:nth-child(1) {
            animation-delay: -0.45s;
            }
            .lds-ring div:nth-child(2) {
            animation-delay: -0.3s;
        }
        .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
        }
        @keyframes lds-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <script>
    var errCards = [];
    function imgError(errCard) {
        errCards.push(errCard);
    }
    </script>
    <div>
        <div id="bg"></div>
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
        <div>
    </div>
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
    {{-- <script src="../js/testing.js"></script> --}}
</body>

</html>