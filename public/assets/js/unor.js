$(document).on("click", ".edit_unit_organisasi", function () {
    var _this = $(this).parents("tr");
    $("#e_id").val(_this.find(".id").text());
    $("#unor_id_edit").val(_this.find(".unor_id").text());
    $("#unor_nama_edit").val(_this.find(".unor_nama").text());
});

$(document).on("click", ".delete_unit_organisasi", function () {
    var _this = $(this).parents("tr");
    $(".e_id").val(_this.find(".id").text());
});
