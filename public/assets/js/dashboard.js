document.addEventListener("DOMContentLoaded", function () {
    const dataCards = document.querySelectorAll(".container .col-md-56");
    const lihatSemuaTempatTidur = document.getElementById("lihatSemuaTempatTidur");
    const sembunyikanTempatTidur = document.getElementById("sembunyikanTempatTidur");
    let dataDitampilkan = 3;
    const aturVisibilitasData = () => {
        dataCards.forEach((card, index) => {
            if (index < dataDitampilkan) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    };
    aturVisibilitasData();
    lihatSemuaTempatTidur.addEventListener("click", () => {
        dataDitampilkan = dataCards.length;
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
});

document.addEventListener("DOMContentLoaded", function () {
    const dataCards = document.querySelectorAll(".container .col-md-4");
    const lihatSemuaJenisPegawai = document.getElementById("lihatSemuaJenisPegawai");
    const sembunyikanJenisPegawai = document.getElementById("sembunyikanJenisPegawai");
    let dataDitampilkan = 3;
    const aturVisibilitasData2 = () => {
        dataCards.forEach((card, index) => {
            if (index < dataDitampilkan) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    };
    aturVisibilitasData2();
    lihatSemuaJenisPegawai.addEventListener("click", () => {
        dataDitampilkan = dataCards.length;
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
});

document.addEventListener("DOMContentLoaded", function () {
    const dataCards = document.querySelectorAll(".container .col-md-4");
    const lihatSemuaPegawaiRuang = document.getElementById("lihatSemuaPegawaiRuang");
    const sembunyikanPegawaiRuang = document.getElementById("sembunyikanPegawaiRuang");
    let dataDitampilkan = 3;
    const aturVisibilitasData3 = () => {
        dataCards.forEach((card, index) => {
            if (index < dataDitampilkan) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    };
    aturVisibilitasData3();
    lihatSemuaPegawaiRuang.addEventListener("click", () => {
        dataDitampilkan = dataCards.length;
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
});