<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\bukuBesar;
use App\Models\jurnalUmum;
use Illuminate\Http\Request;

class JuController extends Controller
{
    public function index(Request $request)
    {
        $query = JurnalUmum::with('akun');

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $jurnal = $query->orderBy('tanggal', 'desc')->get();

        return view('admin.jurnalUmum.index', compact('jurnal'));
    }
    public function verifikasi($id)
    {
        try {
            $jurnal = JurnalUmum::findOrFail($id);

            // Cari semua entry yang satu transaksi (berdasarkan keterangan + tanggal)
            $transaksi = JurnalUmum::where('keterangan', $jurnal->keterangan)
                ->where('tanggal', $jurnal->tanggal)
                ->get();

            foreach ($transaksi as $jU) {
                $jU->status = 'selesai';
                $jU->save();

                bukuBesar::create([
                    'tanggal'        => $jU->tanggal,
                    'keterangan'     => $jU->keterangan,
                    'akun_id'        => $jU->akun_id,
                    'debit'          => $jU->debit,
                    'kredit'         => $jU->kredit,
                    'jurnal_umum_id' => $jU->jurnal_umum_id,
                    'transaksi_id'   => $jU->transaksi_id,
                ]);
            }

            return redirect()->route('admin.jurnal')->with('success', 'Transaksi berhasil diposting ke Buku Besar.');
        } catch (\Exception $e) {
            return redirect()->route('admin.jurnal')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

