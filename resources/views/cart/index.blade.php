@extends('layouts.template')

@section('title')
    Cart
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <!-- Cart Page Start -->

    @php
        $total = 0;
    @endphp

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Menu</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart->orderItems as $orderItem)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="data:image/jpeg;base64,{{ stream_get_contents($orderItem->menu->foto) }}"
                                            class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                            alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $orderItem->menu->nama }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">Rp. {{ number_format($orderItem->harga, 0, '.', '.') }}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <a href="{{ route('cart.order_item.kurang', $orderItem->id) }}"
                                                class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                <i class="fa fa-minus"></i>
                                            </a>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0"
                                            value="{{ $orderItem->jumlah }}">
                                        <div class="input-group-btn">
                                            <a href="{{ route('cart.order_item.tambah', $orderItem->id) }}"
                                                class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">Rp.
                                        {{ number_format($orderItem->jumlah * $orderItem->harga, 0, '.', '.') }}</p>

                                    @php $total = $orderItem->jumlah * $orderItem->harga; @endphp
                                </td>
                                <td>
                                    <a href="{{ route('cart.order_item.hapus', $orderItem->id) }}"
                                        class="btn btn-md rounded-circle bg-light border mt-4"
                                        onclick="return confirm('Apakah anda ingin menghapus makanan ini dari keranjang?')">
                                        <i class="fa fa-times text-danger"></i>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($total > 0)
                <form method="POST" action="{{ route('cart.pesan') }}">
                    @csrf
                    <div class="row g-4 justify-content-end mt-2">
                        <input type="hidden" value="{{ $cart->id }}">
                        <div class="col-8"></div>
                        <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                            <div class="bg-light rounded">
                                <div class="p-4">
                                    <h1 class="display-6 mb-4" style="font-size: 30px;">Total <span
                                            class="fw-normal">Pesanan</span>
                                    </h1>
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="mb-0 me-4">Total:</h5>
                                        <p class="mb-0">Rp. {{ number_format($total, 0, '.', '.') }}</p>
                                    </div>

                                    <div class="d-flex justify-content-between mb-4" style="align-items: center">
                                        <h5 class="mb-0 me-4">Kode Meja:</h5>
                                        <p class="mb-0"> <input type="text" name="kode"
                                                class="border-0 border-bottom rounded py-2"
                                                style="padding-left: 10px;  padding-right: 10px; text-align: right; max-width: 150px; letter-spacing: 3.5px"
                                                placeholder="******" name="kode" required></p>
                                    </div>

                                    @include('layouts.error')
                                </div>

                                <button
                                    class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                                    type="submit">Pesan Makanan</button>
                            </div>

                        </div>

                    </div>
                </form>
            @else
                <div style="text-align: center">
                    Belum ada pesanan <br>
                    Silahkan pilih menu <a href="{{ route('menu_kategori') }}">disini</a>
                </div>
            @endif
        </div>
    </div>
    <!-- Cart Page End -->
@endsection
