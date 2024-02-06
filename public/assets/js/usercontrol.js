$(document).on('click', '.userUpdate', function() {
    var _this = $(this).parents('tr');
    $('#e_id').val(_this.find('.user_id').text());
    $('#e_name').val(_this.find('.name').text());
    $('#e_email').val(_this.find('.email').text());
    $('#e_role_name').val(_this.find('.role_name').text()).change();
    $('#e_nip').val(_this.find('.nip').text());
    $('#e_no_dokumen').val(_this.find('.no_dokumen').text());
    $('#e_status').val(_this.find('.status_s').text()).change();
});

$(document).on('click', '.userDelete', function() {
    var _this = $(this).parents('tr');
    $('.e_id').val(_this.find('.id').data('id'));
    $('#e_avatar').val(_this.find('.avatar').data('avatar'));
});