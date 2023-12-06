$(document).on('click', '.edit_riwayat_pmk', function() {
    var id = $(this).data('id');
    var jenis_pmk = $(this).data('jenis_pmk');
    var instansi = $(this).data('instansi');
    var tanggal_awal = $(this).data('tanggal_awal');
    var tanggal_akhir = $(this).data('tanggal_akhir');
    var no_sk = $(this).data('no_sk');
    var tanggal_sk = $(this).data('tanggal_sk');
    var no_bkn = $(this).data('no_bkn');
    var tanggal_bkn = $(this).data('tanggal_bkn');
    var masa_tahun = $(this).data('masa_tahun');
    var masa_bulan = $(this).data('masa_bulan');
    var dokumen_pmk = $(this).data('dokumen_pmk');
    $("#e_id").val(id);
    $("#e_jenis_pmk").val(jenis_pmk);
    $("#e_instansi").val(instansi);
    $("#e_tanggal_awal").val(tanggal_awal);
    $("#e_tanggal_akhir").val(tanggal_akhir);
    $("#e_no_sk").val(no_sk);
    $("#e_tanggal_sk").val(tanggal_sk);
    $("#e_no_bkn").val(no_bkn);
    $("#e_tanggal_bkn").val(tanggal_bkn);
    $("#e_masa_tahun").val(masa_tahun);
    $("#e_masa_bulan").val(masa_bulan);
    $("#e_dokumen_pmk").val(dokumen_pmk);
});

$(document).on('click', '.delete_riwayat_pmk', function() {
    var id = $(this).data('id');
    var dokumen_pmk = $(this).data('dokumen_pmk');
    $(".e_id").val(id);
    $(".d_dokumen_pmk").val(dokumen_pmk);
});