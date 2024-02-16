@extends('page/layouts.template')
@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Daftar Artikel</h2>
              <p>Berikut ini adalah daftar artikel edukasi yang perlu anda baca.</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="#">Beranda</a></li>
            <li>Artikel</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4 posts-list">

        @foreach ($edukasi as $article)

       
          <div class="col-xl-4 col-md-6">
         
            <article>


            <a href="{{ route('detail-artikel.show', ['id_edukasi' => $article->id_edukasi]) }}">
              <div class="post-img">
              <img src="{{ asset($tPath.'img-edukasi/' . $article->foto_artikel_edukasi) }}" alt="" class="img-fluid" style="width: 100%; height: 500px">
              </div>

              <p class="post-category"><i class="bi bi-folder"></i> Edukasi</p>

              <h2 class="title">
               {{ $article->judul_edukasi }}
              </h2>

              <div class="d-flex align-items-center">
                <img src="{{ asset($tPath.'assets3/img/blog/blog-author.jpg') }}" alt="" class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author-list">admin</p>
                  <p class="post-date">
                    <time>{{ \Carbon\Carbon::parse($article->tgl_edukasi)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</time>
                  </p>
                </div>
              </div>

                </a>
            </article>
            
          </div><!-- End post list item -->

          

          @endforeach

        </div><!-- End blog posts list -->

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

  @endsection