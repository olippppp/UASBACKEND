@extends('layouts.template')

@section('title')
    Ubah Kategori
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header admin py-5">
        <h1 class="text-center text-white display-6">Kategori</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item admin"><a href="{{ route('admin') }}">Beranda</a></li>
            <li class="breadcrumb-item admin"><a href="{{ route('admin.kategori') }}">Kategori</a></li>
            <li class="breadcrumb-item admin active text-white">Ubah Kategori</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Form Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Ubah Kategori</h1>
            <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row" style="margin-left: auto;
            margin-right: auto;">
                    <div class="col-md-7">
                        <div class="form-item">
                            <label class="form-label my-3">Nama<sup>*</sup></label>
                            <input type="text" class="form-control" name="nama" value="{{ $kategori->nama }}"
                                required>
                        </div>
                        <div class="form-item pt-4">
                            <button type="submit" class="btn btn-secondary text-white">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Form Page End -->
@endsection
