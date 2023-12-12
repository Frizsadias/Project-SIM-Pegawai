$(document).on('click', '.edit_agama', function() {
    var id = $(this).data('id');
    var agama = $(this).data('agama');
    $("#e_id").val(id);
    $("#agama_edit").val(agama);
});

$(document).on('click', '.delete_agama', function() {
    var id = $(this).data('id');
    $(".e_id").val(id);
});