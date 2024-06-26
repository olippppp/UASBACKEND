@extends('layouts.template')

@section('title')
    Daftar Pesanan
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header admin py-5">
        <h1 class="text-center text-white display-6">Daftar Pesanan</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item admin"><a href="{{ route('admin') }}">Beranda</a></li>
            <li class="breadcrumb-item admin active text-white">Daftar Pesanan</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h2 class="mb-4">Riwayat Pemesanan</h2>
            <form id="menu-form" action="{{ route('admin.orders') }}" method="GET">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-xl-4">
                                <div class="input-group w-150 mx-auto d-flex">
                                    <input type="search" class="form-control p-2"
                                        placeholder="Cari no pesanan atau nama customer" aria-describedby="search-icon-1"
                                        name="cari" value="{{ request()->input('cari') ?? '' }}">
                                    <span id="search-icon-1" class="input-group-text p-2" onclick="this.form.submit()"><i
                                            class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <div class="col-5"></div>
                            <div class="col-xl-3">
                                <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                    <label for="fruits">Urutkan:</label>
                                    <select name="sort_by" class="border-0 form-select-sm bg-light me-3"
                                        onchange="this.form.submit()">
                                        <option value="tanggal_terakhir"
                                            {{ request()->input('sort_by') == 'tanggal_terakhir' ? 'selected' : '' }}>
                                            Tanggal Terakhir</option>
                                        <option value="tanggal_terawal"
                                            {{ request()->input('sort_by') == 'tanggal_terawal' ? 'selected' : '' }}>Tanggal
                                            Terawal</option>
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
                                            <ul class="list-unstyled fruite-categorie" style="margin-right: 40px;">
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="{{ route('admin.orders', array_merge(request()->except(['status', 'page']), ['status' => null])) }}"
                                                            class="{{ !request()->has('status') ? 'active' : '' }}"><i
                                                                class="fas fa-apple-alt me-2"></i>Semua
                                                            Status</a>
                                                        <span>({{ $orders_total }})</span>
                                                    </div>
                                                    @foreach ($status_pemesanan as $key => $status)
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="{{ route('admin.orders', array_merge(request()->except(['status', 'page']), ['status' => $key])) }}"
                                                                class="{{ request()->has('status') && request()->status == $key ? 'active' : '' }}"><i
                                                                    class="fas fa-apple-alt me-2"></i>
                                                                {{ $status }}</a>
                                                            <span></span>
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

                                    <table class="table table-hover table-bordered" style="margin-top: 30px">
                                        <thead>
                                            <tr>
                                                <th>No Pemesanan</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th>No. Meja</th>
                                                <th>Nama Customer</th>
                                                <th>Total Pesanan</th>
                                                <th>Status</th>
                                                <th style="width: 150px; text-align: center;">Action</th>
                                            </tr>
                                        </thead>

                                        @foreach ($orders as $order)
                                            <tbody>
                                                <tr>
                                                    <td>{{ $order->no_order }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($order->tgl)->format('d/m/Y H:i:s') }}
                                                    </td>
                                                    <td>{{ $order->meja ? $order->meja->no_meja : '' }}</td>
                                                    <td>{{ $order->customer ? $order->customer->nama : '' }}</td>
                                                    <td>Rp. {{ number_format($order->total, 0, '.', '.') }}</td>
                                                    <td
                                                        style="font-weight: 600; color: {{ $order->status == 2 ? '#21af00' : ($order->status == 1 ? '#ff7800' : ($order->status > 0 ? 'gray' : 'gray')) }}">
                                                        {{ $status_pemesanan[$order->status] ?? '' }}
                                                    </td>
                                                    <td style="text-align: center">
                                                        <a href="{{ route('admin.orders.detail', $order->id) }}"
                                                            class="btn btn-info mr-3" style="width: 100%">Detail</a>
                                                        <a href="{{ route('admin.orders.ubah_status', $order->id) }}"
                                                            class="btn btn-secondary mr-3" style="width: 100%; margin-top: 10px;">Ubah Status</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    </table>

                                    <div class="col-12">
                                        <div class="pagination d-flex justify-content-center mt-5">
                                            @if ($orders->onFirstPage())
                                            @else
                                                <a href="{{ $orders->appends(request()->query())->previousPageUrl() }}"
                                                    class="prev-arrow rounded"><i class="bi bi-arrow-left"
                                                        aria-hidden="true"></i></a>
                                            @endif

                                            @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                                @if ($page == $orders->currentPage())
                                                    <a href="{{ $orders->appends(request()->query())->url($page) }}"
                                                        class="active rounded">{{ $page }}</a>
                                                @else
                                                    <a href="{{ $orders->appends(request()->query())->url($page) }}"
                                                        class="rounded">{{ $page }}</a>
                                                @endif
                                            @endforeach

                                            @if ($orders->hasMorePages())
                                                <a href="{{ $orders->appends(request()->query())->nextPageUrl() }}"
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Assuming you have jQuery available, you can use it for simplicity
            $('#search-icon-1').click(function() {
                $('#menu-form').submit();
            });
        });
    </script>
@endsection
