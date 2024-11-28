@extends('layouts.app')

@section('title', 'Edit Status Pengiriman')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Form Edit Status Pengiriman</div>
        </div>

        <form action="{{ route('status-pengiriman.update', $statusPengiriman->id_status) }}" method="POST"
            class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <!-- Input Hidden untuk id_paket -->
            <input type="hidden" name="id_paket" value="{{ $statusPengiriman->id_paket }}">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" id="validationCustom01" required>
                            <option value="Pending" {{ $statusPengiriman->status == 'Pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="Diambil" {{ $statusPengiriman->status == 'Diambil' ? 'selected' : '' }}>Diambil
                            </option>
                            <option value="Dalam Pengiriman"
                                {{ $statusPengiriman->status == 'Dalam Pengiriman' ? 'selected' : '' }}>Dalam Pengiriman
                            </option>
                            <option value="Terkirim" {{ $statusPengiriman->status == 'Terkirim' ? 'selected' : '' }}>
                                Terkirim</option>
                            <option value="Gagal" {{ $statusPengiriman->status == 'Gagal' ? 'selected' : '' }}>Gagal
                            </option>
                        </select>
                        </select>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <div class="col-md-3">
                        <label for="waktu_status" class="form-label">Waktu Status</label>
                        <input type="datetime-local" class="form-control" name="waktu_status"
                            value="{{ \Carbon\Carbon::parse($statusPengiriman->waktu_status)->format('Y-m-d\TH:i') }}"
                            required>
                        <div class="invalid-feedback">Waktu dan tanggal harus di-input dengan benar!</div>
                    </div>
                    <div class="col-md-6">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" name="catatan" rows="3">{{ $statusPengiriman->catatan }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Edit</button>
                <a href="{{ route('status-pengiriman.index') }}" class="btn btn-secondary">Batal</a>
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
