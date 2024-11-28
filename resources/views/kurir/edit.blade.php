@extends('layouts.app')

@section('title', 'Edit Data Kurir')

@section('content')
    <!--begin::Form Validation-->
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Form Edit Kurir</div>
        </div>
        <!--end::Header-->

        <!--begin::Form-->
        <form action="{{ route('kurir.update', $kurir->id_kurir) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Row-->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nama_kurir" class="form-label">Nama Kurir</label>
                        <input type="text" class="form-control" id="validationCustom01" name="nama_kurir"
                            value="{{ $kurir->nama_kurir }}" required>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <div class="col-md-6">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" class="form-control" id="validationCustom01" name="no_hp"
                            value="{{ $kurir->no_hp }}" required>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <div class="col-md-6">
                        <label for="area_pengiriman" class="form-label">Area Pengiriman</label>
                        <input type="text" class="form-control" id="validationCustom01" name="area_pengiriman"
                            value="{{ $kurir->area_pengiriman }}" required>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="validationCustom04" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif" @if ($kurir->status == 'Aktif') selected @endif>Aktif</option>
                            <option value="Tidak Aktif" @if ($kurir->status == 'Tidak Aktif') selected @endif>Tidak Aktif
                            </option>
                        </select>
                        <div class="invalid-feedback">Pilih Status</div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Body-->

                <!--begin::Footer-->
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Edit</button>
                    <a href="{{ route('kurir.index') }}" class="btn btn-secondary">Batal</a>
                </div>
                <!--end::Footer-->
        </form>
        <!--end::Form-->
        <!--begin::JavaScript-->
        <script>
            (() => {
                "use strict";

                const forms = document.querySelectorAll(".needs-validation");

                Array.from(forms).forEach((form) => {
                    form.addEventListener("submit", (event) => {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add("was-validated");
                    }, false);
                });
            })();
        </script>
        <!--end::JavaScript-->
    </div> <!--end::Form Validation-->
@endsection
