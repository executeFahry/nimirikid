@extends('layouts.app')

@section('title', 'Data Status Pengiriman')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">List Status Pengiriman</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>Paket</th>
                                    <th>Status</th>
                                    <th>Waktu Status</th>
                                    <th>Catatan</th>
                                    @if (auth()->user()->isAdmin())
                                        <!-- Admin dapat melihat aksi -->
                                        <th style="max-width: 15%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statusPengiriman as $idPaket => $statuses)
                                    @php
                                        $latestStatus = $statuses->first(); // Status terbaru
                                    @endphp
                                    <!-- Baris Utama -->
                                    <tr data-bs-toggle="collapse" data-bs-target="#collapse-{{ $idPaket }}"
                                        class="cursor-pointer">
                                        <td class="text-center">{{ $idPaket }}</td>
                                        <td>{{ $latestStatus->status }}</td>
                                        <td class="text-center">{{ $latestStatus->waktu_status }}</td>
                                        <td>{{ $latestStatus->catatan }}</td>
                                        <td class="text-center">
                                            @if (auth()->user()->isAdmin())
                                                <a href="{{ route('status-pengiriman.edit', $latestStatus->id_status) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                {{-- <span class="mx-1"></span>
                                            <form
                                                action="{{ route('status-pengiriman.destroy', $latestStatus->id_status) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="bi bi-x-square"></i>
                                                </button>
                                            </form> --}}
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Riwayat Status (Collapse Rows) -->
                                    <tr class="collapse" id="collapse-{{ $idPaket }}">
                                        <td colspan="5">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Status</th>
                                                        <th>Waktu Status</th>
                                                        <th>Catatan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($statuses->slice(1) as $status)
                                                        <tr>
                                                            <td>{{ $status->status }}</td>
                                                            <td>{{ $status->waktu_status }}</td>
                                                            <td>{{ $status->catatan }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
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
