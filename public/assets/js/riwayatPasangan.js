// Perbaharui Data
 $(document).on("click", ".edit_riwayat_pasangan", function () {
     var _this = $(this).parents("tr");
     $("#e_id_pasangan").val(_this.find(".id").text());
     $("#e_suami_istri_ke").val(_this.find(".suami_istri_ke").text());

     var statusPekerjaan = _this.find(".status_pekerjaan_pasangan").text();
     if (statusPekerjaan === "Bukan PNS") {
         $("#bukan_pns_pasangan").prop("checked", true);
         $("#show_nip3").hide();
         $("#show_nip3 input").val('');
     } else if (statusPekerjaan === 'PNS') {
         $("#pns_pasangan").prop("checked", true);
         $("#show_nip3").show();
     }
     $("input[name='status_pekerjaan_pasangan']").click(function() {
         if ($(this).val() === "PNS") {
             $("#show_nip3").show();
         } else {
             $("#show_nip3").hide();
             $("#show_nip3 input").val('');
         }
     });

     $("#e_nip_pasangan").val(_this.find(".nip").text());
     $("#e_status_pernikahan_pasangan").val(_this.find(".status_pernikahan").text());
     $("#e_nama_pasangan").val(_this.find(".nama").text());
     $("#e_tanggal_lahir_pasangan").val(_this.find(".tanggal_lahir").text());
     $("#e_jenis_identitas_pasangan").val(_this.find(".jenis_identitas").text());
     
     var jenisKelamin = _this.find(".jenis_kelamin").text();
     if (jenisKelamin === "Laki-Laki") {
         $("#laki_laki").prop("checked", true);
     } else if (jenisKelamin === "Perempuan") {
         $("#perempuan").prop("checked", true);
     }
     $("#e_agama_pasangan").val(_this.find(".agama").text());

     var statusHidup = _this.find(".status_hidup").text();
     if (statusHidup === "Hidup") {
         $("#hidup").prop("checked", true);
     } else if (statusHidup === "Meninggal") {
         $("#meninggal").prop("checked", true);
     }

     $("#e_no_karis_karsu").val(_this.find(".no_karis_karsu").text());
     $("#e_alamat_pasangan").val(_this.find(".alamat").text());
     $("#e_no_hp_pasangan").val(_this.find(".no_hp").text());
     $("#e_no_telepon_pasangan").val(_this.find(".no_telepon").text());
     $("#e_email_pasangan").val(_this.find(".email").text());
     $("#e_dokumen_nikah").val(_this.find(".dokumen_nikah").text());
     $("#e_pas_foto_pasangan").val(_this.find(".pas_foto").text());
 });

 // Hapus data
 $(document).on("click", ".delete_pasangan", function () {
     var _this = $(this).parents("tr");
     $(".e_id_pasangan").val(_this.find(".id").text());
     $(".d_dokumen_nikah").val(_this.find(".dokumen_nikah").text());
     $(".d_pas_foto").val(_this.find(".pas_foto").text());
 });

$(document).ready(function () {
    $('input[name="status_pekerjaan_pasangan"]').click(function () {
        if ($(this).val() === "PNS") {
            $("#show_nip_pasangan").show();
        } else {
            $("#show_nip_pasangan").hide();
        }
    });
});