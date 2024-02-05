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

// File Upload 9 //
const dropzoneBox9 = document.
getElementsByClassName("dropzone-box-9")
[0];

const inputFiles9 = document.
querySelectorAll(
    ".dropzone-area-9 input[type='file']"
);

const inputElement9 = inputFiles9[0];

const dropZoneElement9 = inputElement9.
closest(".dropzone-area-9");

inputElement9.addEventListener("change",
(e) => {
    if (inputElement9.files.length) {
        updateDropzoneFileList9
        (dropZoneElement9, inputElement9.files
            [0]);
    }
});

dropZoneElement9.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement9.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement9.addEventListener(type,
        (e) => {
            dropZoneElement9.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement9.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement9.files = e.dataTransfer.
        files;

        updateDropzoneFileList9
        (dropZoneElement9, e.dataTransfer.
        files[0]);
    }

    dropZoneElement9.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList9 = 
(dropzoneElement9, file) => {
    let dropzoneFileMessage = 
    dropzoneElement9.querySelector(".info-draganddrop-9");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox9.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement9.querySelector(".info-draganddrop-9");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox9.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-9");
    console.log(myFiled.files[0]);
});

// File Upload 10 //
const dropzoneBox10 = document.
getElementsByClassName("dropzone-box-10")
[0];

const inputFiles10 = document.
querySelectorAll(
    ".dropzone-area-10 input[type='file']"
);

const inputElement10 = inputFiles10[0];

const dropZoneElement10 = inputElement10.
closest(".dropzone-area-10");

inputElement10.addEventListener("change",
(e) => {
    if (inputElement10.files.length) {
        updateDropzoneFileList10
        (dropZoneElement10, inputElement10.files
            [0]);
    }
});

dropZoneElement10.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement10.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement10.addEventListener(type,
        (e) => {
            dropZoneElement10.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement10.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement10.files = e.dataTransfer.
        files;

        updateDropzoneFileList10
        (dropZoneElement10, e.dataTransfer.
        files[0]);
    }

    dropZoneElement10.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList10 = 
(dropzoneElement10, file) => {
    let dropzoneFileMessage = 
    dropzoneElement10.querySelector(".info-draganddrop-10");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox10.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement10.querySelector(".info-draganddrop-10");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox10.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-10");
    console.log(myFiled.files[0]);
});

// File Upload 11 //
const dropzoneBox11 = document.
getElementsByClassName("dropzone-box-11")
[0];

const inputFiles11 = document.
querySelectorAll(
    ".dropzone-area-11 input[type='file']"
);

const inputElement11 = inputFiles11[0];

const dropZoneElement11 = inputElement11.
closest(".dropzone-area-11");

inputElement11.addEventListener("change",
(e) => {
    if (inputElement11.files.length) {
        updateDropzoneFileList11
        (dropZoneElement11, inputElement11.files
            [0]);
    }
});

dropZoneElement11.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement11.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement11.addEventListener(type,
        (e) => {
            dropZoneElement11.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement11.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement11.files = e.dataTransfer.
        files;

        updateDropzoneFileList11
        (dropZoneElement11, e.dataTransfer.
        files[0]);
    }

    dropZoneElement11.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList11 = 
(dropzoneElement11, file) => {
    let dropzoneFileMessage = 
    dropzoneElement11.querySelector(".info-draganddrop-11");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox11.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement11.querySelector(".info-draganddrop-11");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox11.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-11");
    console.log(myFiled.files[0]);
});

// File Upload 12 //
const dropzoneBox12 = document.
getElementsByClassName("dropzone-box-12")
[0];

const inputFiles12 = document.
querySelectorAll(
    ".dropzone-area-12 input[type='file']"
);

const inputElement12 = inputFiles12[0];

const dropZoneElement12 = inputElement12.
closest(".dropzone-area-12");

inputElement12.addEventListener("change",
(e) => {
    if (inputElement12.files.length) {
        updateDropzoneFileList12
        (dropZoneElement12, inputElement12.files
            [0]);
    }
});

