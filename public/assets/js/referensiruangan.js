$(document).on('click', '.edit_ruangan', function() {
    var id = $(this).data('id');
    var ruangan = $(this).data('ruangan');
    var jumlah_tempat_tidur = $(this).data('jumlah_tempat_tidur');
    $("#e_id").val(id);
    $("#ruangan_edit").val(ruangan);
    $("#jumlah_tempat_tidur_edit").val(jumlah_tempat_tidur);
});

$(document).on('click', '.delete_ruangan', function() {
    var id = $(this).data('id');
    $(".e_id").val(id);
});