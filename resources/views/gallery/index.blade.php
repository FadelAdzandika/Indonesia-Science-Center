@extends('layouts.app')

@section('title', 'Galeri Foto ISC | Indonesia Science Center')

@push('styles')
<style>
    .category-header {
        font-size: 1.75rem; /* Ukuran font judul kategori */
        font-weight: 600;
        color: #34495e; /* Warna judul kategori */
        border-bottom: 2px solid #ecf0f1; /* Garis bawah yang lebih halus */
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
    }
    .gallery-img-container {
        overflow: hidden;
        border-radius: 8px; /* Sedikit lebih kotak */
        box-shadow: 0 4px 8px rgba(0,0,0,0.05); /* Bayangan halus untuk setiap gambar */
        transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
    }
    .gallery-img-container img {
        transition: transform 0.3s ease-in-out;
        display: block; /* Menghilangkan spasi ekstra di bawah gambar */
    }
    .gallery-img-container:hover img {
        transform: scale(1.05);
    }
     .gallery-page .display-5 {
        color: #2c3e50; /* Warna judul utama lebih gelap */
    }
    .gallery-page .lead {
        font-size: 1.15rem;
        color: #7f8c8d; /* Warna teks deskripsi lebih lembut */
    }
    .gallery-img-container:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    }
    .card.gallery-item { /* Menargetkan card secara spesifik */
        border: none; /* Menghilangkan border default card */
        background-color: transparent; /* Latar belakang transparan untuk card */
    }
    .card-body.gallery-item-caption {
        background-color: #f8f9fa; /* Latar belakang sedikit berbeda untuk caption */
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }

</style>
@endpush

@section('content')
<div class="container py-5 gallery-page">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">Galeri Foto Indonesia Science Center</h1>
        <p class="lead text-muted">Jelajahi berbagai momen dan kegiatan menarik kami yang terdokumentasi.</p>
    </div>

    @if(isset($categoriesWithPhotos) && $categoriesWithPhotos->isNotEmpty())
        @foreach($categoriesWithPhotos as $category)
            <section id="category-{{ $category->slug ?? $category->id }}" class="mb-5">
                <h2 class="category-header fw-bold">{{ $category->name }}</h2>
                @if($category->description)
                    <p class="text-muted mb-4">{{ $category->description }}</p>
                @endif

                @if($category->photos->isNotEmpty())
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                        @foreach($category->photos as $photo)
                            <div class="col d-flex align-items-stretch">
                                <div class="card gallery-item h-100">
                                    <a href="{{ asset('uploads/' . $photo->image_path) }}" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-image="{{ asset('uploads/' . $photo->image_path) }}" data-bs-title="{{ $photo->title ?? $category->name }}">
                                        <div class="gallery-img-container">
                                            <img src="{{ asset('uploads/' . $photo->image_path) }}" class="card-img-top" alt="{{ $photo->title ?? 'Foto dari ' . $category->name }}" style="height: 220px; object-fit: cover; cursor: pointer;">
                                        </div>
                                    </a>
                                    @if($photo->title || $photo->description)
                                    <div class="card-body p-3 gallery-item-caption">
                                        @if($photo->title)
                                            <h6 class="card-title fw-normal mb-1" style="font-size: 0.95rem;">{{ $photo->title }}</h6>
                                        @endif
                                        @if($photo->description)
                                            <p class="card-text small text-muted" style="font-size: 0.8rem;">{{ Str::limit($photo->description, 50) }}</p>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-muted">Belum ada foto dalam kategori ini.</p>
                @endif
            </section>
        @endforeach

        <!-- Modal untuk Galeri Foto ISC -->
        @include('partials._image_modal', ['modalId' => 'galleryModal', 'modalTitle' => 'Pratinjau Gambar'])

    @else
        <div class="text-center py-5">
            <i class="bi bi-camera-reels fs-1 text-muted mb-3"></i>
            <h4 class="text-muted">Belum ada kategori atau foto untuk ditampilkan.</h4>
            <p class="text-muted">Silakan cek kembali nanti.</p>
        </div>
    @endif
</div>
@endsection

@push('scripts')
@include('partials._image_modal_script', ['modalId' => 'galleryModal'])
@endpush