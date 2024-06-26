@extends('layouts.template')

@section('title')
    Detail Pesanan
@endsection

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Detail Pesanan</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item active text-white">Detail Pesanan</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <style>
        .detail-order-table tr td {
            padding: 5px 10px;
        }
    </style>
    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Detail Pemesanan #{{ $order->no_order }}</h1>
            <div class="row g-5">
                <div class="col-md-12 col-lg-5">
                    <table class="detail-order-table">
                        <tbody>
                            <tr>
                                <td>No. Meja</td>
                                <td>:</td>
                                <td>{{ $order->meja->kode }} ({{ $order->meja ? $order->meja->no_meja : '' }})</td>
                            </tr>

                            <tr>
                                <td>Nama Customer</td>
                                <td>:</td>
                                <td>{{ $order->customer->nama }}</td>
                            </tr>

                            <tr>
                                <td>Tanggal Pemesanan</td>
                                <td>:</td>
                                <td>{{ \Carbon\Carbon::parse($order->tgl_pemesanan)->format('d/m/Y H:i:s') }}</td>
                            </tr>

                            <tr>
                                <td>Tanggal Pembayaran</td>
                                <td>:</td>
                                <td>{{ $order->tgl_pembayaran && $order->status == 2 ? \Carbon\Carbon::parse($order->tgl_pembayaran)->format('d/m/Y H:i:s') : '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td>Status Pemesanan</td>
                                <td>:</td>
                                <td style="font-weight: 600; color: {{ $order->status == 2 ? '#21af00' : '#ff7800' }}">
                                    {{ $order->status == 2 ? 'Selesai' : 'Sedang Diproses' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>


                @php
                    $total = 0;
                @endphp

                <div class="col-md-12 col-lg-7">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $orderItem)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center mt-2">
                                                <img src="data:image/jpeg;base64,{{ stream_get_contents($orderItem->menu->foto) }}"
                                                    class="img-fluid rounded-circle" style="width: 90px; height: 90px;"
                                                    alt="">
                                            </div>
                                        </th>
                                        <td class="py-5">{{ $orderItem->menu->nama }}</td>
                                        <td class="py-5">Rp. {{ number_format($orderItem->harga, 0, '.', '.') }}</td>
                                        <td class="py-5">{{ $orderItem->jumlah }}</td>
                                        <td class="py-5">Rp.
                                            {{ number_format($orderItem->jumlah * $orderItem->harga, 0, '.', '.') }}</td>

                                        @php $total = $orderItem->jumlah * $orderItem->harga; @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">Rp. {{ number_format($total, 0, '.', '.') }}</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout Page End -->
@endsection
