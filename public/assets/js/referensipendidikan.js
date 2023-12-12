$(document).on('click', '.edit_pendidikan', function() {
    var id = $(this).data('id');
    var pendidikan = $(this).data('pendidikan');
    var tk_pendidikan_id = $(this).data('tk_pendidikan_id');
    var status_pendidikan = $(this).data('status_pendidikan');
    $("#e_id").val(id);
    $("#pendidikan_edit").val(pendidikan);
    $("#tk_pendidikan_id_edit").val(tk_pendidikan_id);
    $("#status_pendidikan_edit").val(status_pendidikan);
});

$(document).on('click', '.delete_pendidikan', function() {
    var id = $(this).data('id');
    $(".e_id").val(id);
});