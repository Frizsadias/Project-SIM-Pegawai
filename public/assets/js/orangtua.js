$(document).on('click', '.edit_ortu', function() {
    var _this = $(this).parents('tr');

    $('#e_id').val(_this.find('.id').text());
    $('#e_nama').val(_this.find('.nama').text());
    $('#e_tanggal_lahir').val(_this.find('.tanggal_lahir').text());
    $('#e_jenis_identitas').val(_this.find('.jenis_identitas').text());

    var jenisKelamin = _this.find('.jenis_kelamin').text();
    if (jenisKelamin === 'Laki-Laki') {
        $('#e_laki_laki').prop('checked', true);
    } else if (jenisKelamin === 'Perempuan') {
        $('#e_perempuan').prop('checked', true);
    }

    $('#e_agama').val(_this.find('.agama').text());
    $('#e_status_pernikahan').val(_this.find('.status_pernikahan').text());
    $('#e_alamat').val(_this.find('.alamat').text());
    $('#e_email').val(_this.find('.email').text());
    $('#e_nip').val(_this.find('.nip').text());
    $('#e_tanggal_meninggal').val(_this.find('.tanggal_meninggal').text());
    $('#e_no_hp').val(_this.find('.no_hp').text());
    $('#e_no_telepon').val(_this.find('.no_telepon').text());
    var statusHidup = _this.find('.status_hidup').text();
    if (statusHidup === 'Hidup') {
        $('#e_hidup').prop('checked', true);
    } else if (statusHidup === 'Meninggal') {
        $('#e_meninggal').prop('checked', true);
    }

    var statusPekerjaan = _this.find('.status_pekerjaan_ortu').text();
    if (statusPekerjaan === 'Bukan PNS') {
        $('#bukan_pns').prop('checked', true);
    } else if (statusPekerjaan === 'PNS') {
        $('#e_pns').prop('checked', true);
    }
    
    $('#e_dokumen_kk').val(_this.find('.dokumen_kk').text());
    $('#e_hidden_dokumen_kk').val(_this.find('.dokumen_kk').text());

    $('#e_dokumen_akta_lahir_anak').val(_this.find('.dokumen_akta_lahir_anak').text());
    $('#e_hidden_dokumen_akta_lahir_anak').val(_this.find('.dokumen_akta_lahir_anak').text());

    $('#e_pas_foto_ayah').val(_this.find('.pas_foto_ayah').text());
    $('#e_hidden_pas_foto_ayah').val(_this.find('.pas_foto_ayah').text());

    $('#e_pas_foto_ibu').val(_this.find('.pas_foto_ibu').text());
    $('#e_hidden_pas_foto_ibu').val(_this.find('.pas_foto_ibu').text());
});

$(document).on('click', '.delete_ortu', function() {
    var _this = $(this).parents('tr');
    $('.e_id').val(_this.find('.id').text());
    $('.d_dokumen_kk').val(_this.find('.dokumen_kk').text());
    $('.d_dokumen_akta_lahir_anak').val(_this.find('.dokumen_akta_lahir_anak').text());
    $('.d_pas_foto_ayah').val(_this.find('.pas_foto_ayah').text());
    $('.d_pas_foto_ibu').val(_this.find('.pas_foto_ibu').text());
});

$(document).ready(function() {
    $('input[name="status_hidup"]').click(function() {
        if ($(this).val() == 'Hidup') {
            $('#tanggal-meninggal').hide();
        } else {
            $('#tanggal-meninggal').show();
        }
    });
});

$(document).ready(function() {
    $('input[name="status_pekerjaan_ortu"]').click(function() {
        if ($(this).val() === "PNS") {
            $('#show_nip').show();
        } else {
            $('#show_nip').hide();
        }
    });
});