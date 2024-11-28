@extends('layouts.app')

@section('title', 'Tambah Data Kurir')

@section('content')
    <!--begin::Form Validation-->
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Form Tambah Kurir</div>
        </div>
        <!--end::Header-->

        <!--begin::Form-->
        <form action="{{ route('kurir.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Row-->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nama_kurir" class="form-label">Nama Kurir</label>
                        <input type="text" class="form-control" id="validationCustom01" name="nama_kurir" required>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <div class="col-md-6">
                        <label for="no_hp" class="form-label">No. HP</label>
                        <input type="text" class="form-control" id="validationCustom01" name="no_hp" required>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <div class="col-md-6">
                        <label for="area_pengiriman" class="form-label">Area Pengiriman</label>
                        <input type="text" class="form-control" id="validationCustom01" name="area_pengiriman" required>
                        <div class="valid-feedback">Input Sesuai</div>
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="validationCustom04" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                        <div class="invalid-feedback">Pilih Status</div>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Body-->

            <!--begin::Footer-->
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Tambah</button>
                <a href="{{ route('kurir.index') }}" class="btn btn-secondary">Batal</a>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->

        <!--begin::JavaScript-->
        <script>
            (() => {
                "use strict";

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll(".needs-validation");

                // Loop over them and prevent submission
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
        <!--end::JavaScript-->
    </div> <!--end::Form Validation-->
@endsection
