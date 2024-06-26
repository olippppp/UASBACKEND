@extends('layouts.template')

@section('title')
    Home
@endsection

@section('content')
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h1 class="mb-5 display-3 text-primary"
                        style="padding: 10px 35px;
                    color: #fef1de !important;
                    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
                }">
                        Bahagia saat makan bersama keluarga</h1>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded" style="max-height: 291px">
                                <img src="/img/menu2.jpg" class="img-fluid w-100 h-100 bg-secondary rounded"
                                    alt="First slide"
                                    style="max-height: 291px; min-height: 291px;
                                    object-fit: cover;">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Sarapan Pagi</a>
                            </div>
                            <div class="carousel-item rounded" style="max-height: 291px">
                                <img src="/img/menu3.jpg" class="img-fluid w-100 h-100 rounded" alt="Second slide"
                                    style="max-height: 291px; min-height: 291px;
                                    object-fit: cover;">>
                                <a href="#" class="btn px-4 py-2 text-white rounded">Main Course</a>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Menu Kami</h1>
                    </div>
                    {{-- <div class="col-lg-8 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                    href="#tab-1">
                                    <span class="text-dark" style="width: 130px;">Semua Menu</span>
                                </a>
                            </li>

                        </ul>
                    </div> --}}
                </div>
                <div class="tab-content">

                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">

                                    @foreach ($menu as $value)
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img" style="height: 207px">
                                                    @if ($value->foto)
                                                        <img class="img-fluid"
                                                            src="data:image/jpeg;base64,{{ stream_get_contents($value->foto) }}"
                                                            alt="{{ $value->nama }}" class="img-fluid w-100 rounded-top"
                                                            style="height: 207.2px; max-height: 207.2px">
                                                    @endif
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                    style="top: 10px; left: 10px;">{{ $value->kategori->nama }}</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom"
                                                    style="height: calc(100% - 207px); display: flex; flex-flow: column; justify-content: space-between;">
                                                    <div>
                                                        <h4>{{ $value->nama }}</h4>
                                                        <p>{{ $value->deskripsi }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">Rp.
                                                            {{ number_format($value->harga, 0, '.', '.') }}</p>
                                                        <a href="{{ route('menu_kategori.add_to_cart', $value->id) }}"
                                                            class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i>Tambah
                                                            Pesanan</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
@endsection
