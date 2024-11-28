@extends('layouts.app')

@section('title', 'Data Kurir')

@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">List Kurir Terdaftar</h3>
                        <a href="{{ route('kurir.create') }}" class="btn btn-primary btn-sm float-end">Tambah
                            Kurir</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 15px">#</th>
                                    <th>Nama kurir</th>
                                    <th>No. HP</th>
                                    <th>Area Pengiriman</th>
                                    <th>Status</th>
                                    <th style="max-width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($kurirs as $kurir)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $kurir->nama_kurir }}</td>
                                        <td>{{ $kurir->no_hp }}</td>
                                        <td>{{ $kurir->area_pengiriman }}</td>
                                        <td>{{ $kurir->status }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('kurir.edit', $kurir->id_kurir) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <span class="mx-1"></span>
                                            <form action="{{ route('kurir.destroy', $kurir->id_kurir) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="bi bi-x-square"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $kriterias->links('pagination::bootstrap-5') }}
                    </div> --}}
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
