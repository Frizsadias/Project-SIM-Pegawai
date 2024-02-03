// File Upload 1 //
const dropzoneBox1 = document.
getElementsByClassName("dropzone-box-1")
[0];

const inputFiles1 = document.
querySelectorAll(
    ".dropzone-area-1 input[type='file']"
);

const inputElement1 = inputFiles1[0];

const dropZoneElement1 = inputElement1.
closest(".dropzone-area-1");

inputElement1.addEventListener("change",
(e) => {
    if (inputElement1.files.length) {
        updateDropzoneFileList1
        (dropZoneElement1, inputElement1.files
            [0]);
    }
});

dropZoneElement1.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement1.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement1.addEventListener(type,
        (e) => {
            dropZoneElement1.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement1.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement1.files = e.dataTransfer.
        files;

        updateDropzoneFileList1
        (dropZoneElement1, e.dataTransfer.
        files[0]);
    }

    dropZoneElement1.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList1 = 
(dropzoneElement1, file) => {
    let dropzoneFileMessage = 
    dropzoneElement1.querySelector(".info-draganddrop-1");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox1.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement1.querySelector(".info-draganddrop-1");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox1.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-1");
    console.log(myFiled.files[0]);
});

// File Upload 2 //
const dropzoneBox2 = document.
getElementsByClassName("dropzone-box-2")
[0];

const inputFiles2 = document.
querySelectorAll(
    ".dropzone-area-2 input[type='file']"
);

const inputElement2 = inputFiles2[0];

const dropZoneElement2 = inputElement2.
closest(".dropzone-area-2");

inputElement2.addEventListener("change",
(e) => {
    if (inputElement2.files.length) {
        updateDropzoneFileList2
        (dropZoneElement2, inputElement2.files
            [0]);
    }
});

dropZoneElement2.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement2.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement2.addEventListener(type,
        (e) => {
            dropZoneElement2.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement2.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement2.files = e.dataTransfer.
        files;

        updateDropzoneFileList2
        (dropZoneElement2, e.dataTransfer.
        files[0]);
    }

    dropZoneElement2.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList2 = 
(dropzoneElement2, file) => {
    let dropzoneFileMessage = 
    dropzoneElement2.querySelector(".info-draganddrop-2");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox2.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement2.querySelector(".info-draganddrop-2");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox2.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-2");
    console.log(myFiled.files[0]);
});

// File Upload 3 //
const dropzoneBox3 = document.
getElementsByClassName("dropzone-box-3")
[0];

const inputFiles3 = document.
querySelectorAll(
    ".dropzone-area-3 input[type='file']"
);

const inputElement3 = inputFiles3[0];

const dropZoneElement3 = inputElement3.
closest(".dropzone-area-3");

inputElement3.addEventListener("change",
(e) => {
    if (inputElement3.files.length) {
        updateDropzoneFileList3
        (dropZoneElement3, inputElement3.files
            [0]);
    }
});

dropZoneElement3.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement3.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement3.addEventListener(type,
        (e) => {
            dropZoneElement3.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement3.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement3.files = e.dataTransfer.
        files;

        updateDropzoneFileList3
        (dropZoneElement3, e.dataTransfer.
        files[0]);
    }

    dropZoneElement3.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList3 = 
(dropzoneElement3, file) => {
    let dropzoneFileMessage = 
    dropzoneElement3.querySelector(".info-draganddrop-3");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox3.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement3.querySelector(".info-draganddrop-3");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox3.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-3");
    console.log(myFiled.files[0]);
});

// File Upload 4 //
const dropzoneBox4 = document.
getElementsByClassName("dropzone-box-4")
[0];

const inputFiles4 = document.
querySelectorAll(
    ".dropzone-area-4 input[type='file']"
);

const inputElement4 = inputFiles4[0];

const dropZoneElement4 = inputElement4.
closest(".dropzone-area-4");

inputElement4.addEventListener("change",
(e) => {
    if (inputElement4.files.length) {
        updateDropzoneFileList4
        (dropZoneElement4, inputElement4.files
            [0]);
    }
});

dropZoneElement4.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement4.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement4.addEventListener(type,
        (e) => {
            dropZoneElement4.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement4.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement4.files = e.dataTransfer.
        files;

        updateDropzoneFileList4
        (dropZoneElement4, e.dataTransfer.
        files[0]);
    }

    dropZoneElement4.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList4 = 
(dropzoneElement4, file) => {
    let dropzoneFileMessage = 
    dropzoneElement4.querySelector(".info-draganddrop-4");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox4.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement4.querySelector(".info-draganddrop-4");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox4.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-4");
    console.log(myFiled.files[0]);
});

