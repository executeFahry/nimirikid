@extends('layouts.app')

@section('title', 'Edit Data Paket')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Form Edit Paket</div>
        </div>

        <form action="{{ route('paket.update', $paket->id_paket) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="id_pengirim" class="form-label">Pengirim</label>
                        <select class="form-control" name="id_pengirim" required
                            @if (auth()->user()->isKurir()) disabled @endif>
                            <option>Pilih Pengirim</option>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id_pelanggan }}"
                                    {{ $paket->id_pengirim == $pelanggan->id_pelanggan ? 'selected' : '' }}>
                                    {{ $pelanggan->nama_pelanggan }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Pengirim harus dipilih!</div>
                    </div>
                    <div class="col-md-6">
                        <label for="id_penerima" class="form-label">Penerima</label>
                        <select class="form-control" name="id_penerima" required
                            @if (auth()->user()->isKurir()) disabled @endif>
                            <option>Pilih Penerima</option>
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id_pelanggan }}"
                                    {{ $paket->id_penerima == $pelanggan->id_pelanggan ? 'selected' : '' }}>
                                    {{ $pelanggan->nama_pelanggan }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Penerima harus dipilih!</div>
                    </div>
                    <div class="col-md-3">
                        <label for="id_kurir" class="form-label">Kurir</label>
                        <select class="form-control" name="id_kurir" required
                            @if (auth()->user()->isKurir()) disabled @endif>
                            <option>Pilih Kurir</option>
                            @foreach ($kurirs as $kurir)
                                <option value="{{ $kurir->id_kurir }}"
                                    {{ $paket->id_kurir == $kurir->id_kurir ? 'selected' : '' }}>
                                    {{ $kurir->nama_kurir }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Kurir harus dipilih!</div>
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" id="validationCustom01" required>
                            <option value="Pending" {{ $paket->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Diambil" {{ $paket->status == 'Diambil' ? 'selected' : '' }}>Diambil</option>
                            <option value="Dalam Pengiriman" {{ $paket->status == 'Dalam Pengiriman' ? 'selected' : '' }}>
                                Dalam Pengiriman</option>
                            <option value="Terkirim" {{ $paket->status == 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
                            <option value="Gagal" {{ $paket->status == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                        </select>
                        </select>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_pengiriman" class="form-label">Tanggal Pengiriman</label>
                        <input type="date" class="form-control" name="tanggal_pengiriman"
                            value="{{ $paket->tanggal_pengiriman }}" required>
                        <div class="invalid-feedback">Tanggal harus di-input dengan benar!</div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Edit</button>
                <a href="{{ auth()->user()->isKurir() ? route('paket.kurir') : route('paket.index') }}"
                    class="btn btn-secondary">Batal</a>
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
