$(document).on('click', '.edit_riwayat_diklat', function() {
    var id = $(this).data('id');
    var nama_diklat = $(this).data('nama_diklat');
    var institusi_penyelenggara = $(this).data('institusi_penyelenggara');
    var no_sertifikat = $(this).data('no_sertifikat');
    var tanggal_mulai = $(this).data('tanggal_mulai');
    var tanggal_selesai = $(this).data('tanggal_selesai');
    var tahun_diklat = $(this).data('tahun_diklat');
    var durasi_jam = $(this).data('durasi_jam');
    var dokumen_diklat = $(this).data('dokumen_diklat');
    $("#e_id").val(id);
    $("#e_nama_diklat").val(nama_diklat);
    $("#e_institusi_penyelenggara").val(institusi_penyelenggara);
    $("#e_no_sertifikat").val(no_sertifikat);
    $("#e_tanggal_mulai").val(tanggal_mulai);
    $("#e_tanggal_selesai").val(tanggal_selesai);
    $("#e_tahun_diklat").val(tahun_diklat);
    $("#e_durasi_jam").val(durasi_jam);
    $("#e_dokumen_diklat").val(dokumen_diklat);

    var jenis_diklat = $(this).data('jenis_diklat');
    var _option = '<option selected value=" '+jenis_diklat+' "> '+jenis_diklat+' </option>'
    $(_option).appendTo("#e_jenis_diklat");
});

$(document).on('click', '.delete_riwayat_diklat', function() {
    var id = $(this).data('id');
    var dokumen_diklat = $(this).data('dokumen_diklat');
    $(".e_id").val(id);
    $(".d_dokumen_diklat").val(dokumen_diklat);
});