@extends('layouts.template')

@section('title')
    Daftar Menu
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header admin py-5">
        <h1 class="text-center text-white display-6">Menu</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item admin"><a href="{{ route('admin') }}">Beranda</a></li>
            <li class="breadcrumb-item admin active text-white">Menu</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Table Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <a href="{{ route('admin.menu.create') }}" class="btn border border-info rounded-pill px-4 py-2 mb-4 text-info"><i
                    class="fa fa-plus me-2 text-info"></i> Tambah Data</a>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Harga</th>
                            <th scope="col" style="width: 150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menu as $value)
                            <tr>
                                <th scope="row">
                                    <p class="mb-0 mt-2">{{ $value->id }}</p>
                                </th>
                                <td>
                                    @if ($value->foto)
                                        <img src="data:image/jpeg;base64,{{ stream_get_contents($value->foto) }}"
                                            alt="Foto" style="max-width: 150px">
                                    @endif
                                    </p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-2">{{ $value->nama }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-2">{{ $value->kategori->nama }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-2">{{ $value->deskripsi }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-2">Rp. {{ number_format($value->harga, 0, '.', '.') }}</p>
                                </td>
                                <td>
                                    <div style="display: flex">
                                        <a href="{{ route('admin.menu.edit', $value->id) }}"
                                            class="btn btn-md rounded-circle bg-light border">
                                            <i class="fa fa-edit text-success"></i>
                                        </a>
                                        <form action="{{ route('admin.menu.destroy', $value->id) }}" method="POST">
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
        </div>
    </div>
    <!-- Table Page End -->
@endsection
