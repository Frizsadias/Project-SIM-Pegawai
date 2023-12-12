$(document).on('click', '.edit_status', function() {
    var id = $(this).data('id');
    var jenis_pegawai = $(this).data('jenis_pegawai');
    var id_jenis_pegawai = $(this).data('id_jenis_pegawai');
    $("#e_id").val(id);
    $("#id_status_edit").val(id_jenis_pegawai);
    $("#status_edit").val(jenis_pegawai);
});

$(document).on('click', '.delete_status', function() {
    var id = $(this).data('id');
    $(".e_id").val(id);
});