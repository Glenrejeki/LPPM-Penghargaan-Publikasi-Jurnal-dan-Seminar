<?php

namespace App\Http\Controllers\App\Penghargaan;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Request;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        $auth = $request->attributes->get('auth');

        $pengajuan = [
            [
                'id'       => 1,
                'judul'    => 'Jurnal Dosen 1',
                'jenis'    => 'Jurnal',
                'penulis'  => 'Dosen 1, Dosen 2',
                'status'   => 'Belum disetujui',
                'tanggal'  => '2025-05-10',
                'kampus'   => 'IT Del',
                'fakultas' => 'Fakultas Informatika dan Teknik Elektro',
                'prodi'    => 'Informatika',
            ],
            [
                'id'       => 2,
                'judul'    => 'Seminar Dosen 3',
                'jenis'    => 'Seminar Nasional',
                'penulis'  => 'Lola Simanjuntak',
                'status'   => 'Belum disetujui',
                'tanggal'  => '2025-06-01',
                'kampus'   => 'IT Del',
                'fakultas' => 'Fakultas Teknik Industri',
                'prodi'    => 'Teknik Industri',
            ],
        ];

        return Inertia::render('app/penghargaan/daftar-pengajuan-page', [
            'auth'      => Inertia::always($auth),
            'pageName'  => Inertia::always('Daftar Pengajuan Penghargaan'),
            'pengajuan' => $pengajuan,
        ]);
    }

    public function show(Request $request, $id)
{
    $auth = $request->attributes->get('auth');

    if ((int) $id === 1) {
        // DETAIL JURNAL DOSEN 1
        $pengajuan = [
            'id'                => 1,
            'nama_dosen'        => 'Dosen 1, Dosen 2',
            'nip'               => '1987654321',
            'nik'               => '12710511010001',
            'jenis_penghargaan' => 'Publikasi Jurnal',
            'nama_kegiatan'     => 'Penerapan Machine Learning untuk Prediksi Cuaca',
            'indeks'            => 'Scopus Q2 – Journal of Computer Science',
            'dana_maksimum'     => 10000000,
            'status'            => 'Belum disetujui',
            'bukti_url'         => '#',
            'dana_disetujui'    => null,
        ];

        // render ke file detail-pengajuan-jurnal-page.jsx
        return Inertia::render('app/penghargaan/detail-pengajuan-jurnal-page', [
            'auth'      => Inertia::always($auth),
            'pageName'  => Inertia::always('Form Konfirmasi Jurnal'),
            'pengajuan' => $pengajuan,
        ]);
    }

    // selain id=1, anggap seminar (contoh id=2)
    $pengajuan = [
        'id'                => (int) $id,
        'nama_dosen'        => 'Lola Simanjuntak',
        'nip'               => '1987654321',
        'nik'               => '12710511010001',
        'jenis_penghargaan' => 'Seminar Nasional',
        'nama_kegiatan'     => 'Implementasi AI untuk Pendidikan',
        'indeks'            => 'Scopus – Elsevier Procedia Computer Science',
        'dana_maksimum'     => 7500000,
        'status'            => 'Belum disetujui',
        'bukti_url'         => '#',
        'dana_disetujui'    => null,
    ];

    // render ke file detail-pengajuan-seminar-page.jsx
    return Inertia::render('app/penghargaan/detail-pengajuan-seminar-page', [
        'auth'      => Inertia::always($auth),
        'pageName'  => Inertia::always('Form Konfirmasi Seminar'),
        'pengajuan' => $pengajuan,
    ]);
}


    public function konfirmasi(Request $request, $id)
    {
        $validated = $request->validate([
            'status'         => 'required|string|in:Setuju,Menolak,Belum disetujui',
            'dana_disetujui' => 'required|numeric|min:0',
        ]);

        // TODO: simpan ke database di sini

        return redirect()
            ->route('penghargaan.daftar')
            ->with('success', 'Data konfirmasi berhasil disimpan.');
    }
    
}