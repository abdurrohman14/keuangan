@extends('partials.template.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Jurnal Umum</h3>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Daftar Jurnal Umum</h4>
                            </div>
                        </div>

                        <form action="{{ route('admin.jurnal') }}" method="GET">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="tanggal_awal" class="fw-bold">Tanggal Awal</label>
                                        <input type="date" class="form-control form-control-sm" id="tanggal_awal"
                                            name="tanggal_awal" value="{{ request('tanggal_awal') }}"
                                            onchange="this.form.submit()" />
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                                            <th>Kode Akun</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jurnal as $key => $jU)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $jU->tanggal }}</td>
                                                <td>{{ $jU->akun->kode }} - {{ $jU->akun->nama_akun }}</td>
                                                <td>{{ $jU->debit }}</td>
                                                <td>{{ $jU->kredit }}</td>
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
