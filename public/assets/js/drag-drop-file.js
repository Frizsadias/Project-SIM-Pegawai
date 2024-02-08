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

// File Upload 23 //
const dropzoneBox23 = document.
getElementsByClassName("dropzone-box-23")
[0];

const inputFiles23 = document.
querySelectorAll(
    ".dropzone-area-23 input[type='file']"
);

const inputElement23 = inputFiles23[0];

const dropZoneElement23 = inputElement23.
closest(".dropzone-area-23");

inputElement23.addEventListener("change",
(e) => {
    if (inputElement23.files.length) {
        updateDropzoneFileList23
        (dropZoneElement23, inputElement23.files
            [0]);
    }
});

dropZoneElement23.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement23.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement23.addEventListener(type,
        (e) => {
            dropZoneElement23.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement23.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement23.files = e.dataTransfer.
        files;

        updateDropzoneFileList23
        (dropZoneElement23, e.dataTransfer.
        files[0]);
    }

    dropZoneElement23.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList23 = 
(dropzoneElement23, file) => {
    let dropzoneFileMessage = 
    dropzoneElement23.querySelector(".info-draganddrop-23");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox23.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement23.querySelector(".info-draganddrop-23");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox23.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-23");
    console.log(myFiled.files[0]);
});

// File Upload 24 //
const dropzoneBox24 = document.
getElementsByClassName("dropzone-box-24")
[0];

const inputFiles24 = document.
querySelectorAll(
    ".dropzone-area-24 input[type='file']"
);

const inputElement24 = inputFiles24[0];

const dropZoneElement24 = inputElement24.
closest(".dropzone-area-24");

inputElement24.addEventListener("change",
(e) => {
    if (inputElement24.files.length) {
        updateDropzoneFileList24
        (dropZoneElement24, inputElement24.files
            [0]);
    }
});

dropZoneElement24.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement24.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement24.addEventListener(type,
        (e) => {
            dropZoneElement24.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement24.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement24.files = e.dataTransfer.
        files;

        updateDropzoneFileList24
        (dropZoneElement24, e.dataTransfer.
        files[0]);
    }

    dropZoneElement24.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList24 = 
(dropzoneElement24, file) => {
    let dropzoneFileMessage = 
    dropzoneElement24.querySelector(".info-draganddrop-24");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox24.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement24.querySelector(".info-draganddrop-24");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox24.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-24");
    console.log(myFiled.files[0]);
});

// File Upload 25 //
const dropzoneBox25 = document.
getElementsByClassName("dropzone-box-25")
[0];

const inputFiles25 = document.
querySelectorAll(
    ".dropzone-area-25 input[type='file']"
);

const inputElement25 = inputFiles25[0];

const dropZoneElement25 = inputElement25.
closest(".dropzone-area-25");

inputElement25.addEventListener("change",
(e) => {
    if (inputElement25.files.length) {
        updateDropzoneFileList25
        (dropZoneElement25, inputElement25.files
            [0]);
    }
});

dropZoneElement25.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement25.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement25.addEventListener(type,
        (e) => {
            dropZoneElement25.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement25.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement25.files = e.dataTransfer.
        files;

        updateDropzoneFileList25
        (dropZoneElement25, e.dataTransfer.
        files[0]);
    }

    dropZoneElement25.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList25 = 
(dropzoneElement25, file) => {
    let dropzoneFileMessage = 
    dropzoneElement25.querySelector(".info-draganddrop-25");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox25.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement25.querySelector(".info-draganddrop-25");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox25.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-25");
    console.log(myFiled.files[0]);
});

// File Upload 26 //
const dropzoneBox26 = document.
getElementsByClassName("dropzone-box-26")
[0];

const inputFiles26 = document.
querySelectorAll(
    ".dropzone-area-26 input[type='file']"
);

const inputElement26 = inputFiles26[0];

const dropZoneElement26 = inputElement26.
closest(".dropzone-area-26");

inputElement26.addEventListener("change",
(e) => {
    if (inputElement26.files.length) {
        updateDropzoneFileList26
        (dropZoneElement26, inputElement26.files
            [0]);
    }
});

