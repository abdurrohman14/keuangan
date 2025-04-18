<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use Illuminate\Http\Request;
use App\Models\Transaksi;
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

        return view('admin.transaksi.index', [
            'title' => 'transaksi',
            'transaksi' => $transaksis,
            'tipeTransaksi' => $tipeTransaksiOptions,
        ]);
    }

    public function create()
    {
        $akun = Akun::all();
        $tipeTransaksi = ['Penerimaan', 'Pengeluaran'];
        return view('admin.transaksi.create', [
            'title' => 'Tambah Transaksi',
            'akun' => $akun,
            'tipeTransaksi' => $tipeTransaksi,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'akun_id' => 'required|exists:akuns,id',
                'tanggal_transaksi' => 'required|date',
                'tipe_transaksi' => 'required|in:Penerimaan,Pengeluaran',
                'rekening' => 'required|string|max:255',
                'keterangan' => 'required|string|max:255',
                'jumlah' => 'required|numeric|min:0',
            ]);

            Transaksi::create([
                'akun_id' => $request->akun_id,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'tipe_transaksi' => $request->tipe_transaksi,
                'rekening' => $request->rekening,
                'keterangan' => $request->keterangan ?? null,
                'jumlah' => $request->jumlah,
            ]);

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
}
