<?php 
if(app()->environment('local')){
    $tPath = '';
}else{
    $tPath = '/public/';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Laporan</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

 
  <!-- Favicons -->
  <link href="{{ asset($tPath.'assets2/img/favicon.png') }}" rel="icon">
<link href="{{ asset($tPath.'assets2/img/apple-touch-icon.png') }}" rel="apple-touch-icon">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

 <!-- Vendor CSS Files -->
<link href="{{ asset($tPath.'assets2/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets2/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets2/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets2/vendor/quill/quill.snow.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets2/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets2/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset($tPath.'assets2/vendor/simple-datatables/style.css') }}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{ asset($tPath.'assets2/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/page/laporan" class="logo d-flex align-items-center">
        
        <span class="d-none d-lg-block">SmartTrashKu</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

  

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="{{ asset($tPath.'assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{$nama}}</span>
          </a><!-- End Profile image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
           
          
          <li>
            <form method="post" id="logoutForm">
              <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#konfirmasiKeluarModal">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
              </a>
              </form>
            </li>


          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="/page/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
    <a class="nav-link collapsed" href="/page/edukasi">
      <i class="bi bi-book"></i>
      <span>Edukasi</span>
    </a>
  </li><!-- End Device Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="/page/device">
          <i class="bi bi-hdd"></i>
          <span>Device</span>
        </a>
      </li><!-- End Device Nav -->


      <li class="nav-item">
        <a class="nav-link" href="/page/laporan">
          <i class="bi bi-clipboard-data"></i>
          <span>Laporan</span>
        </a>
      </li><!-- End Device Nav -->

    
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-bs-toggle="modal" data-bs-target="#konfirmasiKeluarModal">
          <i class="bi bi-box-arrow-right"></i>
          <span>Keluar</span>
        </a>
      </li><!-- End Keluar Nav -->
      


    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Laporan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Laporan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <p></p>
              <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="deviceDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-gear"></i> Device 1
                </button>
                <ul class="dropdown-menu" aria-labelledby="deviceDropdown" id="deviceDropdownMenu">
                  {{-- <li><a class="dropdown-item" href="#" onclick="changeDevice()" >Device 1</a></li>
                  <li><a class="dropdown-item" href="#" onclick="changeDevice()" >Device 2</a></li>
                  <li><a class="dropdown-item" href="#" onclick="changeDevice()" >Device 3</a></li>
                  <li><a class="dropdown-item" href="#" onclick="changeDevice()" >Device 4</a></li>
                  <li><a class="dropdown-item" href="#" onclick="changeDevice()" >Device 5</a></li> --}}
                </ul>
              </div>
              
              <p></p>

              
              <div class="row">
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Sampah Organik</h5>
                      <!-- Radial Bar Chart -->
                      <div id="radialBarChart"></div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Sampah Anorganik</h5>
                      <!-- Radial Bar Chart -->
                      <div id="radialBarChart2"></div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jenis Sampah</th>
                    <th scope="col">Volume</th>
                  </tr>
                </thead>
                <tbody id="table-laporan">
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>SmartTrashku</span></strong>. All Rights Reserved
    </div>
    
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
<script src="{{ asset($tPath.'assets2/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset($tPath.'assets2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset($tPath.'assets2/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset($tPath.'assets2/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset($tPath.'assets2/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset($tPath.'assets2/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset($tPath.'assets2/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset($tPath.'assets2/vendor/php-email-form/validate.js') }}"></script>


  <!-- Modal -->
  <div class="modal fade" id="konfirmasiKeluarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Keluar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin keluar?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form method="post" id="logoutForm" action="{{ route('logout') }}">
        @csrf
          <button type="submit" class="btn btn-success">
            <i class="bi bi-box-arrow-right"></i>
            <span>Keluar</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>



<script>
  const domain = window.location.protocol + '//' + window.location.hostname +":"+window.location.port;
  const tableLaporan = document.querySelector('#table-laporan');
  const dropdownMenu = document.getElementById('deviceDropdownMenu');
  const btnDropDown = document.getElementById('deviceDropdownBtn');
  var csrfToken = "{{ csrf_token() }}";
  var email = "{{$email}}";
  var number = "{{$number}}";
  let chart1 = null
  let chart2 = null
  
  function changeTableLaporan(data){
    // console.log('ganti tabel');
    if(data == null){
      if (chart1 && chart2) {
        chart1.updateSeries([0]);
        chart2.updateSeries([0]);
      }else{
        chart1 = new ApexCharts(document.querySelector("#radialBarChart"), {
          series:[0],
          chart: {
            height: 350,
            type: 'radialBar',
            toolbar: {
              show: true
            }
          },
          plotOptions: {
            radialBar: {
              dataLabels: {
                name: {
                  fontSize: '22px',
                },
                value: {
                  fontSize: '16px',
                },
                total: {
                  show: true,
                  label: 'Volume',
                  formatter: function(w) {
                    // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                    return `${chart1.w.globals.series[0]}%`;
                  }
                }
              }
            }
          },
          labels: ['Berries'],
        })
        chart1.render();
        chart2 = new ApexCharts(document.querySelector("#radialBarChart2"), {
          series:[0],
          chart: {
            height: 350,
            type: 'radialBar',
            toolbar: {
              show: true
            }
          },
          plotOptions: {
            radialBar: {
              dataLabels: {
                name: {
                  fontSize: '22px',
                },
                value: {
                  fontSize: '16px',
                },
                total: {
                  show: true,
                  label: 'Volume',
                  formatter: function(w) {
                    // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                    return `${chart2.w.globals.series[0]}%`;
                  }
                }
              }
            }
          },
          labels: ['Berries'],
        })
        chart2.render();
      }
      // console.log('ganti table laporan')
      while (tableLaporan.firstChild) {
        tableLaporan.firstChild.remove();
      }
    }else{
      if (chart1 && chart2) {
        chart1.updateSeries([data[0]['organik']]);
        chart2.updateSeries([data[0]['anorganik']]);
      }else{
        chart1 = new ApexCharts(document.querySelector("#radialBarChart"), {
          series:[data[0]['organik']],
          chart: {
            height: 350,
            type: 'radialBar',
            toolbar: {
              show: true
            }
          },
          plotOptions: {
            radialBar: {
              dataLabels: {
                name: {
                  fontSize: '22px',
                },
                value: {
                  fontSize: '16px',
                },
                total: {
                  show: true,
                  label: 'Volume',
                  formatter: function(w) {
                    // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                    return `${chart1.w.globals.series[0]}%`;
                  }
                }
              }
            }
          },
          labels: ['Berries'],
        })
        chart1.render();
        chart2 = new ApexCharts(document.querySelector("#radialBarChart2"), {
          series:[data[0]['anorganik']],
          chart: {
            height: 350,
            type: 'radialBar',
            toolbar: {
              show: true
            }
          },
          plotOptions: {
            radialBar: {
              dataLabels: {
                name: {
                  fontSize: '22px',
                },
                value: {
                  fontSize: '16px',
                },
                total: {
                  show: true,
                  label: 'Volume',
                  formatter: function(w) {
                    // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                    return `${chart2.w.globals.series[0]}%`;
                  }
                }
              }
            }
          },
          labels: ['Berries'],
        })
        chart2.render();
      }
      console.log('ganti table laporan')
      while (tableLaporan.firstChild) {
        tableLaporan.firstChild.remove();
      }
      data.forEach(laporan => {
        const row1 = document.createElement('tr');
        const row2 = document.createElement('tr');
        row1.innerHTML = `
        <th scope="row">${tableLaporan.rows.length+1}</th>
        <td>${laporan.tanggal+' ('+laporan.waktu+' WIB)'}</td>
        <td>organik</td>
        <td>${laporan.organik}%</td>
        `;
        row2.innerHTML = `
        <th scope="row">${tableLaporan.rows.length+2}</th>
        <td>${laporan.tanggal+' ('+laporan.waktu+' WIB)'}</td>
        <td>anorganik</td>
        <td>${laporan.anorganik}%</td>
        `;
        tableLaporan.appendChild(row1);
        tableLaporan.appendChild(row2);
      });
    }
  }
  function changeDevice(id, nama){
    var xhr = new XMLHttpRequest();
    var requestBody = {
        email: email,
        id_device:id,
        query:"organik,anorganik,DATE_FORMAT(updated_at, '%d-%m-%Y') as tanggal, SUBSTRING(updated_at, 12, 5) as waktu",
        limit:100,
        'orderby':'ORDER BY updated_at DESC',
    };
    //open the request
    xhr.open('POST',"/page/laporan/laporan/get");
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(requestBody));
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                console.log(response.data);
                btnDropDown.innerHTML = `<i class="bi bi-gear"></i> ${nama}`;
                dataLaporan = response.data;
                changeTableLaporan(dataLaporan);
              } else {
                btnDropDown.innerHTML = `<i class="bi bi-gear"></i> ${nama}`;
                var response = JSON.parse(xhr.responseText);
                while (tableLaporan.firstChild) {
                  tableLaporan.firstChild.remove();
                }
                if (chart1 && chart2) {
                  chart1.updateSeries([0]);
                  chart2.updateSeries([0]);
                }
            }
        }
    }
  }
  function changeDropDown(data) {
    data.forEach(device => {
      console.log(device);
      var listItem = document.createElement('li');
      var link = document.createElement('a');
      link.className = 'dropdown-item';
      link.id = device.id_device;
      link.href = '#';
      link.textContent = device.nama_device;
      listItem.appendChild(link);
      dropdownMenu.appendChild(listItem);
      link.addEventListener('click', function() {
        changeDevice(device.id_device, device.nama_device);
      });
    });
  }
    @if (!is_null($dataDevice) && isset ($dataLaporan) && !is_null($dataLaporan))
      var dataDevice =  @json($dataDevice);
      console.log(dataDevice);
      var dataLaporan = @json($dataLaporan);
      btnDropDown.innerHTML = `<i class="bi bi-gear"></i> ${dataDevice[0]['nama_device']}`;
      changeDropDown(dataDevice);
    @else
      var dataDevice =  @json($dataDevice);
      var dataLaporan = null
    @endif
    changeTableLaporan(dataLaporan);
  </script>
<!-- Template Main JS File -->
<script src="{{ asset($tPath.'assets2/js/main.js') }}"></script>
<script src="{{ asset($tPath.'js/page/laporan.js') }}"></script>

</body>

</html>