dropZoneElement26.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement26.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement26.addEventListener(type,
        (e) => {
            dropZoneElement26.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement26.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement26.files = e.dataTransfer.
        files;

        updateDropzoneFileList26
        (dropZoneElement26, e.dataTransfer.
        files[0]);
    }

    dropZoneElement26.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList26 = 
(dropzoneElement26, file) => {
    let dropzoneFileMessage = 
    dropzoneElement26.querySelector(".info-draganddrop-26");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox26.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement26.querySelector(".info-draganddrop-26");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox26.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-26");
    console.log(myFiled.files[0]);
});

// File Upload 27 //
const dropzoneBox27 = document.
getElementsByClassName("dropzone-box-27")
[0];

const inputFiles27 = document.
querySelectorAll(
    ".dropzone-area-27 input[type='file']"
);

const inputElement27 = inputFiles27[0];

const dropZoneElement27 = inputElement27.
closest(".dropzone-area-27");

inputElement27.addEventListener("change",
(e) => {
    if (inputElement27.files.length) {
        updateDropzoneFileList27
        (dropZoneElement27, inputElement27.files
            [0]);
    }
});

dropZoneElement27.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement27.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement27.addEventListener(type,
        (e) => {
            dropZoneElement27.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement27.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement27.files = e.dataTransfer.
        files;

        updateDropzoneFileList27
        (dropZoneElement27, e.dataTransfer.
        files[0]);
    }

    dropZoneElement27.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList27 = 
(dropzoneElement27, file) => {
    let dropzoneFileMessage = 
    dropzoneElement27.querySelector(".info-draganddrop-27");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox27.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement27.querySelector(".info-draganddrop-27");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox27.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-27");
    console.log(myFiled.files[0]);
});

// File Upload 28 //
const dropzoneBox28 = document.
getElementsByClassName("dropzone-box-28")
[0];

const inputFiles28 = document.
querySelectorAll(
    ".dropzone-area-28 input[type='file']"
);

const inputElement28 = inputFiles28[0];

const dropZoneElement28 = inputElement28.
closest(".dropzone-area-28");

inputElement28.addEventListener("change",
(e) => {
    if (inputElement28.files.length) {
        updateDropzoneFileList28
        (dropZoneElement28, inputElement28.files
            [0]);
    }
});

dropZoneElement28.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement28.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement28.addEventListener(type,
        (e) => {
            dropZoneElement28.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement28.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement28.files = e.dataTransfer.
        files;

        updateDropzoneFileList28
        (dropZoneElement28, e.dataTransfer.
        files[0]);
    }

    dropZoneElement28.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList28 = 
(dropzoneElement28, file) => {
    let dropzoneFileMessage = 
    dropzoneElement28.querySelector(".info-draganddrop-28");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox28.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement28.querySelector(".info-draganddrop-28");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox28.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-28");
    console.log(myFiled.files[0]);
});

// File Upload 29 //
const dropzoneBox29 = document.
getElementsByClassName("dropzone-box-29")
[0];

const inputFiles29 = document.
querySelectorAll(
    ".dropzone-area-29 input[type='file']"
);

const inputElement29 = inputFiles29[0];

const dropZoneElement29 = inputElement29.
closest(".dropzone-area-29");

inputElement29.addEventListener("change",
(e) => {
    if (inputElement29.files.length) {
        updateDropzoneFileList29
        (dropZoneElement29, inputElement29.files
            [0]);
    }
});

dropZoneElement29.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement29.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement29.addEventListener(type,
        (e) => {
            dropZoneElement29.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement29.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement29.files = e.dataTransfer.
        files;

        updateDropzoneFileList29
        (dropZoneElement29, e.dataTransfer.
        files[0]);
    }

    dropZoneElement29.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList29 = 
(dropzoneElement29, file) => {
    let dropzoneFileMessage = 
    dropzoneElement29.querySelector(".info-draganddrop-29");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox29.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement29.querySelector(".info-draganddrop-29");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox29.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-29");
    console.log(myFiled.files[0]);
});

// File Upload 30 //
const dropzoneBox30 = document.
getElementsByClassName("dropzone-box-30")
[0];

const inputFiles30 = document.
querySelectorAll(
    ".dropzone-area-30 input[type='file']"
);

const inputElement30 = inputFiles30[0];

const dropZoneElement30 = inputElement30.
closest(".dropzone-area-30");

inputElement30.addEventListener("change",
(e) => {
    if (inputElement30.files.length) {
        updateDropzoneFileList30
        (dropZoneElement30, inputElement30.files
            [0]);
    }
});

