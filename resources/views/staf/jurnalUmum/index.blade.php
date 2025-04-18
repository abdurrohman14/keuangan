@extends('partials.template.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Junal Umum</h3>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Daftar Jurnal Umum</h4>
                                {{-- <button class="btn btn-primary btn-round ms-auto">
                                    <a href="" class="text-white">
                                        <i class="fa fa-plus"></i> Tambah Transaksi jurnal
                                    </a>
                                </button> --}}
                            </div>
                        </div>

                        {{-- <form id="filter-form" method="GET" action="{{ route('staf.jurnal.umum') }}">
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
                        </form> --}}

                        <!-- card header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Nama Akun</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                            <th>Status</th>
                                            {{-- <th>Aksi</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jurnalUmum as $key => $jU)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $jU->tanggal_transaksi }}</td>
                                                <td>{{ $jU->keterangan }}</td>
                                                <td>{{ $jU->akun->kode }} - {{ $jU->akun->nama_akun }}</td>
                                                <td>{{ $jU->status }}</td>
                                                {{-- <td><a href="{{ route('staf.jurnalUmum.edit', ['id' => $jurnalUmum->id]) }}"
                                                        class="btn btn-info btn-sm"><i
                                                            class="fas fa-pencil-alt"></i>Edit</a>
                                                    <form id="delete-form-{{ $jurnalUmum->id }}"
                                                        action="{{ route('staf.jurnalUmum.destroy', ['id' => $jurnalUmum->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="confirmDelete(event, {{ $jurnalUmum->id }})"
                                                            type="submit" class="btn btn-sm btn-danger"><i
                                                                class="fas fa-trash"></i>Hapus</button>
                                                    </form>
                                                </td> --}}
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
