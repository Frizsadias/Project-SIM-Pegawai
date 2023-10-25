//Edit
$(document).on("click", ".edit_layanan_kgb", function () {
    var _this = $(this).parents("tr");
    $("#e_id").val(_this.find(".id").text());
    $("#e_golongan_awal").val(_this.find(".golongan_awal").text());
    $("#e_golongan_akhir").val(_this.find(".golongan_akhir").text());
    $("#e_gapok_lama").val(_this.find(".gapok_lama").text());
    $("#e_gapok_baru").val(_this.find(".gapok_baru").text());
    $("#e_tgl_sk_kgb").val(_this.find(".tgl_sk_kgb").text());
    $("#e_no_sk_kgb").val(_this.find(".no_sk_kgb").text());
    $("#e_tgl_berlaku").val(_this.find(".tgl_berlaku").text());
    $("#e_masa_kerja_golongan").val(_this.find(".masa_kerja_golongan").text());
    $("#e_masa_kerja").val(_this.find(".masa_kerja").text());
    $("#e_tmt_kgb").val(_this.find(".tmt_kgb").text());
});

$("#name").on("change", function () {
    $("#user_id").val($(this).find(":selected").data("user_id"));
    $("#nip").val($(this).find(":selected").data("nip"));
});
