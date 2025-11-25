<?php

namespace App\Http\Controllers\App\Penghargaan;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Request;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        $auth = $request->attributes->get('auth');

        // ==========================
        // DUMMY DATA STATISTIK
        // setiap baris = data per bulan & prodi
        // (nanti boleh diganti query dari tabel pengajuan)
        // ==========================
        $statistik = [
            [
                'bulan'    => 'Mei',
                'jurnal'   => 4,
                'seminar'  => 2,
                'buku'     => 1,
                'fakultas' => 'Fakultas Informatika dan Teknik Elektro',
                'prodi'    => 'Informatika',
            ],
            [
                'bulan'    => 'Mei',
                'jurnal'   => 2,
                'seminar'  => 1,
                'buku'     => 0,
                'fakultas' => 'Fakultas Teknik Industri',
                'prodi'    => 'Manajemen Rekayasa',
            ],
            [
                'bulan'    => 'Juni',
                'jurnal'   => 3,
                'seminar'  => 4,
                'buku'     => 1,
                'fakultas' => 'Fakultas Informatika dan Teknik Elektro',
                'prodi'    => 'Sistem Informasi',
            ],
            [
                'bulan'    => 'Juni',
                'jurnal'   => 2,
                'seminar'  => 2,
                'buku'     => 1,
                'fakultas' => 'Fakultas Vokasi',
                'prodi'    => 'Teknologi Informasi',
            ],
            [
                'bulan'    => 'Juli',
                'jurnal'   => 1,
                'seminar'  => 3,
                'buku'     => 2,
                'fakultas' => 'Fakultas Teknik Bioproses',
                'prodi'    => 'Bioproses',
            ],
            [
                'bulan'    => 'Agustus',
                'jurnal'   => 5,
                'seminar'  => 2,
                'buku'     => 1,
                'fakultas' => 'Fakultas Vokasi',
                'prodi'    => 'Teknologi Rekayasa Perangkat Lunak',
            ],
        ];

        // ==========================
        // DUMMY SUMMARY BULAN INI
        // anggap "bulan ini" = Agustus dan data sudah dihitung
        // (nanti diganti query beneran berdasarkan tanggal & status)
        // ==========================

        // total semua pengajuan bulan ini (apapun status)
        $totalPengajuanBulanIni = 20;

        // total pengajuan yang disetujui bulan ini
        $totalDisetujuiBulanIni = 12;

        // hitung approval rate (dalam %)
        $approvalRate = $totalPengajuanBulanIni > 0
            ? round(($totalDisetujuiBulanIni / $totalPengajuanBulanIni) * 100, 1)
            : 0;

        // dana
        $totalDanaApprove = 6500000;   // Rp 6.500.000
        $anggaran         = 10000000;  // Rp 10.000.000
        $sisaDana         = $anggaran - $totalDanaApprove;

        // rekap jenis (bulan ini) – dummy
        $rekapJenisBulanIni = [
            'jurnal'  => 7,
            'seminar' => 4,
            'buku'    => 1,
        ];

        $summary = [
            'totalBulanIni'           => $totalDisetujuiBulanIni,    // dipakai kartu "Total Penghargaan Bulan Ini"
            'totalPengajuanBulanIni'  => $totalPengajuanBulanIni,    // semua pengajuan
            'approvalRateBulanIni'    => $approvalRate,              // %
            'totalDanaApprove'        => $totalDanaApprove,
            'sisaDana'                => $sisaDana,
            'anggaran'                => $anggaran,
            'rekapJenisBulanIni'      => $rekapJenisBulanIni,
        ];

        return Inertia::render('app/penghargaan/statistik-page', [
            'auth'      => Inertia::always($auth),
            'pageName'  => Inertia::always('Statistik Penghargaan'),
            'statistik' => $statistik,
            'summary'   => $summary,
        ]);
    }
}
