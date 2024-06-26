@extends('layouts.template')

@section('title')
    Daftar Kategori
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Kategori</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Beranda</a></li>
            <li class="breadcrumb-item active text-white">Kategori</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Table Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <a href="{{ route('admin.kategori.create') }}"
                class="btn border border-info rounded-pill px-4 py-2 mb-4 text-info"><i
                    class="fa fa-plus me-2 text-info"></i> Tambah Data</a>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col" style="width: 150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $value)
                            <tr>
                                <th scope="row">
                                    <p class="mb-0 mt-2">{{ $value->id }}</p>
                                </th>
                                <td>
                                    <p class="mb-0 mt-2">{{ $value->nama }}</p>
                                </td>
                                <td>
                                    <div style="display: flex">
                                        <a href="{{ route('admin.kategori.edit', $value->id) }}"
                                            class="btn btn-md rounded-circle bg-light border">
                                            <i class="fa fa-edit text-success"></i>
                                        </a>
                                        <form action="{{ route('admin.kategori.destroy', $value->id) }}" method="POST">
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
