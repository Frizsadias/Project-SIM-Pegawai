$(document).on('click', '.edit_riwayat_jabatan', function() {
    var _this = $(this).parents('tr');
    $('#e_id_jab').val(_this.find('.id_jab').text());
    $('#e_satuan_kerja').val(_this.find('.satuan_kerja').text());
    $('#e_satuan_kerja_induk').val(_this.find('.satuan_kerja_induk').text());
    $('#e_unit_organisasi_riwayat').val(_this.find('.unit_organisasi_riwayat').text());
    $('#e_no_sk').val(_this.find('.no_sk').text());
    $('#e_tanggal_sk').val(_this.find('.tanggal_sk').text());
    $('#e_tmt_jabatan').val(_this.find('.tmt_jabatan').text());
    $('#e_tmt_pelantikan').val(_this.find('.tmt_pelantikan').text());
    $('#e_dokumen_sk_jabatan').val(_this.find('.dokumen_sk_jabatan').text());
    $('#e_dokumen_pelantikan').val(_this.find('.dokumen_pelantikan').text());

    var jenis_jabatan_riwayat = (_this.find(".jenis_jabatan_riwayat").text());
    var _option = '<option selected value="' + jenis_jabatan_riwayat + '">' + _this.find('.jenis_jabatan_riwayat').text() +
        '</option>'
    $(_option).appendTo("#e_jenis_jabatan_riwayat");
});

$(document).on('click', '.delete_riwayat_jabatan', function() {
    var _this = $(this).parents('tr');
    $('.e_id').val(_this.find('.id').text());
    $('.d_dokumen_sk_jabatan').val(_this.find('.dokumen_sk_jabatan').text());
    $('.d_dokumen_pelantikan').val(_this.find('.dokumen_pelantikan').text());
});
