@extends('layouts.template')

@section('title')
    Home
@endsection

@section('content')
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-3">
                    {{-- <h1 class="mb-5 display-3 text-primary"
                        style="padding: 10px 35px;
                    color: #fef1de !important;
                    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
                }">
                        Selamat datang di Halaman Admin</h1> --}}
                </div>
                <div class="col-md-12 col-lg-9">
                    <h1 class="mb-5 display-3 text-primary"
                        style="padding: 10px 35px;
              color: #fef1de !important; text-align: right;
              box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
          }">
                        Selamat datang di Halaman Admin</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
@endsection
