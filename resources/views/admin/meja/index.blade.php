@extends('layouts.template')

@section('title')
    Daftar Nomor Meja
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header admin py-5">
        <h1 class="text-center text-white display-6">Nomor Meja</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item admin"><a href="{{ route('admin') }}">Beranda</a></li>
            <li class="breadcrumb-item admin active text-white">Nomor Meja</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Table Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div style="display: flex; justify-content: space-between;">
                <a href="{{ route('admin.meja.create') }}"
                    class="btn border border-info rounded-pill px-4 py-2 mb-4 text-info"><i
                        class="fa fa-plus me-2 text-info"></i> Tambah Data</a>


                <div class="col-xl-3">
                    <form id="search-form" action="{{ route('admin.meja') }}" method="GET">
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" class="form-control p-2" placeholder="cari no meja atau kode"
                                aria-describedby="search-icon-1" style="padding-left: 10px" name="cari"
                                value={{ request()->input('cari') ?? '' }}>

                            <span id="search-icon-1" class="input-group-text p-2" onclick="this.form.submit()"><i
                                    class="fa fa-search"></i></span>
                        </div>
                    </form>
                </div>

            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">No Meja</th>
                            <th scope="col">Kode</th>
                            <th scope="col">No Order</th>
                            <th scope="col">Dibuat Tanggal</th>
                            <th scope="col" style="width: 150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($meja as $value)
                            <tr>
                                <th scope="row">
                                    <p class="mb-0 mt-2">{{ $value->id }}</p>
                                </th>
                                <td>
                                    <p class="mb-0 mt-2">{{ $value->no_meja }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-2">{{ $value->kode }}</p>
                                    <a href="{{ route('meja.qrcode', $value->id) }}" target="_blank">Show QR Code</a>
                                </td>
                                <td>
                                    <p class="mb-0 mt-2">{{ $value->order ? $value->order->no_order : '' }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-2">{{ $value->created_at }}</p>
                                </td>
                                <td>
                                    <div style="display: flex">
                                        <a href="{{ route('admin.meja.edit', $value->id) }}"
                                            class="btn btn-md rounded-circle bg-light border">
                                            <i class="fa fa-edit text-success"></i>
                                        </a>
                                        <form action="{{ route('admin.meja.destroy', $value->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-md rounded-circle bg-light border"
                                                style="margin-left: 10px">
                                                <i class="fa fa-times text-danger"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
            <!-- Pagination Links -->
            <div style="display: flex; margin-top: 20px;">
                <div class="pagination admin" style="margin-left: auto">
                    @if ($meja->onFirstPage())
                    @else
                        <a href="{{ $meja->appends(request()->query())->previousPageUrl() }}" class="prev-arrow rounded"><i
                                class="bi bi-arrow-left" aria-hidden="true"></i></a>
                    @endif

                    @foreach ($meja->getUrlRange(1, $meja->lastPage()) as $page => $url)
                        @if ($page == $meja->currentPage())
                            <a href="{{ $meja->appends(request()->query())->url($page) }}"
                                class="active rounded">{{ $page }}</a>
                        @else
                            <a href="{{ $meja->appends(request()->query())->url($page) }}" class="rounded">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($meja->hasMorePages())
                        <a href="{{ $meja->appends(request()->query())->nextPageUrl() }}" class="next-arrow rounded"><i
                                class="bi bi-arrow-right" aria-hidden="true"></i></a>
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Table Page End -->
@endsection
