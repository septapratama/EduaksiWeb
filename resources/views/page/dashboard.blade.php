<?php
$tPath = app()->environment('local') ? '' : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | EduAksi</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset($tPath.'img/icon/icon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset($tPath.'assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset($tPath.'css/preloader.css') }}" />
    <!-- CSS for full calender -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <style>
    body img{
        pointer-events: none;
    }
    a:hover{
        text-decoration: none;
    }
    #kotak {
        display: flex;
        flex-direction: column;
        margin-bottom:6%;
        gap: 30px;
    }
    #kotak #carousel{
        /* overflow-x: hidden; */
        overflow-x: auto;
        display: flex;
        gap: 10px;
        -ms-overflow-style: none;
        scrollbar-width: none; 
    }
    #kotak #carousel::-webkit-scrollbar {
        display: none;
    }
    .cardC {
        flex-shrink: 0;
        width: 180px;
        height: 120px;
        /* width: 46.2%; */
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin-bottom: 0px;
        background-color: green;
        border-radius: 20px;
    }
    .cardC h5,
    .cardC div {
        color:white;
        position: relative;
        display: flex;
        font-weight: 600;
    }
    .cardC h5 {
        font-size: 24px;
        width:max-content;
        height:max-content;
        margin-left: auto;
        margin-right: auto;
    }
    .cardC div {
        margin-left: auto;
        margin-right: auto;
        display: flex;
        align-items: center;
        font-size: 30px;
        gap:30px;
    }
    .cardC:nth-child(3) h5{
        font-size: 24px;
    }
    .cardC:nth-child(4) h5{
        font-size: 19px;
    }
    .cardC:nth-child(5) h5{
        font-size: 19px;
    }
    .cardC img{
        width: 60px;
        height: 60px;
    }
    .cardC span{
        font-size: 30px;
    }
    @media screen and (min-width: 700px) and (max-width: 1100px) {
        #kotak {
            height: 53vh;
        }
        .cardC {
            width: 47%;
            height: 100px;
            margin-bottom: 0px;
        }
        /* .cardC h5 {
            font-size: 21px;
            font-weight: 600;
        } */
        .cardC div {
            gap: 4%;
            font-size: 21px;
        }
        .cardC img{
            width: 37px;
            height: 37px;
        }
    }
    @media screen and (min-width: 500px) and (max-width: 700px) {
        #kotak {
            height: 56vh;
        }
        .cardC {
            width: 47%;
            height: 100px;
            margin-bottom: 0px;
        }
        /* .cardC h5 {
            font-size: 19px;
            font-weight: 600;
        } */
        .cardC div {
            gap: 5%;
            font-size: 19px;
        }
        .cardC img{
            width: 35px;
            height: 35px;
        }
    }
    @media screen and (max-width: 500px) {
        #kotak {
            height: 56vh;
        }
        .cardC {
            width: 47%;
            height: 100px;
            margin-bottom: 0px;
        }
        .cardC h5 {
            font-size: 17px;
            font-weight: 600;
        }
        .cardC div {
            gap: 6%;
            font-size: 17px;
        }
        .cardC img{
            width: 33px;
            height: 33px;
        }
    }
    </style>
</head>

