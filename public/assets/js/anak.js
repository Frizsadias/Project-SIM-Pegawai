$(document).on('click', '.edit_anak', function() {
    var _this = $(this).parents('tr');
    $('#e_id').val(_this.find('.id').text());
    $('#e_orang_tua').val(_this.find('.orang_tua').text());
    var statusPekerjaanAnak = _this.find('.status_pekerjaan_anak').text();
    if (statusPekerjaanAnak === 'Bukan PNS') {
        $('#bukan_pns').prop('checked', true);
    } else if (statusPekerjaanAnak === 'PNS') {
        $('#pns').prop('checked', true);
    }
    $('#e_nama_anak').val(_this.find('.nama_anak').text());
    var jenisKelamin = _this.find('.jenis_kelamin').text();
        if (jenisKelamin === 'Laki-Laki') {
            $('#laki_laki').prop('checked', true);
        } else if (jenisKelamin === 'Perempuan') {
            $('#perempuan').prop('checked', true);
        }
    $('#e_tanggal_lahir').val(_this.find('.tanggal_lahir').text());
    var statusAnak = _this.find('.status_anak').text();
    if (statusAnak === 'Kandung') {
        $('#kandung').prop('checked', true);
    } else if (statusAnak === 'Tiri') {
        $('#tiri').prop('checked', true);
    } else if (statusAnak === 'Angkat') {
        $('#angkat').prop('checked', true);
    }
    $('#e_jenis_dokumen').val(_this.find('.jenis_dokumen').text());
    $('#e_no_dokumen').val(_this.find('.no_dokumen').text());
    $('#e_agama').val(_this.find('.agama').text());
    var statusHidup = _this.find('.status_hidup').text();
    if (statusHidup === 'Hidup') {
        $('#hidup').prop('checked', true);
    } else if (statusHidup === 'Meninggal') {
        $('#meninggal').prop('checked', true);
    }
    $('#e_no_akta_kelahiran').val(_this.find('.no_akta_kelahiran').text());
    $('#e_dokumen_akta_kelahiran').val(_this.find('.dokumen_akta_kelahiran').text());
    $('#e_pas_foto').val(_this.find('.pas_foto').text());
});

$(document).on('click', '.delete_anak', function() {
    var _this = $(this).parents('tr');
    $('.e_id').val(_this.find('.id').text());
    $('.d_dokumen_akta_kelahiran').val(_this.find('.dokumen_akta_kelahiran').text());
    $('.d_pas_foto').val(_this.find('.pas_foto').text());
});

$(document).ready(function() {
    $('.exclusive').change(function() {
        if ($(this).prop('checked')) {
            $('.exclusive').not(this).prop('disabled', true);
        } else {
            $('.exclusive').prop('disabled', false);
        }
    });
});