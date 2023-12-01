$(document).on('click', '.edit_riwayat_golongan', function() {
    var _this = $(this).parents('tr');
    $('#e_id_gol').val(_this.find('.id_gol').text());
    $('#e_golongan').val(_this.find('.golongan').text());
    $('#e_jenis_kenaikan_pangkat').val(_this.find('.jenis_kenaikan_pangkat').text());
    $('#e_masa_kerja_golongan_tahun').val(_this.find('.masa_kerja_golongan_tahun').text());
    $('#e_masa_kerja_golongan_bulan').val(_this.find('.masa_kerja_golongan_bulan').text());
    $('#e_tmt_golongan_riwayat').val(_this.find('.tmt_golongan_riwayat').text());
    $('#e_no_teknis_bkn').val(_this.find('.no_teknis_bkn').text());
    $('#e_tanggal_teknis_bkn').val(_this.find('.tanggal_teknis_bkn').text());
    $('#e_no_sk_golongan').val(_this.find('.no_sk_golongan').text());
    $('#e_tanggal_sk_golongan').val(_this.find('.tanggal_sk_golongan').text());
    $('#e_dokumen_skkp').val(_this.find('.dokumen_skkp').text());
    $('#e_dokumen_teknis_kp').val(_this.find('.dokumen_teknis_kp').text());
});

$(document).on('click', '.delete_riwayat_golongan', function() {
    var _this = $(this).parents('tr');
    $('.e_id').val(_this.find('.id').text());
    $('.d_dokumen_skkp').val(_this.find('.dokumen_skkp').text());
    $('.d_dokumen_teknis_kp').val(_this.find('.dokumen_teknis_kp').text());
});