<?php

namespace App\Http\Controllers\Admin;

use App\Models\Akun;
use App\Models\Transaksi;
use App\Models\jurnalUmum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
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
        $kasBankOptions = ['Kas', 'Bank BCA', 'Bank Mandiri'];

        return view('admin.transaksi.index', [
            'title' => 'transaksi',
            'transaksi' => $transaksis,
            'tipeTransaksi' => $tipeTransaksiOptions,
            'kasBank' => $kasBankOptions,
        ]);
    }

    public function create()
    {
        $akun = Akun::all();
        $tipeTransaksi = ['Penerimaan', 'Pengeluaran'];
        $kasBank = ['Kas', 'Bank BCA', 'Bank Mandiri'];
        return view('admin.transaksi.create', [
            'title' => 'Tambah Transaksi',
            'akun' => $akun,
            'tipeTransaksi' => $tipeTransaksi,
            'kasBank' => $kasBank,
        ]);

    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'akun_id' => 'required|exists:akuns,id',
                'tanggal_transaksi' => 'required|date',
                'tipe_transaksi' => 'required|in:Penerimaan,Pengeluaran',
                'kas_bank' => 'required|string|max:255',
                'keterangan' => 'required|string|max:255',
                'jumlah' => 'required|numeric|min:0',
            ]);

            $transaksi = Transaksi::create([
                'akun_id' => $request->akun_id,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'tipe_transaksi' => $request->tipe_transaksi,
                'kas_bank' => $request->kas_bank,
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

            return redirect()->route('admin.transaksi')->with('success', 'Data berhasil disimpan!');
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.transaksi')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $akun = Akun::all();
        $transaksi = Transaksi::find($id);
        $tipeTransaksi = ['Penerimaan', 'Pengeluaran'];
        return view('admin.transaksi.edit', [
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
                'tipe_transaksi' => 'required|in:Penerimaan,Pengeluaran',
                'kas_bank' => 'required|string|max:255',
                'keterangan' => 'required|string|max:255',
                'jumlah' => 'required|numeric|min:0',
            ]);

            $transaksi = Transaksi::find($id);
            $transaksi->update([
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'tipe_transaksi' => $request->tipe_transaksi,
                'kas_bank' => $request->kas_bank,
                'keterangan' => $request->keterangan ?? null,
                'jumlah' => $request->jumlah,
            ]);
            return redirect()->route('admin.transaksi')->with('success', 'Transaksi Berhasil Diubah');
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.transaksi')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $transaksi = Transaksi::find($id);
            // if (!$transaksi) {
            //     return redirect()->route('admin.transaksi')->with('error','transaksi tidak ditemukan');
            // }

            $transaksi->delete();
            return redirect()->route('admin.transaksi')->with('success', 'transaksi berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.transaksi')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function verifikasi($id)
    {
        try {
            $transaksi = Transaksi::findOrFail($id);
    
            if ($transaksi->status === 'selesai') {
                return redirect()->route('admin.transaksi')->with('info', 'Transaksi sudah diverifikasi sebelumnya.');
            }
    
            // Cari akun kas/bank berdasarkan nama akun
            $akunKasBank = Akun::where('nama_akun', $transaksi->kas_bank)->first();
            if (!$akunKasBank) {
                return redirect()->route('admin.transaksi')->with('error', 'Akun kas/bank tidak ditemukan.');
            }
    
            $akunLawan = Akun::findOrFail($transaksi->akun_id); // Akun lawan sesuai transaksi
    
            // Simpan dua entry ke jurnal umum (Debit dan Kredit)
            if ($transaksi->tipe_transaksi === 'Penerimaan') {
                // Kas/Bank (Debit)
                \App\Models\JurnalUmum::create([
                    'akun_id' => $akunKasBank->id,
                    'transaksi_id' => $transaksi->id,
                    'tanggal' => $transaksi->tanggal_transaksi,
                    'keterangan' => $transaksi->keterangan,
                    'debit' => $transaksi->jumlah,
                    'kredit' => 0,
                ]);
    
                // Pendapatan (Kredit)
                \App\Models\JurnalUmum::create([
                    'akun_id' => $akunLawan->id,
                    'transaksi_id' => $transaksi->id,
                    'tanggal' => $transaksi->tanggal_transaksi,
                    'keterangan' => $transaksi->keterangan,
                    'debit' => 0,
                    'kredit' => $transaksi->jumlah,
                ]);
            } elseif ($transaksi->tipe_transaksi === 'Pengeluaran') {
                // Beban (Debit)
                \App\Models\JurnalUmum::create([
                    'akun_id' => $akunLawan->id,
                    'transaksi_id' => $transaksi->id,
                    'tanggal' => $transaksi->tanggal_transaksi,
                    'keterangan' => $transaksi->keterangan,
                    'debit' => $transaksi->jumlah,
                    'kredit' => 0,
                ]);
    
                // Kas/Bank (Kredit)
                \App\Models\JurnalUmum::create([
                    'akun_id' => $akunKasBank->id,
                    'transaksi_id' => $transaksi->id,
                    'tanggal' => $transaksi->tanggal_transaksi,
                    'keterangan' => $transaksi->keterangan,
                    'debit' => 0,
                    'kredit' => $transaksi->jumlah,
                ]);
            }
    
            // Update status transaksi ke selesai
            $transaksi->update(['status' => 'selesai']);
    
            return redirect()->route('admin.transaksi')->with('success', 'Transaksi berhasil diverifikasi dan dimasukkan ke Jurnal Umum!');
        } catch (\Exception $e) {
            return redirect()->route('admin.transaksi')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    

}
