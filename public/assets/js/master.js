$(document).ready(function() {
    $("#open-popup").click(function() {
        $("#popup-ulangtahun").fadeIn();
    });
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('close-popup').addEventListener('click', function() {
        document.querySelector('#popup-ulangtahun').style.display = 'none';
    });
});
