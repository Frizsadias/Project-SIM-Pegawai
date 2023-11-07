let showAll = true;
document.querySelectorAll('.dropdown.status-persetujuan-user').forEach(function(elem) {
    elem.style.display = 'none';
});
document.getElementById('lihatSemua').addEventListener('click', function() {
    if (showAll) {
        document.querySelectorAll('.dropdown.status-persetujuan-user').forEach(function(elem) {
            elem.style.display = 'block';
        });
        showAll = false;
        document.getElementById('lihatSemua').innerHTML = '<i class="fa fa-eye"></i> Sembunyikan';
        document.getElementById('icon2').classList.remove('fa-eye-slash');
        document.getElementById('icon2').classList.add('fa-eye');
    } else {
        document.querySelectorAll('.dropdown.status-persetujuan-user').forEach(function(elem) {
            elem.style.display = 'none';
        });
        showAll = true;
        document.getElementById('lihatSemua').innerHTML = '<i class="fa fa-eye-slash"></i> Lihat Semua Progress';
        document.getElementById('icon2').classList.remove('fa-eye');
        document.getElementById('icon2').classList.add('fa-eye-slash');
    }
});
