let formIsDirty = false;

document.querySelectorAll('input, textarea').forEach(element => {
    element.addEventListener('input', () => {
        formIsDirty = true;
    });
});

document.querySelectorAll('form').forEach(element => {
    element.addEventListener('submit', () => {
        formIsDirty = false;
    });
});

window.addEventListener("beforeunload", (event) => {
    if (formIsDirty) {
        event.preventDefault();
        event.returnValue = "Anda telah membuat perubahan yang belum disimpan. Apakah Anda yakin ingin meninggalkan halaman?";
    }
});