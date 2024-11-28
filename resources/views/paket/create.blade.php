@extends('layouts.app')

@section('title', 'Tambah Data Paket')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Form Tambah Paket</div>
        </div>

        <form action="{{ route('paket.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="id_pengirim" class="form-label">Pengirim</label>
                        <select class="form-control" name="id_pengirim" required>
                            <option value="">Pilih Pengirim</option>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->nama_pelanggan }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Pengirim harus dipilih.</div>
                    </div>
                    <div class="col-md-6">
                        <label for="id_penerima" class="form-label">Penerima</label>
                        <select class="form-control" name="id_penerima" required>
                            <option value="">Pilih Penerima</option>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->nama_pelanggan }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Penerima harus dipilih.</div>
                    </div>
                    <div class="col-md-3">
                        <label for="id_kurir" class="form-label">Kurir</label>
                        <select class="form-control" name="id_kurir" required>
                            <option value="">Pilih Kurir</option>
                            @foreach ($kurirs as $kurir)
                                <option value="{{ $kurir->id_kurir }}">{{ $kurir->nama_kurir }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Kurir harus dipilih!</div>
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" id="validationCustom01" required>
                            <option value="Pending">Pending</option>
                            <option value="Diambil">Diambil</option>
                            <option value="Dalam Pengiriman">Dalam Pengiriman</option>
                            <option value="Terkirim">Terkirim</option>
                            <option value="Gagal">Gagal</option>
                        </select>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_pengiriman" class="form-label">Tanggal Pengiriman</label>
                        <input type="date" class="form-control" name="tanggal_pengiriman" id="validationCustom01"
                            required>
                        <div class="invalid-feedback">Tanggal harus di-input dengan benar!</div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Tambah</button>
                <a href="{{ route('paket.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>

        <script>
            (() => {
                "use strict";

                const forms = document.querySelectorAll(".needs-validation");

                Array.from(forms).forEach((form) => {
                    form.addEventListener(
                        "submit",
                        (event) => {
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add("was-validated");
                        },
                        false
                    );
                });
            })();
        </script>
    </div>
@endsection
