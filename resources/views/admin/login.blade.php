@extends('layouts.template')

@section('title')
    Login Admin
@endsection

@section('content')
    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-md-12" style="font-size: 17px;">
                        <a href="{{ route('beranda') }}" class="text-info"><i class="fa fa-arrow-left me-2"></i> Kembali ke
                            halaman
                            customer</a>
                    </div>
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h2 class="text-primary">LOGIN ADMIN</h1>
                        </div>
                    </div>
                    <div class="col-lg-12" style="display: flex; justify-content: center;">
                        <div class="col-lg-4">
                            <form class="row login_form" action="{{ route('admin.authenticate') }}" method="POST"
                                id="contactForm" novalidate="novalidate">
                                @csrf
                                <input type="email" class="w-100 form-control border-0 py-3 mb-4" placeholder="Email"
                                    name="email">
                                <input type="password" class="w-100 form-control border-0 py-3 mb-4" placeholder="Password"
                                    name="password">

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
