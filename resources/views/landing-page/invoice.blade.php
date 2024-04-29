@extends('landing-page.main')

@push("title", "Invoice " . $invoice["invoiceId"])

@push('content-page')

<div class="container mt-4 mb-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white fw-bold">
            Nomor Transaksi : {{ $invoice["invoiceId"] }}
        </div>
        <div class="card-body">
            <img src="{{ URL::asset('assets/images/brand/logo1.png') }}" alt="Image Logo" style="width: 300px; height: auto">
            <table class="mt-3 mb-3">
                <tbody>
                    <tr>
                        <td style="width: 150px;">Kasir</td>
                        <td style="width: 20px">:</td>
                        <td>
                            <strong>
                                {{ $invoice['users']['nama'] }}
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Nama Customer</td>
                        <td style="width: 20px">:</td>
                        <td>
                            <strong>
                                {{ $invoice['namaUser'] }}
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Nomor HP</td>
                        <td style="width: 20px">:</td>
                        <td>
                            <strong>
                                {{ $invoice['nomorHpAktif'] == null ? '-' : $invoice['nomorHpAktif'] }}
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Total Harga</td>
                        <td style="width: 20px">:</td>
                        <td>
                            <strong>
                                Rp. {{ number_format($invoice["totalHarga"]) }}
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 150px;">Status Transaksi</td>
                        <td style="width: 20px">:</td>
                        <td>
                            @if ($invoice["statusOrder"] == "PAID" || $invoice["statusOrder"] == "SETTLED")
                                <span class="badge bg-success">
                                    <i class="fa fa-check"></i> Sudah Bayar
                                </span>
                            @elseif($invoice["statusOrder"] == "UNPAID")
                                <span class="badge bg-danger">
                                    <i class="fa fa-times"></i> Belum Bayar
                                </span>
                            @endif
                        </td>
                    </tr>
                    @if ($invoice["tipeTransaksi"] != null)

                        <tr>
                            <td style="width: 150px;">Tipe Transaksi</td>
                            <td style="width: 20px">:</td>
                            <td>
                                <span class="fw-bold">
                                    {{ $invoice["tipeTransaksi"] }}
                                </span>
                            </td>
                        </tr>

                        @if (!empty($invoice["paymentChannel"]))
                            <tr>
                                <td style="width: 150px;">Payment Channel</td>
                                <td style="width: 20px">:</td>
                                <td>
                                    <span class="fw-bold">
                                        {{ $invoice["paymentChannel"] }}
                                    </span>
                                </td>
                            </tr>
                        @endif
                    @endif
                </tbody>
            </table>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Nama</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">QTY</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomor = 0;
                        $jumlahhQty = 0;
                    @endphp
                    @foreach ($transaksiDetail as $item)
                        <tr>
                            <td class="text-center">{{ ++$nomor }}.</td>
                            <td>{{ $item["namaProduk"] }}</td>
                            <td class="text-center">Rp. {{ number_format($item["hargaProduk"]) }}</td>
                            <td class="text-center">{{ $item["qtyProduk"] }}</td>
                        </tr>

                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-center fw-bold">Total Harga : </td>
                        <td class="text-center fw-bold">
                            Rp. {{ number_format($invoice["totalHarga"]) }}
                        </td>
                        <td class="text-center fw-bold">{{ $jumlahhQty }}</td>
                    </tr>
                </tfoot>
            </table>

            @if ($invoice["statusOrder"] == "UNPAID")
                <p class="fw-bold">
                    Pilih Metode Pembayaran :
                </p>
                <button class="btn btn-primary shadow mb-2">
                    <i class="fa fa-edit"></i> Cash
                </button>
                <a href="{{ config('xendit.url') }}{{ $invoice['xenditId'] }}" target="_blank" class="btn btn-success shadow mb-2">
                    <i class="fa fa-book"></i> Transfer
                </a>
            @elseif($invoice["statusOrder"] == "PAID" || $invoice["statusOrder"] == "SETTLED")
                <div class="alert alert-success">
                    <div class="text-center">
                        Sudah Melakukan Pembayaran, Eksternal ID : <b>{{ $invoice["xenditId"] }}</b>
                    </div>
                </div>
            @else

            @endif
        </div>
    </div>
</div>

@endpush
