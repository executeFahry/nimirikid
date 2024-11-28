@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">List Pelanggan Terdaftar</h3>
                        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-sm float-end">Tambah
                            Pelanggan</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 15px">#</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th style="max-width: 15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pelanggans as $pelanggan)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $pelanggan->nama_pelanggan }}</td>
                                        <td>{{ $pelanggan->alamat }}</td>
                                        <td>{{ $pelanggan->email }}</td>
                                        <td>{{ $pelanggan->no_hp }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('pelanggan.edit', $pelanggan->id_pelanggan) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <span class="mx-1"></span>
                                            <form action="{{ route('pelanggan.destroy', $pelanggan->id_pelanggan) }}"
                                                method="POST" class="d-inline">
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
