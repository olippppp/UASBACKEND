@extends('layouts.template')

@section('title')
    Ubah Customer
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header admin py-5">
        <h1 class="text-center text-white display-6">Customer</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item admin"><a href="{{ route('admin') }}">Beranda</a></li>
            <li class="breadcrumb-item admin"><a href="{{ route('admin.customer') }}">Customer</a></li>
            <li class="breadcrumb-item admin active text-white">Ubah Customer</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Form Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Ubah Customer</h1>
            <form action="{{ route('admin.customer.update', $customer->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row" style="margin-left: auto;
            margin-right: auto;">
                    <div class="col-md-7">
                        <div class="form-item">
                            <label class="form-label my-3">Nama<sup>*</sup></label>
                            <input type="text" class="form-control" name="nama" value="{{ $customer->nama }}" required>
                        </div>
                        <div class="form-item pt-2">
                            <label class="form-label my-3">Email<sup>*</sup></label>
                            <input type="email" class="form-control" name="email" value="{{ $customer->email }}" required>
                        </div>
                        <div class="form-item pt-2">
                            <label class="form-label my-3">Password<sup>*</sup></label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-item pt-2">
                            <label class="form-label my-3">No HP<sup>*</sup></label>
                            <input type="text" class="form-control" name="no_hp" value="{{ $customer->no_hp }}" required>
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
