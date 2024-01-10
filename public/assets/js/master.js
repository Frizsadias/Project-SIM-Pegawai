$(document).ready(function() {
    $("#open-popup").click(function() {
        $("#popup-notifikasi").fadeIn();
    });
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('close-popup').addEventListener('click', function() {
        document.querySelector('#popup-notifikasi').style.display = 'none';
    });
});
