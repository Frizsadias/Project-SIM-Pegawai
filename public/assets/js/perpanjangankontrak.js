$(document).on("click", ".edit_kontrak", function () {
    var _this = $(this).parents("tr");
    $("#e_id").val(_this.find(".id").text());
    $("#e_tempat_lahir").val(_this.find(".tempat_lahir").text());
    $("#e_tanggal_lahir").val(_this.find(".tanggal_lahir").text());
    $("#e_nik_blud").val(_this.find(".nik_blud").text());
    $("#e_pendidikan").val(_this.find(".pendidikan").text());
    $("#e_tahun_lulus").val(_this.find(".tahun_lulus").text());
    $("#e_jabatan").val(_this.find(".jabatan").text());
    $("#e_mulai_kontrak").val(_this.find(".mulai_kontrak").text());
    $("#e_akhir_kontrak").val(_this.find(".akhir_kontrak").text());
});

$(document).on("click", ".delete_perpanjangan", function () {
    var _this = $(this).parents("tr");
    $(".e_id").val(_this.find(".id").text());
});

$("#name").on("change", function () {
    $("#user_id").val($(this).find(":selected").data("user_id"));
    $("#nip").val($(this).find(":selected").data("nip"));
    $("#tempat_lahir").val($(this).find(":selected").data("tempat_lahir"));
    $("#tanggal_lahir").val($(this).find(":selected").data("tanggal_lahir"));
    $("#tingkat_pendidikan").val(
        $(this).find(":selected").data("tingkat_pendidikan")
    );
    $("#jabatan").val($(this).find(":selected").data("jabatan"));
});
