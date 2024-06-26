@extends('layouts.template')

@section('title')
    Ubah Nomor Meja
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header admin py-5">
        <h1 class="text-center text-white display-6">Nomor Meja</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item admin"><a href="{{ route('admin') }}">Beranda</a></li>
            <li class="breadcrumb-item admin"><a href="{{ route('admin.meja') }}">Nomor Meja</a></li>
            <li class="breadcrumb-item admin active text-white">Ubah Nomor Meja</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Form Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Ubah Nomor Meja</h1>
            <form action="{{ route('admin.meja.update', $meja->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row" style="margin-left: auto;
            margin-right: auto;">
                    <div class="col-md-7">
                        <div class="form-item pt-2">
                            <label class="form-label my-3">Kode<sup>*</sup></label>
                            <input type="text" class="form-control" name="kode" value="{{ $meja->kode }}" readonly>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Nomor Meja<sup>*</sup></label>
                            <input type="text" class="form-control" name="no_meja" value="{{ $meja->no_meja }}" required>
                        </div>
                        <div class="form-item pt-4">
                            @include('layouts.error')
                            <button type="submit" class="btn btn-secondary text-white">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Form Page End -->
@endsection
