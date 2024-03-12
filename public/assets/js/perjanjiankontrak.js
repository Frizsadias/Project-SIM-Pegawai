$(document).on('click', '.edit_kontrak', function() {
    var _this = $(this).parents('tr');
    $('#e_id').val(_this.find('.id').text());
    $('#e_nik_blud').val(_this.find('.nik_blud').text());
    $('#e_tahun_lulus').val(_this.find('.tahun_lulus').text());
    $('#e_mulai_kontrak').val(_this.find('.mulai_kontrak').text());
    $("#e_akhir_kontrak").val(_this.find('.akhir_kontrak').text());
});

$(document).on("click", ".delete_perjanjian", function() {
    var _this = $(this).parents("tr");
    $(".e_id").val(_this.find(".id").text());
});