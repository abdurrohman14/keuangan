@extends('partials.template.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Buku Besar</h3>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Daftar Buku Besar</h4>
                                <button class="btn btn-primary btn-round ms-auto">
                                    <a href="" class="text-white">
                                        <i class="fa-solid fa-print"></i> Cetak
                                    </a>
                                </button>
                            </div>
                        </div>

                        <form action="{{ route('admin.buku') }}" method="GET">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="akun_id" class="fw-bold">Akun</label>
                                        <select name="akun_id" id="akun_id" class="form-control form-control-sm" onchange="this.form.submit()">
                                            <option value="">-- Semua Akun --</option>
                                            @foreach ($semuaAkun as $akun)
                                                <option value="{{ $akun->id }}" {{ request('akun_id') == $akun->id ? 'selected' : '' }}>
                                                    {{ $akun->kode }} - {{ $akun->nama_akun }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label for="tanggal_awal" class="fw-bold">Tanggal Awal</label>
                                        <input type="date" class="form-control form-control-sm" id="tanggal_awal"
                                            name="tanggal_awal" value="{{ request('tanggal_awal') }}"
                                            onchange="this.form.submit()" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-3">
                                        <label for="tanggal_akhir" class="fw-bold">Tanggal Akhir</label>
                                        <input type="date" class="form-control form-control-sm" id="tanggal_akhir"
                                            name="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                                            onchange="this.form.submit()" />
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
                                            <th>Keterangan</th>
                                            <th>Kode Akun</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                            <th>Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($buku as $key => $BukuBesar)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $BukuBesar->tanggal }}</td>
                                                <td>{{ $BukuBesar->keterangan }}</td>
                                                <td>{{ $BukuBesar->akun->kode }} - {{ $BukuBesar->akun->nama_akun }}</td>
                                                <td>{{ $BukuBesar->debit }}</td>
                                                <td>{{ $BukuBesar->kredit }}</td>
                                                <td>{{ $BukuBesar->saldo }}</td>
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
