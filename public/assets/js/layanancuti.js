$(document).on('click', '.edit_layanan_cuti', function()
{
    var _this = $(this).parents('tr');
    $('#e_id').val(_this.find('.id').text());
    $('#e_lama_cuti').val(_this.find('.lama_cuti').text());
    $('#e_tanggal_mulai_cuti').val(_this.find('.tanggal_mulai_cuti').text());
    $('#e_tanggal_selesai_cuti').val(_this.find('.tanggal_selesai_cuti').text());
    $('#e_dokumen_kelengkapan').val(_this.find('.dokumen_kelengkapan').text());
    $('#e_dokumen_rekomendasi').val(_this.find('.dokumen_rekomendasi').text());

    var jenis_cuti = (_this.find(".jenis_cuti").text());
    var _option = '<option selected value="' + jenis_cuti + '">' + _this.find('.jenis_cuti')
        .text() + '</option>'
    $(_option).appendTo("#e_jenis_cuti");
});

$('#name').on('change',function()
{
    $('#user_id').val($(this).find(':selected').data('user_id'));
    $('#nip').val($(this).find(':selected').data('nip'));
});