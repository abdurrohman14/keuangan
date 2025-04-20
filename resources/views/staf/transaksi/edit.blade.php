@extends('partials.template.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Transaksi</div>
                        </div>
                        <form action="{{ route('staf.transaksi.update', $transaksi->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label for="largeInput">Tanggal Transaksi</label>
                                            <input type="date" class="form-control form-control" id="defaultInput"
                                                placeholder="" name="tanggal_transaksi"
                                                value="{{ $transaksi->tanggal_transaksi }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Nama Akun</label>
                                            <select class="form-select" id="exampleFormControlSelect1" name="akun_id">
                                                @foreach ($akun as $kode)
                                                    <option value="{{ $kode->id }}"
                                                        {{ $transaksi->akun_id == $kode->id ? 'selected' : '' }}>
                                                        {{ $kode->kode }} - {{ $kode->nama_akun }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Tipe Transaksi</label>
                                            <select class="form-select" id="exampleFormControlSelect1"
                                                name="tipe_transaksi">
                                                @foreach ($tipeTransaksi as $key => $jenisTransaksi)
                                                    <option value="{{ $jenisTransaksi }}"
                                                        {{ $transaksi->tipe_transaksi == $jenisTransaksi ? 'selected' : '' }}>
                                                        {{ $jenisTransaksi }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="largeInput">Rekening</label>
                                            <input type="text" class="form-control form-control" id="defaultInput"
                                                placeholder="" name="rekening" value="{{ $transaksi->rekening }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="comment">Keterangan</label>
                                            <textarea class="form-control" id="comment" name="keterangan" rows="5">{{ $transaksi->keterangan }}</textarea>
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="largeInput">Jumlah</label>
                                            <input type="number" class="form-control form-control" id="defaultInput"
                                                placeholder="" name="jumlah" value="{{ $transaksi->jumlah }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Simpan</button>
                                <button class="btn btn-danger"><a href="{{ route('staf.transaksi') }}"
                                        class="text-white">Kembali</a></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