dropZoneElement30.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement30.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement30.addEventListener(type,
        (e) => {
            dropZoneElement30.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement30.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement30.files = e.dataTransfer.
        files;

        updateDropzoneFileList30
        (dropZoneElement30, e.dataTransfer.
        files[0]);
    }

    dropZoneElement30.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList30 = 
(dropzoneElement30, file) => {
    let dropzoneFileMessage = 
    dropzoneElement30.querySelector(".info-draganddrop-30");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox30.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement30.querySelector(".info-draganddrop-30");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox30.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-30");
    console.log(myFiled.files[0]);
});

// File Upload 31 //
const dropzoneBox31 = document.
getElementsByClassName("dropzone-box-31")
[0];

const inputFiles31 = document.
querySelectorAll(
    ".dropzone-area-31 input[type='file']"
);

const inputElement31 = inputFiles31[0];

const dropZoneElement31 = inputElement31.
closest(".dropzone-area-31");

inputElement31.addEventListener("change",
(e) => {
    if (inputElement31.files.length) {
        updateDropzoneFileList31
        (dropZoneElement31, inputElement31.files
            [0]);
    }
});

dropZoneElement31.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement31.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement31.addEventListener(type,
        (e) => {
            dropZoneElement31.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement31.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement31.files = e.dataTransfer.
        files;

        updateDropzoneFileList31
        (dropZoneElement31, e.dataTransfer.
        files[0]);
    }

    dropZoneElement31.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList31 = 
(dropzoneElement31, file) => {
    let dropzoneFileMessage = 
    dropzoneElement31.querySelector(".info-draganddrop-31");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox31.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement31.querySelector(".info-draganddrop-31");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox31.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-31");
    console.log(myFiled.files[0]);
});

// File Upload 32 //
const dropzoneBox32 = document.
getElementsByClassName("dropzone-box-32")
[0];

const inputFiles32 = document.
querySelectorAll(
    ".dropzone-area-32 input[type='file']"
);

const inputElement32 = inputFiles32[0];

const dropZoneElement32 = inputElement32.
closest(".dropzone-area-32");

inputElement32.addEventListener("change",
(e) => {
    if (inputElement32.files.length) {
        updateDropzoneFileList32
        (dropZoneElement32, inputElement32.files
            [0]);
    }
});

dropZoneElement32.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement32.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement32.addEventListener(type,
        (e) => {
            dropZoneElement32.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement32.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement32.files = e.dataTransfer.
        files;

        updateDropzoneFileList32
        (dropZoneElement32, e.dataTransfer.
        files[0]);
    }

    dropZoneElement32.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList32 = 
(dropzoneElement32, file) => {
    let dropzoneFileMessage = 
    dropzoneElement32.querySelector(".info-draganddrop-32");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox32.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement32.querySelector(".info-draganddrop-32");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox32.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-32");
    console.log(myFiled.files[0]);
});

// File Upload 33 //
const dropzoneBox33 = document.
getElementsByClassName("dropzone-box-33")
[0];

const inputFiles33 = document.
querySelectorAll(
    ".dropzone-area-33 input[type='file']"
);

const inputElement33 = inputFiles33[0];

const dropZoneElement33 = inputElement33.
closest(".dropzone-area-33");

inputElement33.addEventListener("change",
(e) => {
    if (inputElement33.files.length) {
        updateDropzoneFileList33
        (dropZoneElement33, inputElement33.files
            [0]);
    }
});

dropZoneElement33.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement33.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement33.addEventListener(type,
        (e) => {
            dropZoneElement33.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement33.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement33.files = e.dataTransfer.
        files;

        updateDropzoneFileList33
        (dropZoneElement33, e.dataTransfer.
        files[0]);
    }

    dropZoneElement33.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList33 = 
(dropzoneElement33, file) => {
    let dropzoneFileMessage = 
    dropzoneElement33.querySelector(".info-draganddrop-33");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox33.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement33.querySelector(".info-draganddrop-33");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox33.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-33");
    console.log(myFiled.files[0]);
});

// File Upload 34 //
const dropzoneBox34 = document.
getElementsByClassName("dropzone-box-34")
[0];

const inputFiles34 = document.
querySelectorAll(
    ".dropzone-area-34 input[type='file']"
);

const inputElement34 = inputFiles34[0];

const dropZoneElement34 = inputElement34.
closest(".dropzone-area-34");

