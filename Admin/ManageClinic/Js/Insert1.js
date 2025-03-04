// <!------------------------------------------> Save_clinic_insert ---------------------------------------->
function insertClinic(formID) {
    const form = document.getElementById(formID);
    if (!form) {
        console.error("Form not found: ", formID);
        return;
    }

    const formData = new FormData(form);

    $.ajax({
        url: "Admin/ManageClinic/insert_clinic.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            response = response.trim();
            console.log("Response:", response);

            Swal.fire({
                icon: response.includes("สำเร็จ") ? "success" : "error",
                title: response,
                confirmButtonText: "ตกลง",
            }).then(() => {
                if (response.includes("สำเร็จ")) {
                    window.location.href = "Admin.php?action=ManageClinic"; // รีไดเร็กไปยังหน้าที่ต้องการ
                }
            });
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "โปรดลองอีกครั้ง",
                confirmButtonText: "ตกลง",
            });
        },
    });
}


// <!------------------------------------------> Update_Picture_head ---------------------------------------->
function updatePreviewHead(event) {
    var input = event.target;
    var previewContainer = document.getElementById("previewContainerHead");
    var previewImage = document.getElementById("previewImageHead");
    var removeButton = document.getElementById("removeImageBtnHead");

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.style.display = "block";
            previewContainer.style.display = "flex"; // แสดงในรูปแบบ flex
            removeButton.style.display = "block";
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function removePreviewHead() {
    var previewContainer = document.getElementById("previewContainerHead");
    var previewImage = document.getElementById("previewImageHead");
    var removeButton = document.getElementById("removeImageBtnHead");
    var fileInput = document.querySelector("input[name='head_img']");

    previewImage.src = "";
    previewImage.style.display = "none";
    previewContainer.style.display = "none";
    removeButton.style.display = "none";
    fileInput.value = "";
}


// <!------------------------------------------> Update_Picture_location ---------------------------------------->
function updatePreviewLocation(event) {
    var input = event.target;
    var previewContainer = document.getElementById("previewContainerLocation");
    var previewImage = document.getElementById("previewImageLocation");
    var removeButton = document.getElementById("removeImageBtnLocation");

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.style.display = "block";
            previewContainer.style.display = "flex"; // แสดงในรูปแบบ flex
            removeButton.style.display = "block";
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function removePreviewLocation() {
    var previewContainer = document.getElementById("previewContainerLocation");
    var previewImage = document.getElementById("previewImageLocation");
    var removeButton = document.getElementById("removeImageBtnLocation");
    var fileInput = document.querySelector("input[name='location_img']");

    previewImage.src = "";
    previewImage.style.display = "none";
    previewContainer.style.display = "none";
    removeButton.style.display = "none";
    fileInput.value = "";
}




// <!------------------------------------------> Counst - Section and Subhead ---------------------------------------->

let sectionCounter = 1;

document.getElementById('addField').addEventListener('click', function () {
    if (sectionCounter < 5) {
        sectionCounter++;
        const container = document.getElementById('dynamicFields');
        const newRow = document.createElement('div');
        newRow.classList.add('row', 'align-items-center');

        newRow.innerHTML = `
            <div class="col-md-6 mt-3">
                <h5 class="text-danger txt18 ">หัวข้อเนื้อหาที่ ${sectionCounter}</h5>
                <div class="form-floating">
                    <input type="text" name="section_${sectionCounter}" class="form-control txt16 shadow-none " placeholder="หัวข้อเนื้อหา" required>
                    <label class="text-secondary txt16">หัวข้อเนื้อหา</label>
                    <div class="invalid-feedback">กรุณากรอกข้อมูล</div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
            <h5 class="text-danger txt18 ">รายละเอียดเนื้อหาที่ ${sectionCounter}</h5>
                <div class="form-floating ">
                    <textarea name="subhead_${sectionCounter}" class="form-control txt16 shadow-none " placeholder="ใส่ข้อมูลหัวข้อเนื้อหา"></textarea>
                    <label class="text-secondary txt16">ใส่ข้อมูลหัวข้อเนื้อหา</label>
                </div>
            </div>
            <div class="col-md-12 text-end mt-2">
                <button type="button" class="btn btn-danger btn-sm removeField"><i class="fa fa-trash-alt"></i> ลบหัวข้อ</button>
            </div>
        `;

        container.appendChild(newRow);
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'ไม่สามารถเพิ่มหัวข้อได้',
            text: 'สามารถเพิ่มหัวข้อได้สูงสุด 5 หัวข้อ',
            confirmButtonText: 'ตกลง',
            confirmButtonColor: '#d33'
        });
    }
});

