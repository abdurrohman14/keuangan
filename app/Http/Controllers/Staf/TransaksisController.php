<?php

namespace App\Http\Controllers\Staf;

use App\Models\Akun;
use App\Models\Transaksi;
use App\Models\jurnalUmum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransaksisController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal_transaksi');
        $tipeTransaksi = $request->input('tipe_transaksi');

        $query = Transaksi::query();

        if ($tanggal) {
            $query->whereDate('tanggal_transaksi', $tanggal);
        }

        if ($tipeTransaksi) {
            $query->where('tipe_transaksi', $tipeTransaksi);
        }

        $transaksis = $query->orderBy('tanggal_transaksi', 'desc')->get();
        $tipeTransaksiOptions = ['Penerimaan', 'Pengeluaran'];

        return view('staf.transaksi.index', [
            'title' => 'transaksi',
            'transaksi' => $transaksis,
            'tipeTransaksi' => $tipeTransaksiOptions,
        ]);
    }

    public function create()
    {
        $akun = Akun::all();
        $tipeTransaksi = ['Penerimaan', 'Pengeluaran'];
            return view('staf.transaksi.create',[
                'title' => 'Tambah Transaksi',
                'akun' => $akun,
                'tipeTransaksi' => $tipeTransaksi
            ]);
    }

    public function store(Request $request)
    {
       try{
        $request->validate([
            'akun_id' => 'required|exists:akuns,id',
            'tanggal_transaksi' => 'required|date',
            'tipe_transaksi' => 'required|in:Pemasukan,Pengeluaran',
            'rekening' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $transaksi = Transaksi::create([
            'akun_id' => $request->akun_id,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'tipe_transaksi' => $request->tipe_transaksi,
            'rekening' => $request->rekening,
            'keterangan' => $request->keterangan ?? null, 
            'jumlah' => $request->jumlah,
            'status' => 'draf',
        ]);

         // Simpan jurnal umum, nilai debit/kredit tergantung tipe_transaksi
         $debit = $request->tipe_transaksi == 'Penerimaan' ? $request->jumlah : 0;
         $kredit = $request->tipe_transaksi == 'Pengeluaran' ? $request->jumlah : 0;

         if ($transaksi->status === 'selesai') {
             jurnalUmum::create([
                 'akun_id' => $request->akun_id,
                 'transaksi_id' => $transaksi->id,
                 'tanggal' => $request->tanggal_transaksi,
                 'debit' => $debit,
                 'kredit' => $kredit,
                 'keterangan' => $request->keterangan,
             ]);
         }

        return redirect()->route('staf.transaksi')->with('success', 'Data berhasil disimpan!');
    } catch (\Throwable $e) {  
        return redirect()->route('staf.transaksi')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        } 
    }

    public function edit($id)
    {
        $akun = Akun::all();
        $transaksi = Transaksi::find($id);
        $tipeTransaksi = ['Penerimaan', 'Pengeluaran'];
        return view('staf.transaksi.edit', [
            'title' => 'Edit Transaksi',
            'akun' => $akun,
            'transaksi' => $transaksi,
            'tipeTransaksi' => $tipeTransaksi,
        ]);
    }

    public function update(Request $request, $id)
    {
       try {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'tipe_transaksi' => 'required|in:penerimaan,pengeluaran',
            'rekening' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $transaksi = Transaksi::find($id);
            $transaksi->update([
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'tipe_transaksi' => $request->tipe_transaksi,
                'rekening' => $request->rekening,
                'keterangan' => $request->keterangan ?? null,
                'jumlah' => $request->jumlah,
            ]);
            return redirect()->route('staf.transaksi')->with('success', 'Transaksi Berhasil Diubah');
        } catch (\Throwable $e) {
            return redirect()->route('staf.transaksi')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $transaksi = Transaksi::find($id);
            // if (!$transaksi) {
            //     return redirect()->route('index.transaksi')->with('error','transaksi tidak ditemukan');
            // }

            $transaksi->delete();
            return redirect()->route('staf.transaksi')->with('success','transaksi berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('staf.transaksi')->with('error','Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
