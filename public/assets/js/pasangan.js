$(document).on('click', '.edit_pasangan', function() {
    var _this = $(this).parents('tr');
    $('#e_id').val(_this.find('.id').text());
    $('#e_suami_istri_ke').val(_this.find('.suami_istri_ke').text());
    var statusPekerjaan = _this.find('.status_pekerjaan_pasangan').text();
    if (statusPekerjaan === 'Bukan PNS') {
        $('#bukan_pns').prop('checked', true);
    } else if (statusPekerjaan === 'PNS') {
        $('#pns').prop('checked', true);
    }
    $('#e_nip').val(_this.find('.nip').text());
    $('#e_status_pernikahan').val(_this.find('.status_pernikahan').text());
    $('#e_nama').val(_this.find('.nama').text());
    $('#e_tanggal_lahir').val(_this.find('.tanggal_lahir').text());
    $('#e_jenis_identitas').val(_this.find('.jenis_identitas').text());
    var jenisKelamin = _this.find('.jenis_kelamin').text();
    if (jenisKelamin === 'Laki-Laki') {
        $('#laki_laki').prop('checked', true);
    } else if (jenisKelamin === 'Perempuan') {
        $('#perempuan').prop('checked', true);
    }
    $('#e_agama').val(_this.find('.agama').text());
    var statusHidup = _this.find('.status_hidup').text();
    if (statusHidup === 'Hidup') {
        $('#hidup').prop('checked', true);
    } else if (statusHidup === 'Meninggal') {
        $('#meninggal').prop('checked', true);
    }
    $('#e_no_karis_karsu').val(_this.find('.no_karis_karsu').text());
    $('#e_alamat').val(_this.find('.alamat').text());
    $('#e_no_hp').val(_this.find('.no_hp').text());
    $('#e_no_telepon').val(_this.find('.no_telepon').text());
    $('#e_email').val(_this.find('.email').text());
    $('#e_dokumen_nikah').val(_this.find('.dokumen_nikah').text());
    $('#e_pas_foto').val(_this.find('.pas_foto').text());
});

$(document).on('click', '.delete_pasangan', function() {
    var _this = $(this).parents('tr');
    $('.e_id').val(_this.find('.id').text());
    $('.d_dokumen_nikah').val(_this.find('.dokumen_nikah').text());
    $('.d_pas_foto').val(_this.find('.pas_foto').text());
});

$(document).ready(function() {
    $('input[name="status_pekerjaan_pasangan"]').click(function() {
        if ($(this).val() === "PNS") {
            $('#show_nip').show();
        } else {
            $('#show_nip').hide();
        }
    });
});