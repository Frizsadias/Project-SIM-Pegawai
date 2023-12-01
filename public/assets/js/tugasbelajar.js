$(document).on('click', '.edit_tugas_belajar', function() {
    var _this = $(this).parents('tr');
    $('#e_id').val(_this.find('.id').text());
    $('#e_jenis_tugas_belajar').val(_this.find('.jenis_tugas_belajar').text());
    $('#e_nama_sekolah').val(_this.find('.nama_sekolah').text());
    $('#e_tingkat_pendidikan').val(_this.find('.tingkat_pendidikan').text());
    $('#e_pendidikan').val(_this.find('.pendidikan').text());
    $('#e_predikat_akreditasi_jurusan').val(_this.find('.predikat_akreditasi_jurusan').text());
    $('#e_no_akreditasi_jurusan').val(_this.find('.no_akreditasi_jurusan').text());
    $('#e_gelar_depan').val(_this.find('.gelar_depan').text());
    $('#e_gelar_belakang').val(_this.find('.gelar_belakang').text());
    $('#e_tanggal_mulai').val(_this.find('.tanggal_mulai').text());
    $('#e_tanggal_selesai').val(_this.find('.tanggal_selesai').text());
});

$(document).on('click', '.delete_tugas_belajar', function() {
    var _this = $(this).parents('tr');
    $('.e_id').val(_this.find('.id').text());
});