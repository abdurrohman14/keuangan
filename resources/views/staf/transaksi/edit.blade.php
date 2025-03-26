@extends('partials.template.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Transaksi</h3>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Tambah Transaksi</h4>
                                <button class="btn btn-primary btn-round ms-auto"><a href="{{ route('create.transaksi') }}">
                                        <i class="fa fa-plus"></i> Tambah Transaksi
                            </div>
                        </div>

                        <!-- card header -->
                        <form action="{{ route('update.transaksi', $akun->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                                    <input type="date"class="form-control form-control-sm" id="tanggal_transaksi"
                                        placeholder="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_akun">Nama Akun</label>
                                <select class="form-select form-control-sm" id="nama_akun">
                                    <option>101 - Kas</option>
                                    <option>102 - Piutang Usaha</option>
                                    <option>201 - Utang Usaha</option>
                                    <option>202 - Utang Bank</option>
                                    <option>301 - Modal Pemilik</option>
                                    <option>401 - Pendapatan jasa</option>
                                    <option>501 - Beban Gaji</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipe_transaksi">Tipe Transaksi</label>
                                <select class="form-select form-control-sm" id="tipe_transaksi">
                                    <option>Penerimaan</option>
                                    <option>Pengeluaran</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rekening">Rekening</label>
                                <select class="form-select form-control-sm" id="rekening">
                                    <option>BCA</option>
                                    <option>Mandiri</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control form-control-sm" id="keterangan"
                                    placeholder="keterangan" />
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" class="form-control form-control-sm" id="jumlah"
                                    placeholder="jumlah" />
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <button type="button" class="btn btn-danger"><a href="{{ setting - index }}"
                                class="text-decoration-none text-white"></a>Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
