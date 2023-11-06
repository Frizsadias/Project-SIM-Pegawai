document.addEventListener("DOMContentLoaded", function () {
    const dataCards = document.querySelectorAll(".container .col-md-56");
    const lihatSemuaTempatTidur = document.getElementById(
        "lihatSemuaTempatTidur"
    );
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
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const dataCards = document.querySelectorAll(".container .col-md-4");
    const lihatSemuaJenisPegawai = document.getElementById(
        "lihatSemuaJenisPegawai"
    );
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
    });
});
