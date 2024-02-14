let formIsDirty = false;

document.querySelectorAll('input, textarea').forEach(element => {
    element.addEventListener('input', () => {
        formIsDirty = true;
    });
});

window.addEventListener("beforeunload", (event) => {
    if (formIsDirty) {
        event.preventDefault();
        event.returnValue = "Anda telah membuat perubahan yang belum disimpan. Apakah Anda yakin ingin meninggalkan halaman?";
    }
});