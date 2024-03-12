$(document).on('click', '.edit_riwayat_pendidikan', function() {
    var _this = $(this).parents('tr');
    $('#e_id_pend').val(_this.find('.id_pend').text());
    $('#e_pendidikan').val(_this.find('.pendidikan').text());
    $('#e_tahun_lulus').val(_this.find('.tahun_lulus').text());
    $('#e_no_ijazah').val(_this.find('.no_ijazah').text());
    $('#e_nama_sekolah').val(_this.find('.nama_sekolah').text());
    $('#e_gelar_depan_pend').val(_this.find('.gelar_depan_pend').text());
    $('#e_gelar_belakang_pend').val(_this.find('.gelar_belakang_pend').text());
    var jenisPendidikanText = _this.find(".jenis_pendidikan").text().trim();
    $('input[name="jenis_pendidikan"]').each(function () {
        if ($(this).val() === jenisPendidikanText) {
            $(this).prop("checked", true);
        } else {
            $(this).prop("checked", false);
        }
    });
    $('#e_dokumen_transkrip').val(_this.find('.dokumen_transkrip').text());
    $('#e_dokumen_ijazah').val(_this.find('.dokumen_ijazah').text());
    $('#e_dokumen_gelar').val(_this.find('.dokumen_gelar').text());
    var ting_ped = (_this.find(".ting_ped").text());
    var _option = '<option selected value="' + ting_ped + '">' + _this.find('.ting_ped')
        .text() + '</option>'
    $(_option).appendTo("#e_ting_ped");
});

$(document).on('click', '.delete_riwayat_pendidikan', function() {
    var _this = $(this).parents('tr');
    $('.e_id').val(_this.find('.id_pendidikan').text());
    $('.d_dokumen_transkrip').val(_this.find('.dokumen_transkrip').text());
    $('.d_dokumen_ijazah').val(_this.find('.dokumen_ijazah').text());
    $('.d_dokumen_gelar').val(_this.find('.dokumen_gelar').text());
});