@extends('layouts.template')

@section('title')
    Registrasi
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Menu</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item active text-white">Registrasi</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h2 class="text-primary">Registrasi</h1>
                        </div>
                    </div>
                    <div class="col-lg-12" style="display: flex; justify-content: center;">
                        <div class="col-lg-4">
                            <form class="row login_form" action="{{ route('customer.buat_akun') }}" method="POST"
                                id="contactForm" novalidate="novalidate">
                                @csrf
                                <input type="email" class="w-100 form-control border-0 py-3 mb-4" placeholder="Email"
                                    name="email">
                                <input type="password" class="w-100 form-control border-0 py-3 mb-4" placeholder="Password"
                                    name="password">
                                <input type="text" class="w-100 form-control border-0 py-3 mb-4" placeholder="Nama"
                                    name="nama">
                                <input type="text" class="w-100 form-control border-0 py-3 mb-4" placeholder="No. HP"
                                    name="no_hp">

                                @include('layouts.error')

                                <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary "
                                    type="submit">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