dropZoneElement12.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement12.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement12.addEventListener(type,
        (e) => {
            dropZoneElement12.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement12.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement12.files = e.dataTransfer.
        files;

        updateDropzoneFileList12
        (dropZoneElement12, e.dataTransfer.
        files[0]);
    }

    dropZoneElement12.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList12 = 
(dropzoneElement12, file) => {
    let dropzoneFileMessage = 
    dropzoneElement12.querySelector(".info-draganddrop-12");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox12.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement12.querySelector(".info-draganddrop-12");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox12.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-12");
    console.log(myFiled.files[0]);
});

// File Upload 13 //
const dropzoneBox13 = document.
getElementsByClassName("dropzone-box-13")
[0];

const inputFiles13 = document.
querySelectorAll(
    ".dropzone-area-13 input[type='file']"
);

const inputElement13 = inputFiles13[0];

const dropZoneElement13 = inputElement13.
closest(".dropzone-area-13");

inputElement13.addEventListener("change",
(e) => {
    if (inputElement13.files.length) {
        updateDropzoneFileList13
        (dropZoneElement13, inputElement13.files
            [0]);
    }
});

dropZoneElement13.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement13.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement13.addEventListener(type,
        (e) => {
            dropZoneElement13.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement13.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement13.files = e.dataTransfer.
        files;

        updateDropzoneFileList13
        (dropZoneElement13, e.dataTransfer.
        files[0]);
    }

    dropZoneElement13.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList13 = 
(dropzoneElement13, file) => {
    let dropzoneFileMessage = 
    dropzoneElement13.querySelector(".info-draganddrop-13");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox13.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement13.querySelector(".info-draganddrop-13");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox13.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-13");
    console.log(myFiled.files[0]);
});

// File Upload 14 //
const dropzoneBox14 = document.
getElementsByClassName("dropzone-box-14")
[0];

const inputFiles14 = document.
querySelectorAll(
    ".dropzone-area-14 input[type='file']"
);

const inputElement14 = inputFiles14[0];

const dropZoneElement14 = inputElement14.
closest(".dropzone-area-14");

inputElement14.addEventListener("change",
(e) => {
    if (inputElement14.files.length) {
        updateDropzoneFileList14
        (dropZoneElement14, inputElement14.files
            [0]);
    }
});

dropZoneElement14.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement14.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement14.addEventListener(type,
        (e) => {
            dropZoneElement14.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement14.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement14.files = e.dataTransfer.
        files;

        updateDropzoneFileList14
        (dropZoneElement14, e.dataTransfer.
        files[0]);
    }

    dropZoneElement14.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList14 = 
(dropzoneElement14, file) => {
    let dropzoneFileMessage = 
    dropzoneElement14.querySelector(".info-draganddrop-14");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox14.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement14.querySelector(".info-draganddrop-14");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox14.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-14");
    console.log(myFiled.files[0]);
});

// File Upload 15 //
const dropzoneBox15 = document.
getElementsByClassName("dropzone-box-15")
[0];

const inputFiles15 = document.
querySelectorAll(
    ".dropzone-area-15 input[type='file']"
);

const inputElement15 = inputFiles15[0];

const dropZoneElement15 = inputElement15.
closest(".dropzone-area-15");

inputElement15.addEventListener("change",
(e) => {
    if (inputElement15.files.length) {
        updateDropzoneFileList15
        (dropZoneElement15, inputElement15.files
            [0]);
    }
});

dropZoneElement15.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement15.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement15.addEventListener(type,
        (e) => {
            dropZoneElement15.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement15.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement15.files = e.dataTransfer.
        files;

        updateDropzoneFileList15
        (dropZoneElement15, e.dataTransfer.
        files[0]);
    }

    dropZoneElement15.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList15 = 
(dropzoneElement15, file) => {
    let dropzoneFileMessage = 
    dropzoneElement15.querySelector(".info-draganddrop-15");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox15.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement15.querySelector(".info-draganddrop-15");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox15.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-15");
    console.log(myFiled.files[0]);
});

