document.addEventListener('DOMContentLoaded', function() {
    // Indicator Kata Sandi 1 //
    const passwordInput1 = document.getElementById('passwordInput1');
    const IndicatorKekuatan1 = document.getElementById('indicator-kata-sandi-1');
    var IndicatorLemahBefore1 = document.querySelector(".kata-sandi-lemah-before-1");
    var IndicatorSedangBefore1 = document.querySelector(".kata-sandi-sedang-before-1");
    var IndicatorLemahAfter1 = document.querySelector(".kata-sandi-lemah-after-1");
    var IndicatorSedangAfter1 = document.querySelector(".kata-sandi-sedang-after-1");
    const IndicatorTulisan1 = document.getElementById('indicator-kata-sandi-tulisan-1');

    passwordInput1.addEventListener('input', function() {
        const password1 = passwordInput1.value.trim();
        if (password1 === '') {
            IndicatorKekuatan1.style.display = 'none';
            IndicatorLemahBefore1.style.display = 'none';
            IndicatorSedangBefore1.style.display = 'none';
            IndicatorLemahAfter1.style.display = 'none';
            IndicatorSedangAfter1.style.display = 'none';
            IndicatorTulisan1.textContent = '';
        } else {
            const strength1 = kekuatanKataSandi1(password1);
            perbaharuiIndicatorKataSandi1(strength1);
        }
    });

    function kekuatanKataSandi1(password1) {
        if (/[a-z]/.test(password1)) {
            if (/\d+/.test(password1)) {
                if (/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/.test(password1)) {
                    return 'kuat';
                } else {
                    return 'sedang';
                }
            } else {
                return 'lemah';
            }
        } else {
            return 'lemah';
        }
    }

    function perbaharuiIndicatorKataSandi1(strength1) {
        IndicatorKekuatan1.style.display = '';
        IndicatorKekuatan1.className = '';
        IndicatorLemahBefore1.style.display = 'block';
        IndicatorSedangBefore1.style.display = 'block';
        IndicatorLemahAfter1.style.display = 'block';
        IndicatorSedangAfter1.style.display = 'block';
    
        if (strength1 === 'lemah') {
            IndicatorKekuatan1.classList.add('kata-sandi-lemah');
            IndicatorLemahBefore1.classList.add('kata-sandi-lemah-before-1');
            IndicatorSedangBefore1.classList.add('kata-sandi-sedang-before-1');
            IndicatorLemahAfter1.classList.remove('kata-sandi-lemah-after-1');
            IndicatorSedangAfter1.classList.remove('kata-sandi-sedang-after-1');
            IndicatorTulisan1.textContent = 'Kata Sandi Lemah';
            IndicatorTulisan1.style.color = '#ff4757';
    
        } else if (strength1 === 'sedang') {
            IndicatorKekuatan1.classList.add('kata-sandi-sedang');
            IndicatorLemahAfter1.classList.add('kata-sandi-lemah-after-1');
            IndicatorSedangBefore1.classList.add('kata-sandi-sedang-before-1');
            IndicatorLemahBefore1.classList.remove('kata-sandi-lemah-before-1');
            IndicatorSedangAfter1.classList.remove('kata-sandi-sedang-after-1');
            IndicatorTulisan1.textContent = 'Kata Sandi Sedang';
            IndicatorTulisan1.style.color = 'orange';

        } else {
            IndicatorKekuatan1.classList.add('kata-sandi-kuat');
            IndicatorLemahAfter1.classList.add('kata-sandi-lemah-after-1');
            IndicatorSedangAfter1.classList.add('kata-sandi-sedang-after-1');
            IndicatorLemahBefore1.classList.remove('kata-sandi-lemah-before-1');
            IndicatorSedangBefore1.classList.remove('kata-sandi-sedang-before-1');
            IndicatorTulisan1.textContent = 'Kata Sandi Kuat';
            IndicatorTulisan1.style.color = '#23ad5c';
        }
    }
    // /Indicator Kata Sandi 1 //

    // Indicator Kata Sandi 2 //
    const passwordInput2 = document.getElementById('passwordInput2');
    const IndicatorKekuatan2 = document.getElementById('indicator-kata-sandi-2');
    var IndicatorLemahBefore2 = document.querySelector(".kata-sandi-lemah-before-2");
    var IndicatorSedangBefore2 = document.querySelector(".kata-sandi-sedang-before-2");
    var IndicatorLemahAfter2 = document.querySelector(".kata-sandi-lemah-after-2");
    var IndicatorSedangAfter2 = document.querySelector(".kata-sandi-sedang-after-2");
    const IndicatorTulisan2 = document.getElementById('indicator-kata-sandi-tulisan-2');

    passwordInput2.addEventListener('input', function() {
        const password2 = passwordInput2.value.trim();
        if (password2 === '') {
            IndicatorKekuatan2.style.display = 'none';
            IndicatorLemahBefore2.style.display = 'none';
            IndicatorSedangBefore2.style.display = 'none';
            IndicatorLemahAfter2.style.display = 'none';
            IndicatorSedangAfter2.style.display = 'none';
            IndicatorTulisan2.textContent = '';
        } else {
            const strength2 = kekuatanKataSandi2(password2);
            perbaharuiIndicatorKataSandi2(strength2);
        }
    });

    function kekuatanKataSandi2(password2) {
        if (/[a-z]/.test(password2)) {
            if (/\d+/.test(password2)) {
                if (/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/.test(password2)) {
                    return 'kuat';
                } else {
                    return 'sedang';
                }
            } else {
                return 'lemah';
            }
        } else {
            return 'lemah';
        }
    }

    function perbaharuiIndicatorKataSandi2(strength2) {
        IndicatorKekuatan2.style.display = '';
        IndicatorKekuatan2.className = '';
        IndicatorLemahBefore2.style.display = 'block';
        IndicatorSedangBefore2.style.display = 'block';
        IndicatorLemahAfter2.style.display = 'block';
        IndicatorSedangAfter2.style.display = 'block';

        if (strength2 === 'lemah') {
            IndicatorKekuatan2.classList.add('kata-sandi-lemah');
            IndicatorLemahBefore2.classList.add('kata-sandi-lemah-before-2');
            IndicatorSedangBefore2.classList.add('kata-sandi-sedang-before-2');
            IndicatorLemahAfter2.classList.remove('kata-sandi-lemah-after-2');
            IndicatorSedangAfter2.classList.remove('kata-sandi-sedang-after-2');
            IndicatorTulisan2.textContent = 'Kata Sandi Lemah';
            IndicatorTulisan2.style.color = '#ff4757';

        } else if (strength2 === 'sedang') {
            IndicatorKekuatan2.classList.add('kata-sandi-sedang');
            IndicatorLemahAfter2.classList.add('kata-sandi-lemah-after-2');
            IndicatorSedangBefore2.classList.add('kata-sandi-sedang-before-2');
            IndicatorLemahBefore2.classList.remove('kata-sandi-lemah-before-2');
            IndicatorSedangAfter2.classList.remove('kata-sandi-sedang-after-2');
            IndicatorTulisan2.textContent = 'Kata Sandi Sedang';
            IndicatorTulisan2.style.color = 'orange';

        } else {
            IndicatorKekuatan2.classList.add('kata-sandi-kuat');
            IndicatorLemahAfter2.classList.add('kata-sandi-lemah-after-2');
            IndicatorSedangAfter2.classList.add('kata-sandi-sedang-after-2');
            IndicatorLemahBefore2.classList.remove('kata-sandi-lemah-before-2');
            IndicatorSedangBefore2.classList.remove('kata-sandi-sedang-before-2');
            IndicatorTulisan2.textContent = 'Kata Sandi Kuat';
            IndicatorTulisan2.style.color = '#23ad5c';
        }
    }
    // /Indicator Kata Sandi 2 //
});