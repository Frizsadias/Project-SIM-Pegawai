//edit
$(document).on("click", ".edit_riwayat_penghargaan", function () {
    var _this = $(this).parents("tr");
    $("#e_id_penghargaan").val(_this.find(".id").text());
    $("#e_jenis_penghargaan").val(_this.find(".jenis_penghargaan").text());
    $("#e_tahun_perolehan").val(_this.find(".tahun_perolehan").text());
    $("#e_no_surat").val(_this.find(".no_surat").text());
    $("#e_tanggal_keputusan").val(_this.find(".tanggal_keputusan").text());
    $("#e_dokumen_penghargaan").val(_this.find(".dokumen_penghargaan").text());
});

//delete
$(document).on("click", ".delete_riwayat_penghargaan", function () {
    var _this = $(this).parents("tr");
    $(".e_id_penghargaan").val(_this.find(".id").text());
    $(".d_dokumen_penghargaan").val(_this.find(".dokumen_penghargaan").text());
});