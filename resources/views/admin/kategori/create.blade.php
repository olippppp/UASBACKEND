@extends('layouts.template')

@section('title')
    Tambah Kategori
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.kategori') }}">Kategori</a></li>
            <li class="breadcrumb-item active text-white">Tambah Kategori</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Form Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Tambah Kategori</h1>
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf
                <div class="row" style="margin-left: auto;
              margin-right: auto;">
                    <div class="col-md-7">
                        <div class="form-item">
                            <label class="form-label my-3">Nama<sup>*</sup></label>
                            <input type="text" class="form-control" required name="nama">
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
