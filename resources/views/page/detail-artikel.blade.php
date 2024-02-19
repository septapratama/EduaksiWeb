<?php 
if(app()->environment('local')){
    $tPath = '';
}else{
    $tPath = '/public/';
}
?>
@extends('page/layouts.template')
@section('content')


<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Artikel</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">

          <div class="col-lg-8">

            <article class="blog-details">

              <div class="post-img">
                <img src="{{ asset($tPath.'img-edukasi/' . $edukasi->foto_artikel_edukasi) }}" alt="" class="img-fluid" width="100%">
              </div>

              <h2 class="title">{{ $edukasi->judul_edukasi }}</h2>

              <div class="meta-top">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> admin</li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($edukasi->tgl_edukasi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</time></li>
                </ul>
              </div><!-- End meta top -->

              <div class="content">
                  <?php
                  $deskripsi = $edukasi->deskripsi;
                  $paragraphs = preg_split('/\r\n|\r|\n/', $deskripsi);

                  foreach ($paragraphs as $paragraph) {
                      echo "<p>" . nl2br($paragraph) . "</p>";
                  }
                  ?>
              </div>
<!-- End post content -->

              <div class="meta-bottom">
                <i class="bi bi-folder"></i>
                <ul class="cats">
                  <li>Edukasi</li>
                </ul>

            
              </div><!-- End meta bottom -->

            </article><!-- End blog post -->

           
          </div>

          <div class="col-lg-4">

            <div class="sidebar">

              <!-- <div class="sidebar-item search-form">
                <h3 class="sidebar-title">Cari Artikel</h3>
                <form action="" class="mt-3"  action="{{ route('page.blog.index') }}" method="GET" >
                  <input type="text" name="search" id="search" value="{{ $search ?? '' }}">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>

              </div> -->
              
              <!-- End sidebar search formn-->

              <div class="sidebar-item recent-posts">
                <h3 class="sidebar-title">Artikel Lainnya</h3>

           
                <div class="mt-3">

                @foreach ($artikel1 as $a)

                <a href="{{ route('detail-artikel.show', ['id_edukasi' => $a->id_edukasi]) }}">
                  <div class="post-item mt-3">
                  <img src="{{ asset($tPath.'img-edukasi/' . $a->foto_artikel_edukasi) }}" alt=""  style="width:60px; height: 60px">
                    <div>
                    <h4>{{ $a->judul_edukasi }}</h4>
                      <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($a->tgl_edukasi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</time>
                    </div>
                  </div>
                  </a>

                  @endforeach
                  <!-- End recent post item-->

                </div>

             

              </div><!-- End sidebar recent posts-->

            </div><!-- End Blog Sidebar -->

          </div>
        </div>

      </div>
    </section><!-- End Blog Details Section -->

  </main><!-- End #main -->

  @endsection