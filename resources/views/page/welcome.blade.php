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

  <title>Halaman Utama | SmartTrashku</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset($tPath.'assets3/img/smarttrashku.png') }}" rel="icon">
  <link href="{{ asset($tPath.'assets3/img/smarttrashku.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset($tPath.'assets3/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset($tPath.'assets3/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset($tPath.'assets3/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset($tPath.'assets3/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset($tPath.'assets3/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset($tPath.'assets3/css/main.css') }}" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
 

  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="#" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>SmartTrashKu<span>.</span></h1>
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="#hero">Beranda</a></li>
          <li><a href="#about">Sekilas</a></li>
          <li><a href="#services">Fitur & Keunggulan</a></li>
          <li><a href="#team">Tim Development</a></li>
          <li><a href="#recent-posts">Artikel</a></li>
          <li><a href="/login" clas="btn-visit buy-btn">Masuk <i class="bi bi-box-arrow-in-right"></i></a></li>
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h2>SmartTrashKu</h2>
          <p>Inovasi alat pemilah sampah berbasis IoT untuk meningkatkan kepedulian terhadap lingkungan di Indonesia.</p>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#about" class="btn-get-started"><i class="bi bi-download"></i> Unduh  Aplikasi</a>
          
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <img src="{{ asset($tPath.'assets3/img/hero-img.png') }}" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
        </div>
      </div>
    </div>

    <div class="icon-boxes position-relative">
      <div class="container position-relative">
        <div class="row gy-4 mt-5">

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><img src="{{ asset($tPath.'assets3/img/logo-kemendikbud.png') }}" class="img-fluid" alt="" data-aos="zoom-out" width="200px"></i></div>
              <h4 class="title"><a href="" class="stretched-link">Kemendikbud</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><img src="{{ asset($tPath.'assets3/img/logo-pkm.png') }}" class="img-fluid" alt="" data-aos="zoom-out" width="200px"></i></div>
              <h4 class="title"><a href="" class="stretched-link">PKM</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><img src="{{ asset($tPath.'assets3/img/logo-polije.png') }}" class="img-fluid" alt="" data-aos="zoom-out" width="200px"></i></div>
              <h4 class="title"><a href="" class="stretched-link">POLIJE</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <div class="icon"><img src="{{ asset($tPath.'assets3/img/logo-jti.png') }}" class="img-fluid" alt="" data-aos="zoom-out" width="200px"></i></div>
              <h4 class="title"><a href="" class="stretched-link">JTI</a></h4>
            </div>
          </div><!--End Icon Box -->

        </div>
      </div>
    </div>

    </div>
  </section>
  <!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Apa itu SmartTrashKu ?</h2>
          <p>Yuk mengenal inovasi alat pemilah sampah SmartTrashku</p>
        </div>

        <div class="row gy-4">
          <div class="col-lg-6">
            <h3>PKM - Karya Inovatif</h3>
            <img src="{{ asset($tPath.'assets3/img/about.jpg') }}" class="img-fluid rounded-4 mb-4" alt="">
            <p>Smart Trashku juga dilengkapi dengan teknologi pengenalan gambar yang dikombinasikan dengan AI. Dengan menggunakan kamera yang terpasang di Smart Trashku, sistem dapat mengidentifikasi jenis sampah yang dibuang ke dalamnya. Teknologi pengenalan gambar ini memungkinkan Smart Trashku untuk memisahkan sampah organik dan non-organik secara otomatis, mengoptimalkan proses daur ulang, dan meminimalkan pencemaran lingkungan.</p>
            <p>Selanjutnya, Smart Trashku terhubung dengan jaringan internet, sehingga dapat berkomunikasi dengan sistem manajemen sampah secara real-time. Data mengenai tingkat isi sampah, jenis sampah, dan lokasi Smart Trashku dapat diakses dan dikelola melalui aplikasi atau platform online. Petugas pengumpulan sampah dapat mengoptimalkan rute pengumpulan berdasarkan data yang diterima, menghemat waktu dan energi dalam proses pengumpulan sampah.</p>
          </div>
          <div class="col-lg-6">
            <div class="content ps-0 ps-lg-5">
              <p>
              Smart Trashku adalah sebuah inovasi teknologi yang revolusioner dalam pengelolaan sampah. Desainnya menggabungkan kecerdasan buatan (artificial intelligence) dan konektivitas internet untuk memberikan solusi efisien dalam pengumpulan dan pengelolaan sampah di era modern.
              </p>
              
              <p>
              Selain manfaat praktis, Smart Trashku juga memiliki dampak positif terhadap lingkungan. Dengan memisahkan sampah secara otomatis dan memaksimalkan daur ulang, Smart Trashku membantu mengurangi jumlah sampah yang mencemari lingkungan dan meminimalkan dampak negatif terhadap ekosistem. Selain itu, dengan mengoptimalkan rute pengumpulan sampah, Smart Trashku juga mengurangi emisi gas rumah kaca yang dihasilkan oleh kendaraan pengumpulan sampah.
              </p>


              <div class="position-relative mt-4">
                <img src="{{ asset($tPath.'assets3/img/about-2.jpg') }}" class="img-fluid rounded-4" alt="">
                <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
                <img src="{{ asset('assets3/img/about-2.jpg') }}" class="img-fluid rounded-4" alt="">
                <a href="/" class="glightbox play-btn"></a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->


    <!-- ======= Our Services Section ======= -->
    <section id="services" class="services sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Fitur & Keunggulan</h2>
          <p>Berikut ini adalah fitur dan keunggulan inovasi alat pemilah sampah SmartTrashku</p>
        </div>

        <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-4 col-md-6">
            <div class="service-item  position-relative">
              <div class="icon">
                <i class="bi bi-camera"></i>
              </div>
              <h3>Menggunakan Kamera dalam mendeteksi jenis sampah</h3>
              <p>SmartTrashKu dapat mendeteksi jenis sampah dengan kamera akurasi tinggi yang terintegrasi dengan AI. Kamera ini membantu informasi yang akurat tentang jenis sampah dalam wadah, memungkinkan pengelola sampah untuk memantau dan mengelola sampah secara efektif.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-funnel"></i>
              </div>
              <h3>Memilah antara sampah organik dan anorganik</h3>
              <p>SmartTrashKu merupakan teknologi baru yang berbasis IoT dapat memilah sampah organik atau anorganik untuk menghemat waktu serta memudahkan pengguna dalam proses pemilihan sampah secara cepat.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-search"></i>
              </div>
              <h3>Mendeteksi kapasitas tempat sampah apabila penuh</h3>
              <p>SmartTrashKu dilengkapi fitur timer untuk memantau volume sampah dalam jangka waktu tertentu. Fitur ini juga membantu mengurangi biaya operasional dan dampak lingkungan dari transportasi sampah yang berlebihan.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-window-fullscreen"></i>
              </div>
              <h3>Menampilkan informasi pada layar LCD</h3>
              <p>SmartTrashKu menampilkan informasi terkait level sampah secara visual melalui layar LCD. Data tentang level sampah ditampilkan dalam bentuk grafik atau angka yang mudah dibaca, memudahkan pengelola untuk memahami status tempat sampah dan membuat keputusan terkait penjadwalan pengangkutan sampah.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-bell"></i>
              </div>
              <h3>Notifikasi saat volume tempat sampah penuh</h3>
              <p>SmartTrashKu dilengkapi dengan fitur notifikasi yang memberi tahu pengelola sampah saat volume tempat sampah mencapai level penuh. Notifikasi ini diterima secara real-time, memungkinkan pengelola untuk merespons dan mengosongkan tempat sampah dengan cepat.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="bi bi-android2"></i>
              </div>
              <h3>Berbasis Website dan Android</h3>
              <p>Dalam memonitoring sampah, pengelola dapat menggunakan aplikasi di perangkat Android atau mengakses melalui situs web.</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>
    </section><!-- End Our Services Section -->


    <!-- ======= Our Team Section ======= -->
    <section id="team" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Tim Development</h2>
          <p>Berikut adalah tim pengembang inovasi alat pemilah sampah SmartTrashKu</p>
        </div>
 
        <div class="row gy-4 justify-content-center">

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <img src="{{ asset($tPath.'assets3/img/team/pak-radit.png') }}" class="img-fluid" alt="">
              <h4>Raditya Arief Pratama, S.Kom., M.Eng</h4>
              <span>Dosen Pembimbing</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="member">
              <img src="{{ asset($tPath.'assets3/img/team/ansori.png') }}" class="img-fluid" alt="">
              <h4>Ahmad Ansori</h4>
              <span>Ketua Tim</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <img src="{{ asset($tPath.'assets3/img/team/haqi.png') }}" class="img-fluid" alt="">
              <h4>Achmad Baihaqi</h4>
              <span>Anggota 1</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="member">
              <img src="{{ asset($tPath.'assets3/img/team/amirzan.png') }}" class="img-fluid" alt="">
              <h4>Amirzan Fikri Prasetyo</h4>
              <span>Anggota 2</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="500">
            <div class="member">
              <img src="{{ asset($tPath.'assets3/img/team/winna.png') }}" class="img-fluid" alt="">
              <h4>Winna Aprilia Nabela Sari</h4>
              <span>Anggota 3</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div><!-- End Team Member -->


          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="600">
            <div class="member">
              <img src="{{ asset($tPath.'assets3/img/team/mei.png') }}" class="img-fluid" alt="">
              <h4>Zhada Mei Arsita</h4>
              <span>Anggota 4</span>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>
    </section><!-- End Our Team Section -->

    
   

    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-posts" class="recent-posts sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Artikel Edukasi</h2>
          <p>Berikut ini daftar artikel edukasi yang wajib anda baca</p>
        </div>

        <div class="row gy-4">


          @foreach ($edukasi as $article)
          <div class="col-xl-4 col-md-6">
          <a href="{{ route('detail-artikel.show', ['id_edukasi' => $article->id_edukasi]) }}">
            <article>
              <div class="post-img">
              <img src="{{ asset($tPath.'img-edukasi/' . $article->foto_artikel_edukasi) }}" alt="" class="img-fluid" style="width: 100%; height: 500px">

              </div>
              <p class="post-category">  <i class="bi bi-folder"></i> Edukasi</p>
              <h2 class="title">
                {{ $article->judul_edukasi }}
              </h2>
              <div class="d-flex align-items-center">
                <img src="{{ asset($tPath.'assets3/img/blog/blog-author.jpg') }}" alt="" class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author">admin</p>
                  <p class="post-date">
                    <time datetime="2022-01-01">{{ \Carbon\Carbon::parse($article->tgl_edukasi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</time>
                  </p>
                </div>
              </div>
              </a>
            </article>
          </div><!-- End post list item -->
          @endforeach

        </div><!-- End recent posts list -->

      </div>
      
      <div class="row d-flex justify-content-center" style="margin-top: 20px;" data-aos="fade-up" data-aos-delay="300">
            <a href="/blog" class="button" style="background-color: #008374; color: #ffffff; width: 200px; height: 50px; 
            text-align: center; line-height: 50px; border-radius: 25px;">
                Lihat Selengkapnya <i class="bi bi-arrow-right"></i>
            </a>
        </div>
      

    </section><!-- End Recent Blog Posts Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="#" class="logo d-flex align-items-center">
            <span>SmartTrashKu</span>
          </a>
          <p>Politeknik Negeri Jember.</p>
          <div class="social-links d-flex mt-4">
            <a href="https://www.instagram.com/smartrashku/" class="instagram"><i class="bi bi-instagram"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Halaman</h4>
          <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Artikel</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Alamat</h4>
          <p>
            Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Kontak</h4>
            <strong>Email:</strong> pkmki2023.thegsteam@gmail.com<br>
          </p>

        </div>

      </div>
    </div>

    <div class="container mt-4">
      <div class="copyright">
        &copy; Copyright <strong><span>SmartTrashKu</span></strong>. All Rights Reserved
      </div>
     
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset($tPath.'assets3/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset($tPath.'assets3/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset($tPath.'assets3/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset($tPath.'assets3/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset($tPath.'assets3/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset($tPath.'assets3/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset($tPath.'assets3/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset($tPath.'assets3/js/main.js') }}"></script>

</body>

</html>