// File Upload 16 //
const dropzoneBox16 = document.
getElementsByClassName("dropzone-box-16")
[0];

const inputFiles16 = document.
querySelectorAll(
    ".dropzone-area-16 input[type='file']"
);

const inputElement16 = inputFiles16[0];

const dropZoneElement16 = inputElement16.
closest(".dropzone-area-16");

inputElement16.addEventListener("change",
(e) => {
    if (inputElement16.files.length) {
        updateDropzoneFileList16
        (dropZoneElement16, inputElement16.files
            [0]);
    }
});

dropZoneElement16.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement16.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement16.addEventListener(type,
        (e) => {
            dropZoneElement16.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement16.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement16.files = e.dataTransfer.
        files;

        updateDropzoneFileList16
        (dropZoneElement16, e.dataTransfer.
        files[0]);
    }

    dropZoneElement16.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList16 = 
(dropzoneElement16, file) => {
    let dropzoneFileMessage = 
    dropzoneElement16.querySelector(".info-draganddrop-16");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox16.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement16.querySelector(".info-draganddrop-16");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox16.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-16");
    console.log(myFiled.files[0]);
});

// File Upload 17 //
const dropzoneBox17 = document.
getElementsByClassName("dropzone-box-17")
[0];

const inputFiles17 = document.
querySelectorAll(
    ".dropzone-area-17 input[type='file']"
);

const inputElement17 = inputFiles17[0];

const dropZoneElement17 = inputElement17.
closest(".dropzone-area-17");

inputElement17.addEventListener("change",
(e) => {
    if (inputElement17.files.length) {
        updateDropzoneFileList17
        (dropZoneElement17, inputElement17.files
            [0]);
    }
});

dropZoneElement17.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement17.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement17.addEventListener(type,
        (e) => {
            dropZoneElement17.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement17.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement17.files = e.dataTransfer.
        files;

        updateDropzoneFileList17
        (dropZoneElement17, e.dataTransfer.
        files[0]);
    }

    dropZoneElement17.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList17 = 
(dropzoneElement17, file) => {
    let dropzoneFileMessage = 
    dropzoneElement17.querySelector(".info-draganddrop-17");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox17.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement17.querySelector(".info-draganddrop-17");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox17.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-17");
    console.log(myFiled.files[0]);
});

// File Upload 18 //
const dropzoneBox18 = document.
getElementsByClassName("dropzone-box-18")
[0];

const inputFiles18 = document.
querySelectorAll(
    ".dropzone-area-18 input[type='file']"
);

const inputElement18 = inputFiles18[0];

const dropZoneElement18 = inputElement18.
closest(".dropzone-area-18");

inputElement18.addEventListener("change",
(e) => {
    if (inputElement18.files.length) {
        updateDropzoneFileList18
        (dropZoneElement18, inputElement18.files
            [0]);
    }
});

dropZoneElement18.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement18.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement18.addEventListener(type,
        (e) => {
            dropZoneElement18.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement18.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement18.files = e.dataTransfer.
        files;

        updateDropzoneFileList18
        (dropZoneElement18, e.dataTransfer.
        files[0]);
    }

    dropZoneElement18.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList18 = 
(dropzoneElement18, file) => {
    let dropzoneFileMessage = 
    dropzoneElement18.querySelector(".info-draganddrop-18");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox18.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement18.querySelector(".info-draganddrop-18");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox18.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-18");
    console.log(myFiled.files[0]);
});

// File Upload 19 //
const dropzoneBox19 = document.
getElementsByClassName("dropzone-box-19")
[0];

const inputFiles19 = document.
querySelectorAll(
    ".dropzone-area-19 input[type='file']"
);

const inputElement19 = inputFiles19[0];

const dropZoneElement19 = inputElement19.
closest(".dropzone-area-19");

inputElement19.addEventListener("change",
(e) => {
    if (inputElement19.files.length) {
        updateDropzoneFileList19
        (dropZoneElement19, inputElement19.files
            [0]);
    }
});

