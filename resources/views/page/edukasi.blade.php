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

  <title>Edukasi</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset($tPath.'assets2/img/favicon.png') }}" rel="icon">
  <link href="{{ asset($tPath.'assets2/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

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
  <link href="{{ asset($tPath.'css/page/edukasi.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <script>
    var csrfToken = "{{ csrf_token() }}";
    var email = "{{ $email }}";
    var number = "{{ $number }}";
  </script>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="/page/dashboard" class="logo d-flex align-items-center">
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
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ $nama }}</span>
          </a><!-- End Profile Iamge Icon -->
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
        <a class="nav-link " href="/page/edukasi">
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
        <a class="nav-link collapsed" href="/page/laporan">
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
      <h1>Edukasi</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Edukasi</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    {{-- menampilkan error validasi --}}
    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif


    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <p></p>
              <button type="button" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#tambahDeviceModal">
                <i class="bi bi-plus"></i> Tambahkan Edukasi
              </button>
              <p></p>
              <!-- Modal -->
              <div class="modal fade" id="tambahDeviceModal" tabindex="-1" aria-labelledby="tambahDeviceModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="tambahDeviceModalLabel">Tambahkan Artikel</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="form-validate" method="POST" action="{{ route('edukasi.store') }}"
                        enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        
                        <input type="hidden" name="email" id="email" class="form-control"
                            value="{{ $email }}">

                        <div class="mb-3">
                          <label for="namaDeviceInput" class="form-label">Judul
                            Artikel</label>
                          <input type="text" name="judul" id="judul" class="form-control"
                            value="{{ old('judul') }}">
                        </div>
                        <div class="mb-3">
                          <label for="tokenInput" class="form-label">Isi Artikel</label>
                          <div class="col-sm-12">
                            <textarea type="text" name="isi_artikel" id="isi_artikel" class="form-control"></textarea>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="gpsInput" class="form-label">Gambar</label>
                          <input class="form-control" name="foto" id="foto" type="file" id="formFile"
                            accept="image/png, image/jpeg">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                    <!-- <th scope="col">Foto</th> -->
                    <th scope="col">Tanggal</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody id="table-edukasi">
                  <tr id="modalData">
                  @php $no = 1; @endphp
                @foreach($edukasi as $e)
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{$e->judul_edukasi}}</td>
                    <!-- <td><img src="{{ asset($tPath.'img-edukasi/'.$e->foto_artikel_edukasi) }}" width="20px"></td> -->
                    <td>{{date('d-m-Y', strtotime($e->tgl_edukasi))}}</td>
                    <td><a href="#"  data-bs-toggle="modal" data-bs-target="#largeModalEdit{{ $e->id_edukasi }}" type="button"  class="btn btn-success"><i class="bi bi-pencil-square"></i> Edit</a>
                    <a href="#{{ $e->id_edukasi }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#largeModalHapus1{{ $e->id_edukasi }}"><i class="bi bi-trash"></i> Hapus</a>
                    </td>

                    <!-- Tampilan Modal -->
<div class="modal fade" id="largeModalHapus1{{ $e->id_edukasi }}" tabindex="-3">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalHapus{{ $e->id_edukasi }}">Konfirmasi Hapus Artikel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus artikel ini? 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('edukasi.destroy', $e->id_edukasi) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-success">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Basic Modal-->

                    <div class="modal fade" id="largeModalEdit{{ $e->id_edukasi }}" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Update Artikel</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                      <!-- General Form Elements -->
                      <form class="form-validate" id="artikeledukasiform" method="POST" action="{{ route('edukasi.update', $e->id_edukasi) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
               
               <input type="hidden" name="id" value="{{ isset($edukasi) ? $e->id_edukasi : '' }}">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Judul Artikel</label>
                  <div class="col-sm-10">
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ isset($edukasi) ? $e->judul_edukasi : '' }}">
                  </div>
                </div>
                
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Isi Artikel</label>
                  <div class="col-sm-10">
                    <textarea type="text" name="isi_artikel" id="isi_artikel" class="form-control">{{ isset($edukasi) ? $e->deskripsi : '' }}</textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Gambar</label>
                  <div class="col-sm-10">

                  <p><img src="{{ asset($tPath.'img-edukasi/'.$e->foto_artikel_edukasi) }}"  width="30%"></p>
                    <input class="form-control" name="foto" id="foto" type="file" id="formFile"  accept="image/png, image/jpeg">
                  </div>
                </div>
           
                
        
                <div class="row mb-3">
