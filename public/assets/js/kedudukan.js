$(document).on('click', '.edit_kedudukan', function() {
    var id = $(this).data('id');
    var kedudukan = $(this).data('kedudukan');
    $("#e_id").val(id);
    $("#kedudukan_edit").val(kedudukan);
});

$(document).on('click', '.delete_kedudukan', function() {
    var id = $(this).data('id');
    $(".e_id").val(id);
});