inputElement34.addEventListener("change",
(e) => {
    if (inputElement34.files.length) {
        updateDropzoneFileList34
        (dropZoneElement34, inputElement34.files
            [0]);
    }
});

dropZoneElement34.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement34.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement34.addEventListener(type,
        (e) => {
            dropZoneElement34.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement34.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement34.files = e.dataTransfer.
        files;

        updateDropzoneFileList34
        (dropZoneElement34, e.dataTransfer.
        files[0]);
    }

    dropZoneElement34.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList34 = 
(dropzoneElement34, file) => {
    let dropzoneFileMessage = 
    dropzoneElement34.querySelector(".info-draganddrop-34");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox34.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement34.querySelector(".info-draganddrop-34");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox34.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-34");
    console.log(myFiled.files[0]);
});

// File Upload 35 //
const dropzoneBox35 = document.
getElementsByClassName("dropzone-box-35")
[0];

const inputFiles35 = document.
querySelectorAll(
    ".dropzone-area-35 input[type='file']"
);

const inputElement35 = inputFiles35[0];

const dropZoneElement35 = inputElement35.
closest(".dropzone-area-35");

inputElement35.addEventListener("change",
(e) => {
    if (inputElement35.files.length) {
        updateDropzoneFileList35
        (dropZoneElement35, inputElement35.files
            [0]);
    }
});

dropZoneElement35.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement35.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement35.addEventListener(type,
        (e) => {
            dropZoneElement35.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement35.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement35.files = e.dataTransfer.
        files;

        updateDropzoneFileList35
        (dropZoneElement35, e.dataTransfer.
        files[0]);
    }

    dropZoneElement35.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList35 = 
(dropzoneElement35, file) => {
    let dropzoneFileMessage = 
    dropzoneElement35.querySelector(".info-draganddrop-35");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox35.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement35.querySelector(".info-draganddrop-35");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox35.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-35");
    console.log(myFiled.files[0]);
});

// File Upload 36 //
const dropzoneBox36 = document.
getElementsByClassName("dropzone-box-36")
[0];

const inputFiles36 = document.
querySelectorAll(
    ".dropzone-area-36 input[type='file']"
);

const inputElement36 = inputFiles36[0];

const dropZoneElement36 = inputElement36.
closest(".dropzone-area-36");

inputElement36.addEventListener("change",
(e) => {
    if (inputElement36.files.length) {
        updateDropzoneFileList36
        (dropZoneElement36, inputElement36.files
            [0]);
    }
});

dropZoneElement36.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement36.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement36.addEventListener(type,
        (e) => {
            dropZoneElement36.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement36.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement36.files = e.dataTransfer.
        files;

        updateDropzoneFileList36
        (dropZoneElement36, e.dataTransfer.
        files[0]);
    }

    dropZoneElement36.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList36 = 
(dropzoneElement36, file) => {
    let dropzoneFileMessage = 
    dropzoneElement36.querySelector(".info-draganddrop-36");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox36.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement36.querySelector(".info-draganddrop-36");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox36.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-36");
    console.log(myFiled.files[0]);
});

// File Upload 37 //
const dropzoneBox37 = document.
getElementsByClassName("dropzone-box-37")
[0];

const inputFiles37 = document.
querySelectorAll(
    ".dropzone-area-37 input[type='file']"
);

const inputElement37 = inputFiles37[0];

const dropZoneElement37 = inputElement37.
closest(".dropzone-area-37");

inputElement37.addEventListener("change",
(e) => {
    if (inputElement37.files.length) {
        updateDropzoneFileList37
        (dropZoneElement37, inputElement37.files
            [0]);
    }
});

dropZoneElement37.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement37.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement37.addEventListener(type,
        (e) => {
            dropZoneElement37.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement37.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement37.files = e.dataTransfer.
        files;

        updateDropzoneFileList37
        (dropZoneElement37, e.dataTransfer.
        files[0]);
    }

    dropZoneElement37.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList37 = 
(dropzoneElement37, file) => {
    let dropzoneFileMessage = 
    dropzoneElement37.querySelector(".info-draganddrop-37");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox37.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement37.querySelector(".info-draganddrop-37");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox37.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-37");
    console.log(myFiled.files[0]);
});

// File Upload 38 //
const dropzoneBox38 = document.
getElementsByClassName("dropzone-box-38")
[0];