document.getElementById('dynamicFields').addEventListener('click', function (e) {
    if (e.target && e.target.closest('.removeField')) {
        e.target.closest('.row').remove();
        sectionCounter--;
    }
});
// <!------------------------------------------> Counst - Image and Image_content ---------------------------------------->
let imageCounter = 0;
document.getElementById('addImageField').addEventListener('click', function () {
    if (imageCounter < 3) {
        imageCounter++;

        const container = document.getElementById('imageFields');
        const newField = document.createElement('div');
        newField.classList.add('col-md-4');
        newField.setAttribute('id', `imageField${imageCounter}`);

        // สร้างโครงสร้างภายในช่องอัปโหลดรูปภาพ
        newField.innerHTML = `
            <div class="p-2 border rounded text-center">
                <input type="file" class="form-control d-none" id="imageFile${imageCounter}" 
                    name="image_${imageCounter}" accept="image/*"
                    onchange="updatePreview(event, ${imageCounter})">
                <div id="previewContainer${imageCounter}" class="mt-2" style="display: none;">
                    <img id="previewImage${imageCounter}" class="img-fluid rounded border" style="max-width: 200px;">
                </div>
                <div class="form-floating mt-2">
                    <input type="text" id="imageContent${imageCounter}" name="image_content_${imageCounter}" 
                        class="form-control txt16 shadow-none" placeholder="คำอธิบายสำหรับรูปที่ ${imageCounter}">
                    <label class="text-secondary txt16">คำอธิบายสำหรับรูปที่ ${imageCounter}</label>
                </div>
                <div class="d-flex justify-content-center align-items-center gap-2 mt-2"> 
                    <label for="imageFile${imageCounter}" class="btn btn-success border txt12">
                        <i class="fas fa-images"></i> เพิ่มรูปภาพ
                    </label>
                    <button type="button" class="btn btn-danger btn-sm removeImage " data-id="${imageCounter}">
                        <i class="fa fa-trash-alt"></i> ลบ
                    </button>
                </div>
            </div>
        `;

        container.appendChild(newField);
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'ไม่สามารถเพิ่มรูปภาพได้',
            text: 'สามารถเพิ่มรูปภาพได้สูงสุด 3 รูป',
            confirmButtonText: 'ตกลง',
            confirmButtonColor: '#d33'
        });
    }
});

// ฟังก์ชันแสดงตัวอย่างรูปภาพ
function updatePreview(event, index) {
    let file = event.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById(`previewImage${index}`).src = e.target.result;
            document.getElementById(`previewContainer${index}`).style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}

// ฟังก์ชันลบช่องอัปโหลดรูปภาพ
document.getElementById('imageFields').addEventListener('click', function (e) {
    if (e.target && e.target.closest('.removeImage')) {
        let id = e.target.closest('.removeImage').getAttribute('data-id');
        document.getElementById(`imageField${id}`).remove();
        imageCounter--;
    }
});

// <!------------------------------------------>  Update_location_Textarea  ---------------------------------------->

function updateTextarea() {
    const selectElement = document.getElementById('openHoursSelect');
    const textareaElement = document.getElementById('openHoursTextarea');
    const selectedValue = selectElement.value;

    if (selectedValue) {
        textareaElement.value = selectedValue;
    }
}


function handleOpeningDays() {
    var select = document.getElementById("openHoursSelect");
    var label = document.getElementById("openHoursLabel");
    
    if (select.value === "เลือกหรือระบุวันเวลาให้บริการเอง") {
        // เปลี่ยน select เป็น input
        var input = document.createElement("input");
        input.type = "text";
        input.name = "opening_days";
        input.className = "form-control txt16 shadow-none";
        input.placeholder = "ระบุเวลาทำการ";
        input.id = "openHoursSelect"; // ใช้ id เดิมแทน select
        input.onblur = function() { revertToSelect(input); }; // เมื่อ focus หาย ให้เปลี่ยนกลับเป็น select

        select.parentNode.replaceChild(input, select); // แทนที่ select ด้วย input
        input.focus(); // ให้ focus อัตโนมัติ
    }
}

function revertToSelect(input) {
    var select = document.createElement("select");
    select.className = "form-select txt16 shadow-none";
    select.id = "openHoursSelect";
    select.name = "opening_days";
    select.onchange = handleOpeningDays;

    // ตัวเลือกเดิม
    var options = [
        "เลือกหรือระบุวันเวลาให้บริการ",
        "ทุกวันจันทร์ - เวลา 08.00 - 16.00 น.",
        "ทุกวันอังคาร - เวลา 08.00 - 16.00 น.",
        "ทุกวันพุธ - เวลา 08.00 - 16.00 น.",
        "ทุกวันพฤหัสบดี - เวลา 08.00 - 16.00 น.",
        "ทุกวันศุกร์ - เวลา 08.00 - 16.00 น.",
        "เลือกหรือระบุวันเวลาให้บริการเอง"
    ];

    options.forEach(function(text, index) {
        var option = document.createElement("option");
        option.value = text === "เลือกหรือระบุวันเวลาให้บริการเอง" ? "เลือกหรือระบุวันเวลาให้บริการเอง" : text;
        option.textContent = text;
        if (index === 0) option.disabled = true;
        select.appendChild(option);
    });

    // ถ้ามีค่าที่ผู้ใช้กรอก ให้ตั้งเป็นตัวเลือกใหม่
    if (input.value.trim() !== "") {
        var เลือกหรือระบุวันเวลาให้บริการเองOption = document.createElement("option");
        เลือกหรือระบุวันเวลาให้บริการเองOption.value = input.value;
        เลือกหรือระบุวันเวลาให้บริการเองOption.textContent = input.value;
        เลือกหรือระบุวันเวลาให้บริการเองOption.selected = true;
        select.appendChild(เลือกหรือระบุวันเวลาให้บริการเองOption);
    }

    input.parentNode.replaceChild(select, input); // แทนที่ input ด้วย select
}