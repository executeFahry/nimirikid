@extends('layouts.app')

@section('title', 'Data Paket')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">List Paket</h3>
                        @can('admin')
                            <a href="{{ route('paket.create') }}" class="btn btn-primary btn-sm float-end">Tambah
                                Paket</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 15px">#</th>
                                    <th>Pengirim</th>
                                    <th>Penerima</th>
                                    <th>Kurir</th>
                                    <th>Tanggal Pengiriman</th>
                                    <th>Status</th>
                                    <th style="max-width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pakets as $paket)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $paket->pengirim->nama_pelanggan }}</td>
                                        <td>{{ $paket->penerima->nama_pelanggan }}</td>
                                        <td>{{ $paket->kurir->nama_kurir }} ({{ $paket->kurir->getEmail() }})</td>
                                        <td class="text-center">{{ $paket->tanggal_pengiriman }}</td>
                                        <td class="text-center">{{ $paket->status }}</td>
                                        <td class="text-center">
                                            @can('admin')
                                                <a href="{{ route('paket.edit', $paket->id_paket) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <span class="mx-1"></span>
                                                <form action="{{ route('paket.destroy', $paket->id_paket) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <i class="bi bi-x-square"></i>
                                                    </button>
                                                </form>
                                            @elseif('kurir')
                                                <a href="{{ route('paket.edit', $paket->id_paket) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
