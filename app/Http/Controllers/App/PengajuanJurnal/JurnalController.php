<?php

namespace App\Http\Controllers\App\PengajuanJurnal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JurnalController extends Controller
{
    /**
     * Halaman Daftar Jurnal
     */
    public function index()
    {
        // Data dummy jurnal (ganti dengan data dari database)
        $jurnal = [
            [
                'id' => 1,
                'judul' => 'Implementasi Machine Learning dalam Prediksi Cuaca',
                'penulis' => 'Dr. Ahmad Yani',
                'status' => 'Sudah Diverifikasi',
                'tanggal' => '2024-01-15'
            ],
            [
                'id' => 2,
                'judul' => 'Analisis Big Data untuk Sistem Rekomendasi',
                'penulis' => 'Prof. Siti Nurhaliza',
                'status' => 'Belum Diverifikasi',
                'tanggal' => '2024-02-20'
            ],
            [
                'id' => 3,
                'judul' => 'Pengembangan Aplikasi IoT untuk Smart Home',
                'penulis' => 'Dr. Budi Santoso',
                'status' => 'Sudah Diverifikasi',
                'tanggal' => '2024-03-10'
            ],
        ];

        return Inertia::render('PengajuanJurnal/DaftarJurnalPage', [
            'jurnal' => $jurnal
        ]);
    }

    /**
     * Halaman Pilih Data (Gambar 1)
     */
    public function pilihData(Request $request)
    {
        return Inertia::render('PengajuanJurnal/PilihDataPenghargaanPage', [
            'sinta_id' => $request->query('sinta_id'),
            'scopus_id' => $request->query('scopus_id'),
            'prosiding' => $request->query('prosiding'),
        ]);
    }

    /**
     * Halaman Form Penghargaan (Gambar 2)
     */
    public function form(Request $request)
    {
        return Inertia::render('PengajuanJurnal/FormPenghargaanJurnalPage', [
            'sinta_id' => $request->query('sinta_id'),
            'scopus_id' => $request->query('scopus_id'),
            'prosiding' => $request->query('prosiding'),
        ]);
    }

    /**
     * Submit Form
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'sintaId' => 'nullable|string',
            'scopusId' => 'nullable|string',
            'prosiding' => 'nullable|string',
            'judulMakalah' => 'required|string',
            'issn' => 'required|string',
            'volume' => 'nullable|string',
            'penulis' => 'nullable|string',
            'nomor' => 'nullable|string',
            'halPaper' => 'nullable|string',
            'tempatPelaksanaan' => 'nullable|string',
            'url' => 'nullable|url',
        ]);

        // Simpan ke database
        // Contoh: Jurnal::create($validated);
        
        // Log data untuk testing
        \Log::info('Data Jurnal Baru:', $validated);

        // Redirect dengan pesan sukses
        return redirect()->route('pengajuan.jurnal.daftar')
            ->with('success', 'Data jurnal berhasil disimpan!');
    }

    /**
     * Edit Jurnal (Optional)
     */
    public function edit($id)
    {
        // Ambil data jurnal dari database
        // $jurnal = Jurnal::findOrFail($id);

        $jurnal = [
            'id' => $id,
            'sintaId' => '123456',
            'scopusId' => '789012',
            'judulMakalah' => 'Contoh Judul',
            'issn' => '1234-5678',
            'volume' => '10',
            'penulis' => 'penulis1',
            'nomor' => '2',
            'halPaper' => '10-20',
            'tempatPelaksanaan' => 'Jakarta',
            'url' => 'https://example.com',
        ];

        return Inertia::render('PengajuanJurnal/FormPenghargaanJurnalPage', [
            'jurnal' => $jurnal,
            'isEdit' => true
        ]);
    }

    /**
     * Update Jurnal (Optional)
     */
    public function update(Request $request, $id)
    {
        // Validasi dan update
        $validated = $request->validate([
            'sintaId' => 'nullable|string',
            'scopusId' => 'nullable|string',
            'judulMakalah' => 'required|string',
            'issn' => 'required|string',
            'volume' => 'nullable|string',
            'penulis' => 'nullable|string',
            'nomor' => 'nullable|string',
            'halPaper' => 'nullable|string',
            'tempatPelaksanaan' => 'nullable|string',
            'url' => 'nullable|url',
        ]);

        // Update database
        // Jurnal::findOrFail($id)->update($validated);

        return redirect()->route('pengajuan.jurnal.daftar')
            ->with('success', 'Data jurnal berhasil diupdate!');
    }

    /**
     * Delete Jurnal (Optional)
     */
    public function delete($id)
    {
        // Delete dari database
        // Jurnal::findOrFail($id)->delete();

        return redirect()->route('pengajuan.jurnal.daftar')
            ->with('success', 'Data jurnal berhasil dihapus!');
    }
}