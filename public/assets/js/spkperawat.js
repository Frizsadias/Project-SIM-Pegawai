$(document).on('click', '.edit_spk_perawat', function()
{
    var _this = $(this).parents('tr');
    $('#e_id').val(_this.find('.id').text());
    $('#e_unit_kerja').val(_this.find('.unit_kerja').text());
    $('#e_nomor_sip').val(_this.find('.nomor_sip').text());
    $('#e_tanggal_terbit').val(_this.find('.tanggal_terbit').text());
    $('#e_tanggal_berlaku').val(_this.find('.tanggal_berlaku').text());
    $('#e_ruangan').val(_this.find('.ruangan').text());
    $('#e_dokumen_sip').val(_this.find('.dokumen_sip').text());
});

$('#name').on('change',function()
{
    $('#user_id').val($(this).find(':selected').data('user_id'));
    $('#nip').val($(this).find(':selected').data('nip'));
});