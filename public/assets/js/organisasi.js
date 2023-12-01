$(document).on('click', '.edit_organisasi', function() {
    var _this = $(this).parents('tr');
    $('#e_id').val(_this.find('.id').text());
    $('#e_nama_organisasi').val(_this.find('.nama_organisasi').text());
    $('#e_jabatan_organisasi').val(_this.find('.jabatan_organisasi').text());
    $('#e_tanggal_gabung').val(_this.find('.tanggal_gabung').text());
    $('#e_tanggal_selesai').val(_this.find('.tanggal_selesai').text());
    $('#e_no_anggota').val(_this.find('.no_anggota').text());
    $('#e_dokumen_organisasi').val(_this.find('.dokumen_organisasi').text());
});

$(document).on('click', '.delete_organisasi', function() {
    var _this = $(this).parents('tr');
    $('.e_id').val(_this.find('.id').text());
    $('.d_dokumen_organisasi').val(_this.find('.dokumen_organisasi').text());
});