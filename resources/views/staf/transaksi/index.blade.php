@extends('partials.template.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Transaksi</h3>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Daftar Transaksi</h4>
                                <button class="btn btn-primary btn-round ms-auto"><a
                                        href="{{ route('staf.transaksi.create') }}" class="text-white">
                                        <i class="fa fa-plus"></i> Tambah Transaksi
                                </button>
                            </div>
                        </div>

                        <form id="filter-form" method="GET" action="{{ route('admin.transaksi') }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="tanggal_transaksi" class="fw-bold">Tanggal Transaksi</label>
                                        <input type="date" class="form-control form-control-sm" id="tanggal_transaksi"
                                            name="tanggal_transaksi" value="{{ request('tanggal_transaksi') }}"
                                            onchange="this.form.submit()" />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tipe_transaksi" class="fw-bold">Tipe Transaksi</label>
                                        <select class="form-select" id="tipe_transaksi" name="tipe_transaksi"
                                            onchange="this.form.submit()">
                                            <option value="">Semua</option>
                                            @foreach ($tipeTransaksi as $jenisTransaksi)
                                                <option value="{{ $jenisTransaksi }}"
                                                    {{ request('tipe_transaksi') == $jenisTransaksi ? 'selected' : '' }}>
                                                    {{ $jenisTransaksi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- card header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Kode Akun</th>
                                            <th>Keterangan</th>
                                            <th>Rekening</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transksi as $key => $transaksis)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $transaksis->tanggal_transaksi }}</td>
                                                <td>{{ $transaksis->akun->kode }} - {{ $transaksis->akun->nama_akun }}</td>
                                                <td>{{ $transaksis->keterangan }}</td>
                                                <td>{{ $transaksis->rekening }}</td>
                                                <td>{{ $transaksis->jumlah }}</td>
                                                <td><a href="{{ route('staf.transaksi.edit', ['id' => $transaksis->id]) }}"
                                                        class="btn btn-info btn-sm"><i
                                                            class="fas fa-pencil-alt"></i>Edit</a>
                                                    <form id="delete-form-{{ $transaksis->id }}"
                                                        action="{{ route('admin.transaksi.delete', ['id' => $transaksis->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="confirmDelete(event, {{ $transaksis->id }})"
                                                            type="submit" class="btn btn-sm btn-danger"><i
                                                                class="fas fa-trash"></i>Hapus</button>
                                                    </form>
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
        </div>
    </div>
@endsection