</div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-success">Update</button>
                    </div>
                      </form><!-- End General Form Elements -->
                  </div>
                </div>

                  </tr>
                  @endforeach
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>


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
        <form method="post" id="logoutForm">
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

    function changeTable(data) {
      while (tableEdukasi.firstChild) {
        tableEdukasi.firstChild.remove();
      }
      data.forEach(e => {
        console.log("tanggal " + e.tgl_edukasi);
        const row = document.createElement('tr');
        var cell = document.createElement('td');
        row.innerHTML = `
      <td scope="row">${tableEdukasi.rows.length+1}</td>
      <td>${e.judul_edukasi}</td>
      <td>${new Date(e.tgl_edukasi).toLocaleDateString('en-US', { day: '2-digit', month: '2-digit', year: 'numeric' })}</td>
      `;
        var linkUpdate = document.createElement('a');
        var linkDelete = document.createElement('a');
        var iUpdate = document.createElement('i');
        var iDelete = document.createElement('i');
        linkUpdate.className = 'btn btn-success';
        linkDelete.className = 'btn btn-danger';
        linkUpdate.setAttribute('data-bs-toggle', 'modal');
        linkUpdate.setAttribute('data-bs-target', `#largeModalEdit${e.id_edukasi}`);
        linkDelete.setAttribute('data-bs-toggle', 'modal');
        linkDelete.setAttribute('data-bs-target', `#largeModalHapus${e.id_edukasi}`);
        iUpdate.className = 'bi bi-pencil-square';
        iDelete.className = 'bi bi-trash';
        linkUpdate.textContent = 'Edit';
        linkDelete.textContent = 'Hapus';
        // linkUpdate.setAttribute('type', 'button');
        // linkDelete.setAttribute('type', 'button');
        // linkUpdate.addEventListener('click', function() {
        //   changeEdukasi(e.id_edukasi);
        // });
        // linkDelete.addEventListener('click', function() {
        //   deleteEdukasi(e.id_edukasi);
        // });
        linkUpdate.appendChild(iUpdate);
        linkDelete.appendChild(iDelete);
        cell.appendChild(linkUpdate);
        cell.appendChild(linkDelete);
        row.appendChild(cell);
        tableEdukasi.appendChild(row);
        console.log('tambah edit modal');
        //tambah pop up edit 
        // modalData.innerHTML = `
        //   <div class="modal fade" id="largeModalEdit${e.id_edukasi}" tabindex="-1">
        //     <div class="modal-dialog modal-xl">
        //       <div class="modal-content">
        //         <div class="modal-header">
        //           <h5 class="modal-title">Update Artikel</h5>
        //           <button type="button" class="btn-close" data-bs-dismiss="modal"
        //             aria-label="Close"></button>
        //         </div>
        //         <div class="modal-body">
        //           <!-- General Form Elements -->
        //           <form class="form-validate" id="artikeledukasiform" method="PUT"
        //             action="/page/edukasi/${e.id_edukasi}" enctype="multipart/form-data">
        //             <div class="row mb-3">
        //               <label for="inputText" class="col-sm-2 col-form-label">Judul Artikel</label>
        //               <div class="col-sm-10">
        //                 <input type="text" name="judul" id="judul" class="form-control"
        //                   value="${e.judul_edukasi}">
        //               </div>
        //             </div>
        //             <div class="row mb-3">
        //               <label for="inputEmail" class="col-sm-2 col-form-label">Isi Artikel</label>
        //               <div class="col-sm-10">
        //                 <textarea type="text" name="isi_artikel" id="isi_artikel" class="form-control" required>${e.deskripsi}</textarea>
        //               </div>
        //             </div>
        //             <div class="row mb-3">
        //               <label for="inputNumber" class="col-sm-2 col-form-label">Gambar</label>
        //               <div class="col-sm-10">
        //                 <input class="form-control" name="foto" id="foto" type="file" id="formFile" accept="image/png, image/jpeg">
        //               </div>
        //           </form><!-- End General Form Elements -->
        //           <div class="row mb-3">
        //           </div>
        //         </div>
        //         <div class="modal-footer">
        //           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        //           <button type="submit" class="btn btn-success">Update</button>
        //         </div>
        //       </div>
        //     </div>
        //   </div>
        // `;
        console.log('tambah hapus modal')
        //tambah hapus modal
        // modalData.innerHTML = `
        //   <div class="modal fade" id="largeModalHapus${e.id_edukasi}" tabindex="-1" aria-labelledby="largeModalHapus${e.id_edukasi}Label" aria-hidden="true">
        //     <div class="modal-dialog">
        //       <div class="modal-content">
        //         <div class="modal-header">
        //           <h5 class="modal-title" id="largeModalHapus${e.id_edukasi}Label">
        //             Konfirmasi Hapus Artikel
        //           </h5>
        //           <button type="button" class="btn-close" data-bs-dismiss="modal"
        //             aria-label="Close"></button>
        //         </div>
        //         <div class="modal-body">
        //           Apakah Anda yakin ingin menghapus artikel ini?
        //           <form action="/page/edukasi/${e.id_edukasi}" method="DELETE">
        //             <!-- Tambahkan penutup form pada bagian ini -->
        //             <div class="modal-footer">
        //               <button type="button" class="btn btn-secondary"
        //                 data-bs-dismiss="modal">Batal</button>
        //               <button type="submit" class="btn btn-success" onclick='deleteEdukasi(${e.id_edukasi})'>Hapus</button>
        //             </div>
        //           </form>
        //         </div>
        //       </div>
        //     </div>
        //   </div>
        // `;
      });
    }

    // function editEdukasi(id_edukasi) {
    //   var xhr = new XMLHttpRequest();
    //   //open the request
    //   xhr.open('DELETE', `/page/edukasi/${id_edukasi}`);
    //   xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    //   xhr.setRequestHeader('Content-Type', 'application/json');
    //   // xhr.send(JSON.stringify(requestBody));
    //   xhr.onreadystatechange = function() {
    //     if (xhr.readyState == XMLHttpRequest.DONE) {
    //       if (xhr.status === 200) {
    //         var response = JSON.parse(xhr.responseText);
    //         console.log(response.data);
    //         console.log(response);
    //         getEdukasi();
    //         console.log('update data');
    //         console.log(edukasi)
    //         console.log('update data1');
    //         // console.log(getDevice());
    //         // dataDevice = response.data;
    //         changeTable(edukasi);
    //       } else {
    //         var response = JSON.parse(xhr.responseText);
    //         console.log('errorrr ' + response);
    //       }
    //     }
    //   }
    // }
    function deleteEdukasi(id_edukasi) {
      var xhr = new XMLHttpRequest();
      //open the request
      xhr.open('DELETE', `/page/edukasi/${id_edukasi}`);
      xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
      xhr.setRequestHeader('Content-Type', 'application/json');
      // xhr.send(JSON.stringify(requestBody));
      xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response.data);
            console.log(response);
            getEdukasi();
            console.log('update data');
            console.log(edukasi)
            console.log('update data1');
            // console.log(getDevice());
            // dataDevice = response.data;
            changeTable(edukasi);
          } else {
            var response = JSON.parse(xhr.responseText);
            console.log('errorrr ' + response);
          }
        }
      }
    }
    var csrfToken = "{{ csrf_token() }}";
    var email = "{{ $email }}";
    var number = "{{ $number }}";
    var edukasi = @json($edukasi);
    // for (var i = 0; i < edukasi.length; i++) {}
    changeTable(edukasi);
  </script>
  <script src="{{ asset($tPath.'js/page/edukasi.js') }}"></script>
  <!-- Vendor JS Files -->
  <script src="{{ asset($tPath.'assets2/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset($tPath.'assets2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset($tPath.'assets2/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset($tPath.'assets2/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset($tPath.'assets2/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset($tPath.'assets2/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset($tPath.'assets2/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset($tPath.'assets2/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset($tPath.'assets2/js/main.js') }}"></script>
</body>

</html>
