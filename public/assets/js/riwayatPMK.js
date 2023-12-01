// update
$(document).on('click', '.edit_riwayat_pmk', function () {
    var _this = $(this).parents('tr');
    $('#e_id_pmk').val(_this.find('.id').text());
    $('#e_jenis_pmk').val(_this.find('.jenis_pmk').text());
    $('#e_instansi').val(_this.find('.instansi').text());
    $('#e_tanggal_awal').val(_this.find('.tanggal_awal').text());
    $('#e_tanggal_akhir').val(_this.find('.tanggal_akhir').text());
    $('#e_no_sk_pmk').val(_this.find('.no_sk').text());
    $('#e_tanggal_sk_pmk').val(_this.find('.tanggal_sk').text());
    $('#e_no_bkn').val(_this.find('.no_bkn').text());
    $('#e_tanggal_bkn').val(_this.find('.tanggal_bkn').text());
    $('#e_masa_tahun').val(_this.find('.masa_tahun').text());
    $('#e_masa_bulan').val(_this.find('.masa_bulan').text());
    $('#e_dokumen_pmk').val(_this.find('.dokumen_pmk').text());
});

//delete
$(document).on('click', '.delete_riwayat_pmk', function () {
    var _this = $(this).parents('tr');
    $('.e_id').val(_this.find('.id').text());
    $('.d_dokumen_pmk').val(_this.find('.dokumen_pmk').text());
});