<body style="user-select: none;">
    @if(app()->environment('local'))
    <script>
    var tPath = '';
    </script>
    @else
    <script>
    var tPath = '';
    </script>
    @endif
    <script>
    const domain = window.location.protocol + '//' + window.location.hostname + ":" + window.location.port;
    var csrfToken = "{{ csrf_token() }}";
    var email = "{{ $userAuth['email'] }}";
    var number = "{{ $userAuth['number'] }}";
    </script>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
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
            <div class="container-fluid" style="background-color: #F6F9FF">
                <div class="pagetitle">
                    <h1>Beranda</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Beranda</li>
                        </ol>
                    </nav>
                </div>
                <div id="kotak">
                    <div id="carousel">
                        <div class="cardC" style="box-shadow: rgba(145,158,171,0.2) 0px 0px 2px 0px, rgba(145,158,171,0.12) 0px 12px 24px -4px;">
                            <h5 class="">Jumlah Disi</h5>
                            <div class="">
                                <img src="{{ asset($tPath.'img/icon/sidebar/disi.svg') }}" alt="">
                                <span>{{ $jumlah_disi }}</span>
                            </div>
                        </div>
                        <div class="cardC" style="box-shadow: rgba(145,158,171,0.2) 0px 0px 2px 0px, rgba(145,158,171,0.12) 0px 12px 24px -4px;">
                            <h5 class="">Jumlah Emotal</h5>
                            <div class="">
                                <img src="{{ asset($tPath.'img/icon/sidebar/emotal.svg') }}" alt="">
                                <span>{{ $jumlah_emotal }}</span>
                            </div>
                        </div>
                        <div class="cardC" style="box-shadow: rgba(145,158,171,0.2) 0px 0px 2px 0px, rgba(145,158,171,0.12) 0px 12px 24px -4px;">
                            <h5 class="">Jumlah Nutrisi</h5>
                            <div class="">
                                <img src="{{ asset($tPath.'img/icon/sidebar/nutrisi.svg') }}" alt="">
                                <span>{{ $jumlah_nutrisi }}</span>
                            </div>
                        </div>
                        <div class="cardC" style="box-shadow: rgba(145,158,171,0.2) 0px 0px 2px 0px, rgba(145,158,171,0.12) 0px 12px 24px -4px;">
                            <h5 class="">Jumlah Pengasuhan</h5>
                            <div class="">
                                <img src="{{ asset($tPath.'img/icon/sidebar/pengasuhan.svg') }}" alt="" width="40"
                                    height="40">
                                <span>{{ $jumlah_pengasuhan }}</span>
                            </div>
                        </div>
                        <div class="cardC" style="box-shadow: rgba(145,158,171,0.2) 0px 0px 2px 0px, rgba(145,158,171,0.12) 0px 12px 24px -4px;">
                            <h5 class="">Jumlah Konsultan</h5>
                            <div class="">
                                <img src="{{ asset($tPath.'img/icon/sidebar/konsultasi.svg') }}" alt="" width="40"
                                    height="40">
                                <span>{{ $jumlah_konsultan }}</span>
                            </div>
                        </div>
                        <div class="cardC" style="box-shadow: rgba(145,158,171,0.2) 0px 0px 2px 0px, rgba(145,158,171,0.12) 0px 12px 24px -4px;">
                            <h5 class="">Jumlah Artikel</h5>
                            <div class="">
                                <img src="{{ asset($tPath.'img/icon/sidebar/artikel.svg') }}" alt="">
                                <span>{{ $jumlah_artikel }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body mt-2 mb-5">
                            <h5 class="card-title mt-3 "><strong>Kalender Kegiatan Eduaksi</strong></h5>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Start popup dialog box -->
                            <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Acara</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">x</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="img-container">
                                                <div class="row">
                                                    <div class="col-sm-12">  
                                                        <div class="form-group">
                                                        <label for="nama_event">Nama acara</label>
                                                        <input type="text" name="nama_event" id="nama_event" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">  
                                                        <div class="form-group">
                                                        <label for="nama_tempat">Nama Tempat</label>
                                                        <input type="text" name="nama_tempat" id="nama_tempat" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">  
                                                        <div class="form-group">
                                                        <label for="deskripsi">Nama Kegiatan</label>
                                                        <input type="text" name="deskripsi" id="deskripsi" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">  
                                                        <div class="form-group">
                                                        <label for="event_start_date">Tanggal Awal</label>
                                                        <input type="date" name="event_start_date" id="event_start_date" class="form-control onlydatepicker" placeholder="Acara start date" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">  
                                                        <div class="form-group">
                                                        <label for="event_end_date">Tanggal Selesai</label>
                                                        <input type="date" name="event_end_date" id="event_end_date" class="form-control" placeholder="Acara end date" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="save_event()">Save Acara</button>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                            <!-- End popup dialog box -->
                            {{-- @include('component.dynamic-full-calendar') --}}
                        </div>
                    </div>
                </div>
                @include('page.Components.admin.footer')
            </div>
        </div>
    </div>
    @include('page.Components.preloader')
    <!-- JS for jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- JS for full calender -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <!-- bootstrap css and js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        function display_events(dataCalender) {
            var Calenders = [];
            for (var i = 0; i < dataCalender.length; i++) {
                var acara = dataCalender[i];
                Calenders.push({
                    // event_id: acara.id, // Assuming you have these fields
                    nama_event: acara.nama_event,
                    deskripsi:acara.deskripsi,
                    nama_tempat:acara.nama_tempat,
                    start: acara.start,
                    end: moment(acara.end).add(1, 'days').format('YYYY-MM-DD'),
                    color: acara.color,
                    url: ''
                });
            }
        
            var calendar = $('#calendar').fullCalendar({
                defaultView: 'month',
                timeZone: 'local',
                editable: true,
                selectable: true,
                selectHelper: true,
                eventClick: function(acara) {
                    $('#nama_event').val(acara.nama_event);
                    $('#nama_tempat').val(acara.nama_tempat);
                    $('#deskripsi').val(acara.deskripsi);
                    $('#event_start_date').val(moment(acara.start).format('YYYY-MM-DD'));
                    $('#event_end_date').val(moment(acara.end).format('YYYY-MM-DD'));
                    $('#event_entry_modal').modal('show');
                },
                events: Calenders,
            });
        }
        display_events(<?php echo json_encode($dataKalender) ?>);
        $('.close').on('click', function(){
            $('.modal.fade.show').modal('hide');
        });
    </script>
    <script src="{{ asset($tPath.'assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset($tPath.'assets/js/app.min.js') }}"></script>
    <script src="{{ asset($tPath.'assets/js/dashboard.js') }}"></script>
</body>

</html>