dropZoneElement19.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement19.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement19.addEventListener(type,
        (e) => {
            dropZoneElement19.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement19.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement19.files = e.dataTransfer.
        files;

        updateDropzoneFileList19
        (dropZoneElement19, e.dataTransfer.
        files[0]);
    }

    dropZoneElement19.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList19 = 
(dropzoneElement19, file) => {
    let dropzoneFileMessage = 
    dropzoneElement19.querySelector(".info-draganddrop-19");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox19.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement19.querySelector(".info-draganddrop-19");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox19.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-19");
    console.log(myFiled.files[0]);
});

// File Upload 20 //
const dropzoneBox20 = document.
getElementsByClassName("dropzone-box-20")
[0];

const inputFiles20 = document.
querySelectorAll(
    ".dropzone-area-20 input[type='file']"
);

const inputElement20 = inputFiles20[0];

const dropZoneElement20 = inputElement20.
closest(".dropzone-area-20");

inputElement20.addEventListener("change",
(e) => {
    if (inputElement20.files.length) {
        updateDropzoneFileList20
        (dropZoneElement20, inputElement20.files
            [0]);
    }
});

dropZoneElement20.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement20.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement20.addEventListener(type,
        (e) => {
            dropZoneElement20.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement20.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement20.files = e.dataTransfer.
        files;

        updateDropzoneFileList20
        (dropZoneElement20, e.dataTransfer.
        files[0]);
    }

    dropZoneElement20.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList20 = 
(dropzoneElement20, file) => {
    let dropzoneFileMessage = 
    dropzoneElement20.querySelector(".info-draganddrop-20");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox20.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement20.querySelector(".info-draganddrop-20");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox20.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-20");
    console.log(myFiled.files[0]);
});

// File Upload 21 //
const dropzoneBox21 = document.
getElementsByClassName("dropzone-box-21")
[0];

const inputFiles21 = document.
querySelectorAll(
    ".dropzone-area-21 input[type='file']"
);

const inputElement21 = inputFiles21[0];

const dropZoneElement21 = inputElement21.
closest(".dropzone-area-21");

inputElement21.addEventListener("change",
(e) => {
    if (inputElement21.files.length) {
        updateDropzoneFileList21
        (dropZoneElement21, inputElement21.files
            [0]);
    }
});

dropZoneElement21.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement21.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement21.addEventListener(type,
        (e) => {
            dropZoneElement21.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement21.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement21.files = e.dataTransfer.
        files;

        updateDropzoneFileList21
        (dropZoneElement21, e.dataTransfer.
        files[0]);
    }

    dropZoneElement21.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList21 = 
(dropzoneElement21, file) => {
    let dropzoneFileMessage = 
    dropzoneElement21.querySelector(".info-draganddrop-21");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox21.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement21.querySelector(".info-draganddrop-21");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox21.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-21");
    console.log(myFiled.files[0]);
});

// File Upload 22 //
const dropzoneBox22 = document.
getElementsByClassName("dropzone-box-22")
[0];

const inputFiles22 = document.
querySelectorAll(
    ".dropzone-area-22 input[type='file']"
);

const inputElement22 = inputFiles22[0];

const dropZoneElement22 = inputElement22.
closest(".dropzone-area-22");

inputElement22.addEventListener("change",
(e) => {
    if (inputElement22.files.length) {
        updateDropzoneFileList22
        (dropZoneElement22, inputElement22.files
            [0]);
    }
});

dropZoneElement22.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement22.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement22.addEventListener(type,
        (e) => {
            dropZoneElement22.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement22.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement22.files = e.dataTransfer.
        files;

        updateDropzoneFileList22
        (dropZoneElement22, e.dataTransfer.
        files[0]);
    }

    dropZoneElement22.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList22 = 
(dropzoneElement22, file) => {
    let dropzoneFileMessage = 
    dropzoneElement22.querySelector(".info-draganddrop-22");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox22.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement22.querySelector(".info-draganddrop-22");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox22.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-22");
    console.log(myFiled.files[0]);
});