// File Upload 5 //
const dropzoneBox5 = document.
getElementsByClassName("dropzone-box-5")
[0];

const inputFiles5 = document.
querySelectorAll(
    ".dropzone-area-5 input[type='file']"
);

const inputElement5 = inputFiles5[0];

const dropZoneElement5 = inputElement5.
closest(".dropzone-area-5");

inputElement5.addEventListener("change",
(e) => {
    if (inputElement5.files.length) {
        updateDropzoneFileList5
        (dropZoneElement5, inputElement5.files
            [0]);
    }
});

dropZoneElement5.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement5.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement5.addEventListener(type,
        (e) => {
            dropZoneElement5.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement5.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement5.files = e.dataTransfer.
        files;

        updateDropzoneFileList5
        (dropZoneElement5, e.dataTransfer.
        files[0]);
    }

    dropZoneElement5.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList5 = 
(dropzoneElement5, file) => {
    let dropzoneFileMessage = 
    dropzoneElement5.querySelector(".info-draganddrop-5");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox5.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement5.querySelector(".info-draganddrop-5");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox5.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-5");
    console.log(myFiled.files[0]);
});

// File Upload 6 //
const dropzoneBox6 = document.
getElementsByClassName("dropzone-box-6")
[0];

const inputFiles6 = document.
querySelectorAll(
    ".dropzone-area-6 input[type='file']"
);

const inputElement6 = inputFiles6[0];

const dropZoneElement6 = inputElement6.
closest(".dropzone-area-6");

inputElement6.addEventListener("change",
(e) => {
    if (inputElement6.files.length) {
        updateDropzoneFileList6
        (dropZoneElement6, inputElement6.files
            [0]);
    }
});

dropZoneElement6.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement6.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement6.addEventListener(type,
        (e) => {
            dropZoneElement6.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement6.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement6.files = e.dataTransfer.
        files;

        updateDropzoneFileList6
        (dropZoneElement6, e.dataTransfer.
        files[0]);
    }

    dropZoneElement6.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList6 = 
(dropzoneElement6, file) => {
    let dropzoneFileMessage = 
    dropzoneElement6.querySelector(".info-draganddrop-6");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox6.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement6.querySelector(".info-draganddrop-6");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox6.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-6");
    console.log(myFiled.files[0]);
});

// File Upload 7 //
const dropzoneBox7 = document.
getElementsByClassName("dropzone-box-7")
[0];

const inputFiles7 = document.
querySelectorAll(
    ".dropzone-area-7 input[type='file']"
);

const inputElement7 = inputFiles7[0];

const dropZoneElement7 = inputElement7.
closest(".dropzone-area-7");

inputElement7.addEventListener("change",
(e) => {
    if (inputElement7.files.length) {
        updateDropzoneFileList7
        (dropZoneElement7, inputElement7.files
            [0]);
    }
});

dropZoneElement7.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement7.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement7.addEventListener(type,
        (e) => {
            dropZoneElement7.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement7.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement7.files = e.dataTransfer.
        files;

        updateDropzoneFileList7
        (dropZoneElement7, e.dataTransfer.
        files[0]);
    }

    dropZoneElement7.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList7 = 
(dropzoneElement7, file) => {
    let dropzoneFileMessage = 
    dropzoneElement7.querySelector(".info-draganddrop-7");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox7.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement7.querySelector(".info-draganddrop-7");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox7.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-7");
    console.log(myFiled.files[0]);
});

// File Upload 8 //
const dropzoneBox8 = document.
getElementsByClassName("dropzone-box-8")
[0];

const inputFiles8 = document.
querySelectorAll(
    ".dropzone-area-8 input[type='file']"
);

const inputElement8 = inputFiles8[0];

const dropZoneElement8 = inputElement8.
closest(".dropzone-area-8");

inputElement8.addEventListener("change",
(e) => {
    if (inputElement8.files.length) {
        updateDropzoneFileList8
        (dropZoneElement8, inputElement8.files
            [0]);
    }
});

dropZoneElement8.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement8.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement8.addEventListener(type,
        (e) => {
            dropZoneElement8.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement8.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement8.files = e.dataTransfer.
        files;

        updateDropzoneFileList8
        (dropZoneElement8, e.dataTransfer.
        files[0]);
    }

    dropZoneElement8.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList8 = 
(dropzoneElement8, file) => {
    let dropzoneFileMessage = 
    dropzoneElement8.querySelector(".info-draganddrop-8");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox8.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement8.querySelector(".info-draganddrop-8");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox8.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-8");
    console.log(myFiled.files[0]);
});