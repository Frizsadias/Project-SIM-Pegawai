// update
$(document).on("click", ".edit_riwayat_angka_kredit", function () {
    var _this = $(this).parents("tr");
    $("#e_id_ak").val(_this.find(".id").text());
    $("#e_nomor_sk").val(_this.find(".nomor_sk").text());
    $("#e_tanggal_sk_ak").val(_this.find(".tanggal_sk").text());
    $("#e_angka_kredit_pertama").prop(
        "checked",
        _this.find(".angka_kredit_pertama").text() === "Angka Kredit Pertama"
    );
    $("#e_integrasi").prop(
        "checked",
        _this.find(".integrasi").text() === "Integrasi"
    );
    $("#e_konversi").prop(
        "checked",
        _this.find(".konversi").text() === "Konversi"
    );
    $("#e_bulan_mulai").val(_this.find(".bulan_mulai").text());
    $("#e_tahun_mulai").val(_this.find(".tahun_mulai").text());
    $("#e_bulan_selesai").val(_this.find(".bulan_selesai").text());
    $("#e_tahun_selesai").val(_this.find(".tahun_selesai").text());
    $("#e_angka_kredit_utama").val(_this.find(".angka_kredit_utama").text());
    $("#e_angka_kredit_penunjang").val(
        _this.find(".angka_kredit_penunjang").text()
    );
    $("#e_total_angka_kredit").val(_this.find(".total_angka_kredit").text());

    var nama_jabatan = _this.find(".nama_jabatan").text();
    var _option =
        '<option selected value="' +
        nama_jabatan +
        '">' +
        _this.find(".nama_jabatan").text() +
        "</option>";
    $(_option).appendTo("#e_nama_jabatan");
});

//delete
$(document).on("click", ".delete_riwayat_angka_kredit", function () {
    var _this = $(this).parents("tr");
    $(".e_id_ak").val(_this.find(".id").text());
});
