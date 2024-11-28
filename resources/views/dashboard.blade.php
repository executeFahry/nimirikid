@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        @if ($role === 'admin')
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h3>{{ $pelanggans }}</h3>
                        <p>Pelanggan Terdaftar</p>
                    </div>
                    <div class="icon">
                        <svg class="small-box-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 2.02 1.97 3.45v2h6v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>
                    <a href="{{ route('pelanggan.index') }}"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Lebih Lanjut <i class="bi bi-link-45deg"></i> </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-danger">
                    <div class="inner">
                        <h3>{{ $kurirs }}</h3>
                        <p>Kurir Terdaftar</p>
                    </div>
                    <div class="icon">
                        <svg class="small-box-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>
                    <a href="{{ route('kurir.index') }}"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Lebih Lanjut <i class="bi bi-link-45deg"></i> </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $paketsNotDelivered }}</h3>
                        <p>Paket Belum Terkirim</p>
                    </div>
                    <div class="icon">
                        <svg class="small-box-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M21 8.5l-9-4.5-9 4.5v7l9 4.5 9-4.5v-7zm-9-3.5l7.5 3.75-7.5 3.75-7.5-3.75 7.5-3.75zm-8 5.25l7.5 3.75v7.5l-7.5-3.75v-7.5zm9 11.25v-7.5l7.5-3.75v7.5l-7.5 3.75z" />
                        </svg>
                    </div>
                    <a href="{{ route('paket.index') }}"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Lebih Lanjut <i class="bi bi-link-45deg"></i> </a>
                </div>
            </div>
        @elseif ($role === 'kurir')
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $paketsForKurir }}</h3>
                        <p>Paket Belum Dikirim</p>
                    </div>
                    <div class="icon">
                        <svg class="small-box-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M21 8.5l-9-4.5-9 4.5v7l9 4.5 9-4.5v-7zm-9-3.5l7.5 3.75-7.5 3.75-7.5-3.75 7.5-3.75zm-8 5.25l7.5 3.75v7.5l-7.5-3.75v-7.5zm9 11.25v-7.5l7.5-3.75v7.5l-7.5 3.75z" />
                        </svg>
                    </div>
                    <a href="{{ route('paket.kurir') }}"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Lebih Lanjut <i class="bi bi-link-45deg"></i> </a>
                </div>
            </div>
        @elseif ($role === 'pelanggan')
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $paketsForPelanggan }}</h3>
                        <p>Paket Belum Diterima</p>
                    </div>
                    <div class="icon">
                        <svg class="small-box-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M21 8.5l-9-4.5-9 4.5v7l9 4.5 9-4.5v-7zm-9-3.5l7.5 3.75-7.5 3.75-7.5-3.75 7.5-3.75zm-8 5.25l7.5 3.75v7.5l-7.5-3.75v-7.5zm9 11.25v-7.5l7.5-3.75v7.5l-7.5 3.75z" />
                        </svg>
                    </div>
                    <a href="{{ route('status-pengiriman.index') }}"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Lihat Status Pengiriman <i class="bi bi-link-45deg"></i> </a>
                </div>
            </div>
        @endif
    </div>
@endsection
