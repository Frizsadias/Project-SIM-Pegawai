$(document).on('click', '.edit_Kinerja', function() {
    var _this = $(this).parents('tr');
    $('#e_id').val(_this.find('.id').text());
    $('#e_bentuk_perjanjian').val(_this.find('.bentuk_perjanjian').text());
});

$(document).on("click", ".delete_kinerja", function() {
    var _this = $(this).parents("tr");
    $(".e_id").val(_this.find(".id").text());
});

$('#name').on('change', function() {
    $('#user_id').val($(this).find(':selected').data('user_id'));
    $('#nip').val($(this).find(':selected').data('nip'));
    $('#jabatan').val($(this).find(':selected').data('jabatan'));
});