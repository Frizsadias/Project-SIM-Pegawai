document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('katasandi');
    const showPasswordToggle = document.getElementById('tampilkanPassword');

    showPasswordToggle.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('katasandilama');
    const showPasswordToggle = document.getElementById('tampilkanPasswordLama');

    showPasswordToggle.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('katasandibaru');
    const showPasswordToggle = document.getElementById('tampilkanPasswordBaru');

    showPasswordToggle.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('katasandikonfirmasi');
    const showPasswordToggle = document.getElementById('tampilkanPasswordKonfirmasi');

    showPasswordToggle.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
});