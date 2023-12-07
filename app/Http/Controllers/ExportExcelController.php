<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportExcelController extends Controller
{
    public function exportSIPDokter()
    {
        // Ambil data dari database
        $data = DB::table('sip_spk_dokter')
        ->select('id', 'name', 'nip', 'unit_kerja', 'nomor_sip', 'tanggal_terbit', 'tanggal_berlaku', 'ruangan', 'dokumen_sip')
        ->where('jenis_dokumen', 'SIP Dokter')
        ->get();

        // Buat objek spreadsheet
        $spreadsheet = new Spreadsheet();

        // Buat sheet baru
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'NIP');
        $sheet->setCellValue('D1', 'Unit Kerja');
        $sheet->setCellValue('E1', 'Nomor SIP');
        $sheet->setCellValue('F1', 'Tanggal Terbit');
        $sheet->setCellValue('G1', 'Tanggal Berlaku');
        $sheet->setCellValue('H1', 'Ruangan');
        $sheet->setCellValue('I1', 'Dokumen');

        // Set data pada sheet
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->id);
            $sheet->setCellValue('B' . $row, $item->name);
            $sheet->setCellValue('C' . $row, $item->nip);
            $sheet->setCellValue('D' . $row, $item->unit_kerja);
            $sheet->setCellValue('E' . $row, $item->nomor_sip);
            $sheet->setCellValue('F' . $row, $item->tanggal_terbit);
            $sheet->setCellValue('G' . $row, $item->tanggal_berlaku);
            $sheet->setCellValue('H' . $row, $item->ruangan);

            // Membuat tautan ke dokumen_sip di folder assets
            $filePath = public_path('assets/DokumenSIPDokter/' . $item->dokumen_sip);
            $hyperlink = asset('assets/DokumenSIPDokter/' . $item->dokumen_sip);
            $filename = $item->dokumen_sip; // Nama file

            $sheet->setCellValue('I' . $row, $filename);

            $sheet->getCell('I' . $row)->getHyperlink()->setUrl($hyperlink);
            $sheet->getCell('I' . $row)->getHyperlink()->setTooltip('Lihat ' . $filename); // Tampilkan nama file

            // Membuat tautan untuk membuka file saat nama file diklik
            $sheet->getCell('I' . $row)->getHyperlink()->setUrl($filePath);

            $row++;
        }

        // Buat objek writer
        $writer = new Xlsx($spreadsheet);

        // Set header untuk file excel yang akan didownload
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="sip_dokter.xlsx"');
        header('Cache-Control: max-age=0');

        // Download file excel
        $writer->save('php://output');
    }

    public function exportSPKDokter()
    {
        // Ambil data dari database
        $data = DB::table('sip_spk_dokter')
        ->select('id', 'name', 'nip', 'unit_kerja', 'nomor_sip', 'tanggal_terbit', 'tanggal_berlaku', 'ruangan', 'dokumen_sip')
        ->where('jenis_dokumen', 'SPK Dokter')
        ->get();

        // Buat objek spreadsheet
        $spreadsheet = new Spreadsheet();

        // Buat sheet baru
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'NIP');
        $sheet->setCellValue('D1', 'Unit Kerja');
        $sheet->setCellValue('E1', 'Nomor SPK');
        $sheet->setCellValue('F1', 'Tanggal Terbit');
        $sheet->setCellValue('G1', 'Tanggal Berlaku');
        $sheet->setCellValue('H1', 'Ruangan');
        $sheet->setCellValue('I1', 'Dokumen');

        // Set data pada sheet
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->id);
            $sheet->setCellValue('B' . $row, $item->name);
            $sheet->setCellValue('C' . $row, $item->nip);
            $sheet->setCellValue('D' . $row, $item->unit_kerja);
            $sheet->setCellValue('E' . $row, $item->nomor_sip);
            $sheet->setCellValue('F' . $row, $item->tanggal_terbit);
            $sheet->setCellValue('G' . $row, $item->tanggal_berlaku);
            $sheet->setCellValue('H' . $row, $item->ruangan);

            // Membuat tautan ke dokumen_sip di folder assets
            $filePath = public_path('assets/DokumenSPKDokter/' . $item->dokumen_sip);
            $hyperlink = asset('assets/DokumenSPKDokter/' . $item->dokumen_sip);
            $filename = $item->dokumen_sip; // Nama file

            $sheet->setCellValue('I' . $row, $filename);

            $sheet->getCell('I' . $row)->getHyperlink()->setUrl($hyperlink);
            $sheet->getCell('I' . $row)->getHyperlink()->setTooltip('Lihat ' . $filename); // Tampilkan nama file

            // Membuat tautan untuk membuka file saat nama file diklik
            $sheet->getCell('I' . $row)->getHyperlink()->setUrl($filePath);

            $row++;
        }

        // Buat objek writer
        $writer = new Xlsx($spreadsheet);

        // Set header untuk file excel yang akan didownload
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="spk_dokter.xlsx"');
        header('Cache-Control: max-age=0');

        // Download file excel
        $writer->save('php://output');
    }

    public function exportSPKPerawat()
    {
        // Ambil data dari database
        $data = DB::table('sip_spk_dokter')
        ->select('id', 'name', 'nip', 'unit_kerja', 'nomor_sip', 'tanggal_terbit', 'tanggal_berlaku', 'ruangan', 'dokumen_sip')
        ->where('jenis_dokumen', 'SPK Perawat')
        ->get();

        // Buat objek spreadsheet
        $spreadsheet = new Spreadsheet();

        // Buat sheet baru
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'NIP');
        $sheet->setCellValue('D1', 'Unit Kerja');
        $sheet->setCellValue('E1', 'Nomor SPK');
        $sheet->setCellValue('F1', 'Tanggal Terbit');
        $sheet->setCellValue('G1', 'Tanggal Berlaku');
        $sheet->setCellValue('H1', 'Ruangan');
        $sheet->setCellValue('I1', 'Dokumen');

        // Set data pada sheet
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->id);
            $sheet->setCellValue('B' . $row, $item->name);
            $sheet->setCellValue('C' . $row, $item->nip);
            $sheet->setCellValue('D' . $row, $item->unit_kerja);
            $sheet->setCellValue('E' . $row, $item->nomor_sip);
            $sheet->setCellValue('F' . $row, $item->tanggal_terbit);
            $sheet->setCellValue('G' . $row, $item->tanggal_berlaku);
            $sheet->setCellValue('H' . $row, $item->ruangan);

            // Membuat tautan ke dokumen_sip di folder assets
            $filePath = public_path('assets/DokumenSPKPerawat/' . $item->dokumen_sip);
            $hyperlink = asset('assets/DokumenSPKPerawat/' . $item->dokumen_sip);
            $filename = $item->dokumen_sip; // Nama file

            $sheet->setCellValue('I' . $row, $filename);

            $sheet->getCell('I' . $row)->getHyperlink()->setUrl($hyperlink);
            $sheet->getCell('I' . $row)->getHyperlink()->setTooltip('Lihat ' . $filename); // Tampilkan nama file

            // Membuat tautan untuk membuka file saat nama file diklik
            $sheet->getCell('I' . $row)->getHyperlink()->setUrl($filePath);

            $row++;
        }

        // Buat objek writer
        $writer = new Xlsx($spreadsheet);

        // Set header untuk file excel yang akan didownload
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="spk_perawat.xlsx"');
        header('Cache-Control: max-age=0');

        // Download file excel
        $writer->save('php://output');
    }

    public function exportSPKNakesLain()
    {
        // Ambil data dari database
        $data = DB::table('sip_spk_dokter')
        ->select('id', 'name', 'nip', 'unit_kerja', 'nomor_sip', 'tanggal_terbit', 'tanggal_berlaku', 'ruangan', 'dokumen_sip')
        ->where('jenis_dokumen', 'SPK Nakes Lain')
        ->get();

        // Buat objek spreadsheet
        $spreadsheet = new Spreadsheet();

        // Buat sheet baru
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'NIP');
        $sheet->setCellValue('D1', 'Unit Kerja');
        $sheet->setCellValue('E1', 'Nomor SPK');
        $sheet->setCellValue('F1', 'Tanggal Terbit');
        $sheet->setCellValue('G1', 'Tanggal Berlaku');
        $sheet->setCellValue('H1', 'Ruangan');
        $sheet->setCellValue('I1', 'Dokumen');


        // Set data pada sheet
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->id);
            $sheet->setCellValue('B' . $row, $item->name);
            $sheet->setCellValue('C' . $row, $item->nip);
            $sheet->setCellValue('D' . $row, $item->unit_kerja);
            $sheet->setCellValue('E' . $row, $item->nomor_sip);
            $sheet->setCellValue('F' . $row, $item->tanggal_terbit);
            $sheet->setCellValue('G' . $row, $item->tanggal_berlaku);
            $sheet->setCellValue('H' . $row, $item->ruangan);

            // Membuat tautan ke dokumen_sip di folder assets
            $filePath = public_path('assets/DokumenSPKNakesLain/' . $item->dokumen_sip);
            $hyperlink = asset('assets/DokumenSPKNakesLain/' . $item->dokumen_sip);
            $filename = $item->dokumen_sip; // Nama file

            $sheet->setCellValue('I' . $row, $filename);

            $sheet->getCell('I' . $row)->getHyperlink()->setUrl($hyperlink);
            $sheet->getCell('I' . $row)->getHyperlink()->setTooltip('Lihat ' . $filename); // Tampilkan nama file

            // Membuat tautan untuk membuka file saat nama file diklik
            $sheet->getCell('I' . $row)->getHyperlink()->setUrl($filePath);

            $row++;
        }

        // Buat objek writer
        $writer = new Xlsx($spreadsheet);

        // Set header untuk file excel yang akan didownload
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="spk_nakes_lain.xlsx"');
        header('Cache-Control: max-age=0');

        // Download file excel
        $writer->save('php://output');
    }

    public function exportDaftarPegawai()
    {
        // Ambil data dari database
        $data = DB::table('profil_pegawai')
        ->select('id', 'user_id', 'name', 'email', 'nip', 'gelar_depan', 'gelar_belakang', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama',
            'jenis_dokumen', 'no_dokumen', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'kode_pos', 'no_hp', 'no_telp',
            'jenis_pegawai','kedudukan_pns','status_pegawai','tmt_pns','no_seri_karpeg','tmt_cpns','tingkat_pendidikan','pendidikan_terakhir','ruangan', 'dokumen_ktp','created_at','updated_at'
        )
            ->get();

        // Buat objek spreadsheet
        $spreadsheet = new Spreadsheet();

        // Buat sheet baru
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'User ID');
        $sheet->setCellValue('C1', 'Name');
        $sheet->setCellValue('D1', 'Email');
        $sheet->setCellValue('E1', 'NIP');
        $sheet->setCellValue('F1', 'Gelar Depan');
        $sheet->setCellValue('G1', 'Gelar Belakang');
        $sheet->setCellValue('H1', 'Tempat Lahir');
        $sheet->setCellValue('I1', 'Tanggal Lahir');
        $sheet->setCellValue('J1', 'Jenis Kelamin');
        $sheet->setCellValue('K1', 'Agama');
        $sheet->setCellValue('L1', 'Jenis Dokumen');
        $sheet->setCellValue('M1', 'Nomor Induk Kependudukan');
        $sheet->setCellValue('N1', 'Kelurahan');
        $sheet->setCellValue('O1', 'Kecamatan');
        $sheet->setCellValue('P1', 'Kota');
        $sheet->setCellValue('Q1', 'Provinsi');
        $sheet->setCellValue('R1', 'Kode Pos');
        $sheet->setCellValue('S1', 'No HP');
        $sheet->setCellValue('T1', 'No Telp');
        $sheet->setCellValue('U1', 'Jenis Pegawai');
        $sheet->setCellValue('V1', 'Kedudukan PNS');
        $sheet->setCellValue('W1', 'Status Pegawai');
        $sheet->setCellValue('X1', 'TMT PNS');
        $sheet->setCellValue('Y1', 'No Seri Karpeg');
        $sheet->setCellValue('Z1', 'TMT CPNS');
        $sheet->setCellValue('AA1', 'Tingkat Pendidikan');
        $sheet->setCellValue('AB1', 'Pendidikan Terakhir');
        $sheet->setCellValue('AC1', 'Ruangan');
        $sheet->setCellValue('AD1', 'Dokumen KTP');
        $sheet->setCellValue('AE1', 'Created At');
        $sheet->setCellValue('AF1', 'Updated At');

        // Set data pada sheet
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->id);
            $sheet->setCellValue('B' . $row, $item->user_id);
            $sheet->setCellValue('C' . $row, $item->name);
            $sheet->setCellValue('D' . $row, $item->email);
            $sheet->setCellValue('E' . $row, $item->nip);
            $sheet->setCellValue('F' . $row, $item->gelar_depan);
            $sheet->setCellValue('G' . $row, $item->gelar_belakang);
            $sheet->setCellValue('H' . $row, $item->tempat_lahir);
            $sheet->setCellValue('I' . $row, $item->tanggal_lahir);
            $sheet->setCellValue('J' . $row, $item->jenis_kelamin);
            $sheet->setCellValue('K' . $row, $item->agama);
            $sheet->setCellValue('L' . $row, $item->jenis_dokumen);
            $sheet->setCellValue('M' . $row, $item->no_dokumen);
            $sheet->setCellValue('N' . $row, $item->kelurahan);
            $sheet->setCellValue('O' . $row, $item->kecamatan);
            $sheet->setCellValue('P' . $row, $item->kota);
            $sheet->setCellValue('Q' . $row, $item->provinsi);
            $sheet->setCellValue('R' . $row, $item->kode_pos);
            $sheet->setCellValue('S' . $row, $item->no_hp);
            $sheet->setCellValue('T' . $row, $item->no_telp);
            $sheet->setCellValue('U' . $row, $item->jenis_pegawai);
            $sheet->setCellValue('V' . $row, $item->kedudukan_pns);
            $sheet->setCellValue('W' . $row, $item->status_pegawai);
            $sheet->setCellValue('X' . $row, $item->tmt_pns);
            $sheet->setCellValue('Y' . $row, $item->no_seri_karpeg);
            $sheet->setCellValue('Z' . $row, $item->tmt_cpns);
            $sheet->setCellValue('AA' . $row, $item->tingkat_pendidikan);
            $sheet->setCellValue('AB' . $row, $item->pendidikan_terakhir);
            $sheet->setCellValue('AC' . $row, $item->ruangan);


            // Membuat tautan ke dokumen_sip di folder assets
            $filePath = public_path('assets/DokumenKTP/' . $item->dokumen_ktp);
            $hyperlink = asset('assets/DokumenKTP/' . $item->dokumen_ktp);
            $filename = $item->dokumen_ktp; // Nama file

            $sheet->setCellValue('AD' . $row, $filename);

            $sheet->getCell('AD' . $row)->getHyperlink()->setUrl($hyperlink);
            $sheet->getCell('AD' . $row)->getHyperlink()->setTooltip('Lihat ' . $filename); // Tampilkan nama file

            // Membuat tautan untuk membuka file saat nama file diklik
            $sheet->getCell('AD' . $row)->getHyperlink()->setUrl($filePath);

            $sheet->setCellValue('AE' . $row, $item->created_at);
            $sheet->setCellValue('AF' . $row, $item->updated_at);

            $row++;
        }

        // Buat objek writer
        $writer = new Xlsx($spreadsheet);

        // Set header untuk file excel yang akan didownload
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="daftar_pegawai.xlsx"');
        header('Cache-Control: max-age=0');

        // Download file excel
        $writer->save('php://output');
    }

}
