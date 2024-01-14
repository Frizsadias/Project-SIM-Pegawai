document.addEventListener("DOMContentLoaded", () => {
    const dropzoneBoxes = document.querySelectorAll(".dropzone-box");

    dropzoneBoxes.forEach((dropzoneBox, index) => {
        const inputElement = dropzoneBox.querySelector(
            ".dropzone-area input[type='file']"
        );
        const dropzoneElement = dropzoneBox.querySelector(".dropzone-area");

        inputElement.addEventListener("change", (e) => {
            handleFileUpload(dropzoneElement, inputElement.files[0]);
        });

        dropzoneElement.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropzoneElement.classList.add("dropzone--over");
        });

        ["dragleave", "dragend"].forEach((type) => {
            dropzoneElement.addEventListener(type, (e) => {
                dropzoneElement.classList.remove("dropzone--over");
            });
        });

        dropzoneElement.addEventListener("drop", (e) => {
            e.preventDefault();
            handleFileDrop(dropzoneElement, e.dataTransfer.files[0]);
        });
    });

    function handleFileUpload(dropzoneElement, file) {
        let dropzoneFileMessage = dropzoneElement.querySelector(
            `.message-preview${getIndex(dropzoneElement)}`
        );
        dropzoneFileMessage.innerHTML = `${file.name}, ${file.size} bytes`;

        // Handle file upload here
        // You may want to use XMLHttpRequest, fetch, or another method to send the file to the server
        // For example:
        // const formData = new FormData();
        // formData.append("file", file);
        // fetch("/upload-endpoint", {
        //     method: "POST",
        //     body: formData
        // }).then(response => {
        //     // Handle the response
        // });
    }

    function handleFileDrop(dropzoneElement, file) {
        const inputElement =
            dropzoneElement.querySelector("input[type='file']");
        inputElement.files = file;
        handleFileUpload(dropzoneElement, file);
        dropzoneElement.classList.remove("dropzone--over");
    }

    function getIndex(dropzoneElement) {
        const dropzoneBox = dropzoneElement.closest(".dropzone-box");
        const index = Array.from(dropzoneBoxes).indexOf(dropzoneBox);
        return index + 1;
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach((fileInput) => {
        fileInput.addEventListener("change", (event) => {
            handleFileChange(event.target);
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach((fileInput) => {
        fileInput.addEventListener("change", (event) => {
            handleFileChange(event.target);
        });
    });
});

function handleFileChange(input) {
    const dropzoneArea = input.closest(".dropzone-area");
    const filePreview1 = dropzoneArea.querySelector(".message-preview1");
    const filePreview2 = dropzoneArea.querySelector(".message-preview2");

    if (input.files.length > 0) {
        const file = input.files[0];
        if (input.id === "dokumen_skkp") {
            filePreview1.innerHTML = `${file.name}, ${file.size} bytes`;
        } else if (input.id === "dokumen_teknis_kp") {
            filePreview2.innerHTML = `${file.name}, ${file.size} bytes`;
        } 
    } else {
        filePreview1.innerHTML = "Tidak ada file yang di pilih";
        filePreview2.innerHTML = "Tidak ada file yang di pilih";
    }
}






