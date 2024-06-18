document.addEventListener("DOMContentLoaded", function () {
    const tempatTidurCards = document.querySelectorAll(".container .col-md-56");
    const lihatSemuaTempatTidur = document.getElementById("lihatSemuaTempatTidur");
    const sembunyikanTempatTidur = document.getElementById("sembunyikanTempatTidur");
    let dataDitampilkan = 3;
    const aturVisibilitasData = () => {
        tempatTidurCards.forEach((card, index) => {
            if (index < dataDitampilkan) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    };
    if (lihatSemuaTempatTidur && sembunyikanTempatTidur) {
        aturVisibilitasData();
        lihatSemuaTempatTidur.addEventListener("click", () => {
            dataDitampilkan = tempatTidurCards.length;
            aturVisibilitasData();
            lihatSemuaTempatTidur.style.display = "none";
            sembunyikanTempatTidur.style.display = "block";
        });
        sembunyikanTempatTidur.addEventListener("click", () => {
            dataDitampilkan = 3;
            aturVisibilitasData();
            sembunyikanTempatTidur.style.display = "none";
            lihatSemuaTempatTidur.style.display = "block";
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const jenisPegawaiCards = document.querySelectorAll(".container .col-md-4");
    const lihatSemuaJenisPegawai = document.getElementById("lihatSemuaJenisPegawai");
    const sembunyikanJenisPegawai = document.getElementById("sembunyikanJenisPegawai");
    let dataDitampilkan = 3;
    const aturVisibilitasData2 = () => {
        jenisPegawaiCards.forEach((card, index) => {
            if (index < dataDitampilkan) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    };
    if (lihatSemuaJenisPegawai && sembunyikanJenisPegawai) {
        aturVisibilitasData2();
        lihatSemuaJenisPegawai.addEventListener("click", () => {
            dataDitampilkan = jenisPegawaiCards.length;
            aturVisibilitasData2();
            lihatSemuaJenisPegawai.style.display = "none";
            sembunyikanJenisPegawai.style.display = "block";
        });
        sembunyikanJenisPegawai.addEventListener("click", () => {
            dataDitampilkan = 3;
            aturVisibilitasData2();
            sembunyikanJenisPegawai.style.display = "none";
            lihatSemuaJenisPegawai.style.display = "block";
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const pegawaiRuangCards = document.querySelectorAll(".container .col-md-4");
    const lihatSemuaPegawaiRuang = document.getElementById("lihatSemuaPegawaiRuang");
    const sembunyikanPegawaiRuang = document.getElementById("sembunyikanPegawaiRuang");
    let dataDitampilkan = 3;
    const aturVisibilitasData3 = () => {
        pegawaiRuangCards.forEach((card, index) => {
            if (index < dataDitampilkan) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    };
    if (lihatSemuaPegawaiRuang && sembunyikanPegawaiRuang) {
        aturVisibilitasData3();
        lihatSemuaPegawaiRuang.addEventListener("click", () => {
            dataDitampilkan = pegawaiRuangCards.length;
            aturVisibilitasData3();
            lihatSemuaPegawaiRuang.style.display = "none";
            sembunyikanPegawaiRuang.style.display = "block";
        });
        sembunyikanPegawaiRuang.addEventListener("click", () => {
            dataDitampilkan = 3;
            aturVisibilitasData3();
            sembunyikanPegawaiRuang.style.display = "none";
            lihatSemuaPegawaiRuang.style.display = "block";
        });
    }
});