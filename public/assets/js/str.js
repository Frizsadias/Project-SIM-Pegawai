$(document).on('click', '.edit_str', function() {
    var _this = $(this).closest('tr');
    $('#e_id').val(_this.find('.id').text());
    $('#e_tempat_lahir').val(_this.find('.tempat_lahir').text());
    $('#e_tanggal_lahir').val(_this.find('.tanggal_lahir').text());
    $('#e_jenis_kelamin').val(_this.find('.jenis_kelamin').text());
    $('#e_pendidikan_terakhir').val(_this.find('.pendidikan_terakhir').text());
    $('#e_nomor_reg').val(_this.find('.nomor_reg').text());
    $('#e_tanggal_lulus').val(_this.find('.tanggal_lulus').text());
    $('#e_kompetensi').val(_this.find('.kompetensi').text());
    $('#e_no_sertifikat_kompetensi').val(_this.find('.no_sertifikat_kompetensi').text());
    $('#e_nomor_ijazah').val(_this.find('.nomor_ijazah').text());
    $('#e_tgl_berlaku_str').val(_this.find('.tgl_berlaku_str').text());
    $('#e_dokumen_str').val(_this.find('.dokumen_str').text());
});

$(document).on('click', '.delete_str', function() {
    var _this = $(this).parents('tr');
    $('.e_id').val(_this.find('.id').text());
    $('.d_dokumen_str').val(_this.find('.dokumen_str').text());
});

$('#name').on('change',function()
{
    $('#user_id').val($(this).find(':selected').data('user_id'));
    $('#nip').val($(this).find(':selected').data('nip'));
    $('#tempat_lahir').val($(this).find(':selected').data('tempat_lahir'));
    $('#tanggal_lahir').val($(this).find(':selected').data('tanggal_lahir'));
    $('#jenis_kelamin').val($(this).find(':selected').data('jenis_kelamin'));
    $('#pendidikan_terakhir').val($(this).find(':selected').data('pendidikan_terakhir'));
});