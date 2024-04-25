@extends('landing-page.main')

@push('content-page')

<div class="container mt-4 mb-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white fw-bold">
            Nomor Transaksi : {{ $invoice["invoiceId"] }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <span class="fw-bold">
                        <i class="fa fa-user"></i> Data Pelanggan
                    </span>
                    <br>
                    <div class="row">
                        <div class="col-md-3">Nama :</div>
                        <div class="col-md-6">
                            {{ $invoice["namaUser"] }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3"></div>
            </div>
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
        </div>
    </div>
</div>

@endpush
