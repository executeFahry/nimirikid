@extends('layouts.app')

@section('title', 'Edit Data Pelanggan')

@section('content')
    <!--begin::Form Validation-->
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Form Edit Pelanggan</div>
        </div>
        <!--end::Header-->

        <!--begin::Form-->
        <form action="{{ route('pelanggan.update', $pelanggan->id_pelanggan) }}" method="POST" class="needs-validation"
            novalidate>
            @csrf
            @method('PUT')
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Row-->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="validationCustom01" name="nama_pelanggan"
                            value="{{ $pelanggan->nama_pelanggan }}" required>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <div class="col-md-6">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="validationCustom01" name="alamat"
                            value="{{ $pelanggan->alamat }}" required>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="validationCustom01" name="email"
                            value="{{ $pelanggan->email }}" required>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <div class="col-md-6">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" class="form-control" id="validationCustom01" name="no_hp"
                            value="{{ $pelanggan->no_hp }}" required>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Body-->

            <!--begin::Footer-->
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Edit</button>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
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
