$(document).on('click', '.edit_ref_golongan', function() {
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    var nama_golongan = $(this).data('nama_golongan');
    $("#e_id").val(id);
    $("#nama_edit").val(nama);
    $("#nama_golongan_edit").val(nama_golongan);
});

$(document).on('click', '.delete_ref_golongan', function() {
    var id = $(this).data('id');
    $(".e_id_del").val(id);
});