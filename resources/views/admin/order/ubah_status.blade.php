@extends('layouts.template')

@section('title')
    Detail Pesanan
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header admin py-5">
        <h1 class="text-center text-white display-6">Detail Pesanan</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item admin"><a href="{{ route('admin') }}">Beranda</a></li>
            <li class="breadcrumb-item admin"><a href="{{ route('admin.orders') }}">Daftar Pesanan</a></li>
            <li class="breadcrumb-item admin active text-white">Detail Pesanan</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Form Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Ubah Status Pesanan #{{ $order->no_order }}</h1>
            <form action="{{ route('admin.orders.ubah_status_process', $order->id) }}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row" style="margin-left: auto; margin-right: auto;">
                    <div class="col-md-7">
                        <div class="form-item">
                            <label class="form-label my-3">Nama Customer<sup>*</sup></label>
                            <input type="text" class="form-control" disabled name="nama"
                                value="{{ $order->customer->nama }}">
                        </div>
                        <div class="form-item pt-2">
                            <label for="status">Status</label>
                            <div>
                                <select name="status" class="form-control" required style="background-color: white">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($status_pemesanan as $key => $status)
                                        <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>
                                            {{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-item pt-4">
                            <button type="submit" class="btn btn-secondary text-white">Ubah Status</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Form Page End -->
@endsection
