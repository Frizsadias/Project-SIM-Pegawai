//edit
$(document).on("click", ".edit_riwayat_hukuman", function () {
    var _this = $(this).parents("tr");
    $("#e_id_hukuman").val(_this.find(".id").text());
    $("#e_kategori_hukuman").val(_this.find(".kategori_hukuman").text());
    $("#e_tingkat_hukuman").val(_this.find(".tingkat_hukuman").text());
    $("#e_jenis_hukuman").val(_this.find(".jenis_hukuman").text());
    $("#e_no_sk_hukuman").val(_this.find(".no_sk_hukuman").text());
    $("#e_no_peraturan").val(_this.find(".no_peraturan").text());
    $("#e_alasan").val(_this.find(".alasan").text());
    $("#e_tanggal_sk_hukuman").val(_this.find(".tanggal_sk_hukuman").text());
    $("#e_masa_hukuman_tahun").val(_this.find(".masa_hukuman_tahun").text());
    $("#e_tmt_hukuman").val(_this.find(".tmt_hukuman").text());
    $("#e_masa_hukuman_bulan").val(_this.find(".masa_hukuman_bulan").text());
    $("#e_keterangan").val(_this.find(".keterangan").text());
    $("#e_dokumen_sk_hukuman").val(_this.find(".dokumen_sk_hukuman").text());
    $("#e_dokumen_sk_pengaktifan").val(
        _this.find(".dokumen_sk_pengaktifan").text()
    );
});

//delete
$(document).on("click", ".delete_riwayat_hukuman", function () {
    var _this = $(this).parents("tr");
    $(".e_id_hukuman").val(_this.find(".id").text());
    $(".d_dokumen_sk_hukuman").val(_this.find(".dokumen_sk_hukuman").text());
    $(".d_dokumen_sk_pengaktifan").val(
        _this.find(".dokumen_sk_pengaktifan").text()
    );
});