const inputFiles38 = document.
querySelectorAll(
    ".dropzone-area-38 input[type='file']"
);

const inputElement38 = inputFiles38[0];

const dropZoneElement38 = inputElement38.
closest(".dropzone-area-38");

inputElement38.addEventListener("change",
(e) => {
    if (inputElement38.files.length) {
        updateDropzoneFileList38
        (dropZoneElement38, inputElement38.files
            [0]);
    }
});

dropZoneElement38.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement38.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement38.addEventListener(type,
        (e) => {
            dropZoneElement38.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement38.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement38.files = e.dataTransfer.
        files;

        updateDropzoneFileList38
        (dropZoneElement38, e.dataTransfer.
        files[0]);
    }

    dropZoneElement38.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList38 = 
(dropzoneElement38, file) => {
    let dropzoneFileMessage = 
    dropzoneElement38.querySelector(".info-draganddrop-38");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox38.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement38.querySelector(".info-draganddrop-38");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox38.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-38");
    console.log(myFiled.files[0]);
});

// File Upload 39 //
const dropzoneBox39 = document.
getElementsByClassName("dropzone-box-39")
[0];

const inputFiles39 = document.
querySelectorAll(
    ".dropzone-area-39 input[type='file']"
);

const inputElement39 = inputFiles39[0];

const dropZoneElement39 = inputElement39.
closest(".dropzone-area-39");

inputElement39.addEventListener("change",
(e) => {
    if (inputElement39.files.length) {
        updateDropzoneFileList39
        (dropZoneElement39, inputElement39.files
            [0]);
    }
});

dropZoneElement39.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement39.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement39.addEventListener(type,
        (e) => {
            dropZoneElement39.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement39.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement39.files = e.dataTransfer.
        files;

        updateDropzoneFileList39
        (dropZoneElement39, e.dataTransfer.
        files[0]);
    }

    dropZoneElement39.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList39 = 
(dropzoneElement39, file) => {
    let dropzoneFileMessage = 
    dropzoneElement39.querySelector(".info-draganddrop-39");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox39.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement39.querySelector(".info-draganddrop-39");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox39.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-39");
    console.log(myFiled.files[0]);
});

// File Upload 40 //
const dropzoneBox40 = document.
getElementsByClassName("dropzone-box-40")
[0];

const inputFiles40 = document.
querySelectorAll(
    ".dropzone-area-40 input[type='file']"
);

const inputElement40 = inputFiles40[0];

const dropZoneElement40 = inputElement40.
closest(".dropzone-area-40");

inputElement40.addEventListener("change",
(e) => {
    if (inputElement40.files.length) {
        updateDropzoneFileList40
        (dropZoneElement40, inputElement40.files
            [0]);
    }
});

dropZoneElement40.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement40.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement40.addEventListener(type,
        (e) => {
            dropZoneElement40.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement40.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement40.files = e.dataTransfer.
        files;

        updateDropzoneFileList40
        (dropZoneElement40, e.dataTransfer.
        files[0]);
    }

    dropZoneElement40.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList40 = 
(dropzoneElement40, file) => {
    let dropzoneFileMessage = 
    dropzoneElement40.querySelector(".info-draganddrop-40");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox40.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement40.querySelector(".info-draganddrop-40");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox40.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-40");
    console.log(myFiled.files[0]);
});

// File Upload 41 //
const dropzoneBox41 = document.
getElementsByClassName("dropzone-box-41")
[0];

const inputFiles41 = document.
querySelectorAll(
    ".dropzone-area-41 input[type='file']"
);

const inputElement41 = inputFiles41[0];

const dropZoneElement41 = inputElement41.
closest(".dropzone-area-41");

inputElement41.addEventListener("change",
(e) => {
    if (inputElement41.files.length) {
        updateDropzoneFileList41
        (dropZoneElement41, inputElement41.files
            [0]);
    }
});

dropZoneElement41.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement41.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement41.addEventListener(type,
        (e) => {
            dropZoneElement41.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement41.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement41.files = e.dataTransfer.
        files;

        updateDropzoneFileList41
        (dropZoneElement41, e.dataTransfer.
        files[0]);
    }

    dropZoneElement41.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList41 = 
(dropzoneElement41, file) => {
    let dropzoneFileMessage = 
    dropzoneElement41.querySelector(".info-draganddrop-41");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox41.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement41.querySelector(".info-draganddrop-41");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox41.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-41");
    console.log(myFiled.files[0]);
});

