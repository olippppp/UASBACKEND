@extends('layouts.template')

@section('title')
    Daftar Customer
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header admin py-5">
        <h1 class="text-center text-white display-6">Customer</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item admin"><a href="{{ route('admin') }}">Beranda</a></li>
            <li class="breadcrumb-item admin active text-white">Customer</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Table Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div style="display: flex; justify-content: space-between;">
                <a href="{{ route('admin.customer.create') }}"
                    class="btn border border-info rounded-pill px-4 py-2 mb-4 text-info"><i
                        class="fa fa-plus me-2 text-info"></i> Tambah Data</a>


                <div class="col-xl-3">
                    <form id="search-form" action="{{ route('admin.customer') }}" method="GET">
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" class="form-control p-2" placeholder="cari nama atau email"
                                aria-describedby="search-icon-1" style="padding-left: 10px" name="cari"
                                value={{ request()->input('cari') ?? '' }}>

                            <span id="search-icon-1" class="input-group-text p-2" onclick="this.form.submit()"><i
                                    class="fa fa-search"></i></span>
                        </div>
                    </form>
                </div>

            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">No. HP</th>
                            <th scope="col" style="width: 150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer as $value)
                            <tr>
                                <th scope="row">
                                    <p class="mb-0 mt-2">{{ $value->id }}</p>
                                </th>
                                <td>
                                    <p class="mb-0 mt-2">{{ $value->nama }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-2">{{ $value->email }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-2">{{ $value->no_hp }}</p>
                                </td>
                                <td>
                                    <div style="display: flex">
                                        <a href="{{ route('admin.customer.edit', $value->id) }}"
                                            class="btn btn-md rounded-circle bg-light border">
                                            <i class="fa fa-edit text-success"></i>
                                        </a>
                                        <form action="{{ route('admin.customer.destroy', $value->id) }}" method="POST">
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
            <!-- Pagination Links -->
            <div style="display: flex; margin-top: 20px;">
                <div class="pagination admin" style="margin-left: auto">
                    @if ($customer->onFirstPage())
                    @else
                        <a href="{{ $customer->appends(request()->query())->previousPageUrl() }}" class="prev-arrow rounded"><i
                                class="bi bi-arrow-left" aria-hidden="true"></i></a>
                    @endif

                    @foreach ($customer->getUrlRange(1, $customer->lastPage()) as $page => $url)
                        @if ($page == $customer->currentPage())
                            <a href="{{ $customer->appends(request()->query())->url($page) }}"
                                class="active rounded">{{ $page }}</a>
                        @else
                            <a href="{{ $customer->appends(request()->query())->url($page) }}" class="rounded">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($customer->hasMorePages())
                        <a href="{{ $customer->appends(request()->query())->nextPageUrl() }}" class="next-arrow rounded"><i
                                class="bi bi-arrow-right" aria-hidden="true"></i></a>
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Assuming you have jQuery available, you can use it for simplicity
            $('#search-icon-1').click(function() {
                $('#search-form').submit();
            });
        });
    </script>
    <!-- Table Page End -->
@endsection
