@extends('layouts.template')

@section('title')
    Daftar Menu
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Menu</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item active text-white">Menu</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Daftar Menu Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h2 class="mb-4">Daftar Menu</h2>
            <form id="menu-form" action="{{ route('menu_kategori') }}" method="GET">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-xl-3">
                                <div class="input-group w-100 mx-auto d-flex">
                                    <input type="search" class="form-control p-2" placeholder="Cari menu"
                                        aria-describedby="search-icon-1" name="cari"
                                        value="{{ request()->input('cari') ?? '' }}">
                                    <span id="search-icon-1" class="input-group-text p-2" onclick="this.form.submit()"><i
                                            class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-xl-3">
                                <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                    <label for="fruits">Urutkan:</label>
                                    <select name="sort_by" class="border-0 form-select-sm bg-light me-3"
                                        onchange="this.form.submit()">
                                        <option value="name_asc"
                                            {{ request()->input('sort_by') == 'name_asc' ? 'selected' : '' }}>
                                            A-Z</option>
                                        <option value="name_desc"
                                            {{ request()->input('sort_by') == 'name_desc' ? 'selected' : '' }}>Z-A</option>
                                        <option value="price_asc"
                                            {{ request()->input('sort_by') == 'price_asc' ? 'selected' : '' }}>Harga
                                            Terendah
                                        </option>
                                        <option value="price_desc"
                                            {{ request()->input('sort_by') == 'price_desc' ? 'selected' : '' }}>Harga
                                            Tertinggi
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Kategori</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="{{ route('menu_kategori', array_merge(request()->except(['kategori_id', 'page']), ['kategori_id' => null])) }}"
                                                            class="{{ !request()->has('kategori_id') ? 'active' : '' }}"><i
                                                                class="fas fa-apple-alt me-2"></i>Semua
                                                            Kategori</a>
                                                        <span>({{ $total_menu }})</span>
                                                    </div>
                                                    @foreach ($kategori as $kat)
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="{{ route('menu_kategori', array_merge(request()->except(['kategori_id', 'page']), ['kategori_id' => $kat->kategori_id])) }}"
                                                                class="{{ request()->has('kategori_id') && request()->kategori_id == $kat->kategori_id ? 'active' : '' }}"><i
                                                                    class="fas fa-apple-alt me-2"></i>{{ $kat->kategori_nama }}</a>
                                                            <span>({{ $kat->count }})</span>
                                                        </div>
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row g-4 justify-content-center">

                                    @foreach ($menu as $value)
                                        <div class="col-md-6 col-lg-6 col-xl-4">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img" style="height: 207px">
                                                    @if ($value->foto)
                                                        <img class="img-fluid"
                                                            src="data:image/jpeg;base64,{{ stream_get_contents($value->foto) }}"
                                                            alt="{{ $value->nama }}" class="img-fluid w-100 rounded-top"
                                                            style="height: 235.2px; max-height: 235.2px">
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

                                    <div class="col-12">
                                        <div class="pagination d-flex justify-content-center mt-5">
                                            @if ($menu->onFirstPage())
                                            @else
                                                <a href="{{ $menu->appends(request()->query())->previousPageUrl() }}"
                                                    class="prev-arrow rounded"><i class="bi bi-arrow-left"
                                                        aria-hidden="true"></i></a>
                                            @endif

                                            @foreach ($menu->getUrlRange(1, $menu->lastPage()) as $page => $url)
                                                @if ($page == $menu->currentPage())
                                                    <a href="{{ $menu->appends(request()->query())->url($page) }}"
                                                        class="active rounded">{{ $page }}</a>
                                                @else
                                                    <a href="{{ $menu->appends(request()->query())->url($page) }}"
                                                        class="rounded">{{ $page }}</a>
                                                @endif
                                            @endforeach

                                            @if ($menu->hasMorePages())
                                                <a href="{{ $menu->appends(request()->query())->nextPageUrl() }}"
                                                    class="next-arrow rounded"><i class="bi bi-arrow-right"
                                                        aria-hidden="true"></i></a>
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Daftar Menu End-->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Assuming you have jQuery available, you can use it for simplicity
            $('#search-icon-1').click(function() {
                $('#menu-form').submit();
            });
        });
    </script>
@endsection
