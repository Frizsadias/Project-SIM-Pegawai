document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = function(passwordInput, icon) {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    };
    const showPassword = function(inputField, icon, toggleButton) {
        toggleButton.addEventListener('click', function() {
            togglePassword(inputField, icon);
        });
    };
    const passwordInput1 = document.getElementById('passwordInput1');
    const icon1 = document.getElementById('icon1');
    const showPasswordToggle1 = document.getElementById('tampilkanPassword1');
    showPassword(passwordInput1, icon1, showPasswordToggle1);
    const passwordInput2 = document.getElementById('passwordInput2');
    const icon2 = document.getElementById('icon2');
    const showPasswordToggle2 = document.getElementById('tampilkanPassword2');
    showPassword(passwordInput2, icon2, showPasswordToggle2);
    const passwordInput3 = document.getElementById('passwordInput3');
    const icon3 = document.getElementById('icon3');
    const showPasswordToggle3 = document.getElementById('tampilkanPassword3');
    showPassword(passwordInput3, icon3, showPasswordToggle3);
});
