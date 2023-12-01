$(document).on('click', '.edit_riwayat_diklat', function() {
    var _this = $(this).parents('tr');
    $('#e_id_dik').val(_this.find('.id_dik').text());
    $('#e_nama_diklat').val(_this.find('.nama_diklat').text());
    $('#e_institusi_penyelenggara').val(_this.find('.institusi_penyelenggara').text());
    $('#e_no_sertifikat').val(_this.find('.no_sertifikat').text());
    $('#e_tanggal_mulai').val(_this.find('.tanggal_mulai').text());
    $('#e_tanggal_selesai').val(_this.find('.tanggal_selesai').text());
    $('#e_tahun_diklat').val(_this.find('.tahun_diklat').text());
    $('#e_durasi_jam').val(_this.find('.durasi_jam').text());
    $('#e_dokumen_diklat').val(_this.find('.dokumen_diklat').text());

    var jenis_diklat = (_this.find(".jenis_diklat").text());
    var _option = '<option selected value="' + jenis_diklat + '">' + _this.find('.jenis_diklat').text() +
        '</option>'
    $(_option).appendTo("#e_jenis_diklat");
});

$(document).on('click', '.delete_riwayat_diklat', function() {
    var _this = $(this).parents('tr');
    $('.e_id').val(_this.find('.id').text());
    $('.d_dokumen_diklat').val(_this.find('.dokumen_diklat').text());
});