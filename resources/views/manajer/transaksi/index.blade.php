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
                        </div>
                    </div>

                    <!-- Kolom Tanggal Transaksi -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="tanggal_transaksi" class="fw-bold">Tanggal Transaksi</label>
                                <input type="date" class="form-control form-control-sm" id="tanggal_transaksi" placeholder=""/>
                            </div>
                        </div>
                    
                        <!-- Kolom Tipe Transaksi -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1" class="fw-bold">Tipe Transaksi</label>
                                <select class="form-select" id="exampleFormControlSelect1" name="tipe_transaksi">
                                    @foreach ($tipeTransaksi as $jenisTransaksi)
                                        <option value="{{ $jenisTransaksi }}">{{ $jenisTransaksi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
        
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