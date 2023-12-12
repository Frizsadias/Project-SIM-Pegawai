$(document).on('click', '.edit_sumpah', function() {
    var id = $(this).data('id');
    var sumpah = $(this).data('sumpah');
    $("#e_id").val(id);
    $("#sumpah_edit").val(sumpah);
});

$(document).on('click', '.delete_sumpah', function() {
    var id = $(this).data('id');
    $(".e_id").val(id);
});