// File Upload 42 //
const dropzoneBox42 = document.
getElementsByClassName("dropzone-box-42")
[0];

const inputFiles42 = document.
querySelectorAll(
    ".dropzone-area-42 input[type='file']"
);

const inputElement42 = inputFiles42[0];

const dropZoneElement42 = inputElement42.
closest(".dropzone-area-42");

inputElement42.addEventListener("change",
(e) => {
    if (inputElement42.files.length) {
        updateDropzoneFileList42
        (dropZoneElement42, inputElement42.files
            [0]);
    }
});

dropZoneElement42.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement42.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement42.addEventListener(type,
        (e) => {
            dropZoneElement42.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement42.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement42.files = e.dataTransfer.
        files;

        updateDropzoneFileList42
        (dropZoneElement42, e.dataTransfer.
        files[0]);
    }

    dropZoneElement42.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList42 = 
(dropzoneElement42, file) => {
    let dropzoneFileMessage = 
    dropzoneElement42.querySelector(".info-draganddrop-42");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox42.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement42.querySelector(".info-draganddrop-42");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox42.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-42");
    console.log(myFiled.files[0]);
});

// File Upload 43 //
const dropzoneBox43 = document.
getElementsByClassName("dropzone-box-43")
[0];

const inputFiles43 = document.
querySelectorAll(
    ".dropzone-area-43 input[type='file']"
);

const inputElement43 = inputFiles43[0];

const dropZoneElement43 = inputElement43.
closest(".dropzone-area-43");

inputElement43.addEventListener("change",
(e) => {
    if (inputElement43.files.length) {
        updateDropzoneFileList43
        (dropZoneElement43, inputElement43.files
            [0]);
    }
});

dropZoneElement43.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement43.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement43.addEventListener(type,
        (e) => {
            dropZoneElement43.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement43.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement43.files = e.dataTransfer.
        files;

        updateDropzoneFileList43
        (dropZoneElement43, e.dataTransfer.
        files[0]);
    }

    dropZoneElement43.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList43 = 
(dropzoneElement43, file) => {
    let dropzoneFileMessage = 
    dropzoneElement43.querySelector(".info-draganddrop-43");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox43.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement43.querySelector(".info-draganddrop-43");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox43.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-43");
    console.log(myFiled.files[0]);
});

// File Upload 44 //
const dropzoneBox44 = document.
getElementsByClassName("dropzone-box-44")
[0];

const inputFiles44 = document.
querySelectorAll(
    ".dropzone-area-44 input[type='file']"
);

const inputElement44 = inputFiles44[0];

const dropZoneElement44 = inputElement44.
closest(".dropzone-area-44");

inputElement44.addEventListener("change",
(e) => {
    if (inputElement44.files.length) {
        updateDropzoneFileList44
        (dropZoneElement44, inputElement44.files
            [0]);
    }
});

dropZoneElement44.addEventListener
("dragover", (e) => {
    e.preventDefault();
    dropZoneElement44.classList.add
    ("dropzone--over");
});

["dragleave", "dragend"].forEach((type) => {
    dropZoneElement44.addEventListener(type,
        (e) => {
            dropZoneElement44.classList.remove
            ("dropzone--over");
        });
});

dropZoneElement44.addEventListener("drop",
(e) => {
    e.preventDefault();

    if (e.dataTransfer.files.length) {
        inputElement44.files = e.dataTransfer.
        files;

        updateDropzoneFileList44
        (dropZoneElement44, e.dataTransfer.
        files[0]);
    }

    dropZoneElement44.classList.remove
    ("dropzone--over");
});

const updateDropzoneFileList44 = 
(dropzoneElement44, file) => {
    let dropzoneFileMessage = 
    dropzoneElement44.querySelector(".info-draganddrop-44");

    dropzoneFileMessage.innerHTML = `
        ${file.name}, ${file.size} bytes
    `;
};

dropzoneBox44.addEventListener("reset",
(e) => {
    let dropzoneFileMessage = 
    dropZoneElement44.querySelector(".info-draganddrop-44");

    dropzoneFileMessage.innerHTML = `Tidak ada file yang di pilih`;
});

dropzoneBox44.addEventListener("submit",
(e) => {
    e.preventDefault();
    const myFiled = document.getElementById
    ("upload-file-form-44");
    console.log(myFiled.files[0]);
});