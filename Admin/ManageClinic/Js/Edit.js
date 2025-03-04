// --------------------------------- Update_Clinic --------------------------------->
function updateClinic() {
    let form = document.getElementById("editClinicForm");
    let formData = new FormData(form);

    $.ajax({
        url: "Admin/ManageClinic/Edit_update.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            response = response.trim();
            Swal.fire({
                icon: response.includes("สำเร็จ") ? "success" : "error",
                title: response,
                confirmButtonText: "ตกลง",
            }).then(() => {
                if (response.includes("สำเร็จ")) {
                    window.location.href = "Admin.php?action=ManageClinic";
                }
            });
        },
        error: function (xhr, status, error) {
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
            previewContainer.style.display = "flex";
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
            previewContainer.style.display = "flex";
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
let sectionCounter = document.querySelectorAll('#dynamicFields .row').length;

// ตรวจสอบและเพิ่มปุ่มลบให้ฟิลด์ที่โหลดมาจากฐานข้อมูล
document.querySelectorAll('#dynamicFields .row').forEach(row => {
    if (!row.querySelector('.removeField')) {
        let removeButtonContainer = document.createElement('div');
        removeButtonContainer.className = "col-md-12 text-end mt-2";

        let removeButton = document.createElement('button');
        removeButton.type = "button";
        removeButton.className = "btn btn-danger btn-sm removeField";
        removeButton.style.width = "auto";
        removeButton.style.padding = "5px 15px";
        removeButton.innerHTML = '<i class="fa fa-trash-alt"></i> ลบหัวข้อ';

        removeButtonContainer.appendChild(removeButton);
        row.appendChild(removeButtonContainer);
    }
});

// ฟังก์ชันเพิ่ม section ใหม่
document.getElementById('addField').addEventListener('click', function () {
    if (sectionCounter < 5) {
        sectionCounter++;
        const container = document.getElementById('dynamicFields');
        const newRow = document.createElement('div');
        newRow.classList.add('row', 'align-items-center', 'mb-3');

        newRow.innerHTML = `
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" name="section_${sectionCounter}" class="form-control txt16 shadow-none" placeholder="ใส่ข้อมูลหัวข้อเนื้อหา" required>
                    <label class="text-secondary txt16">ใส่ข้อมูลหัวข้อเนื้อหา</label>
                    <div class="invalid-feedback">กรุณากรอกข้อมูล</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mt-3">
                    <textarea name="subhead_${sectionCounter}" class="form-control txt16 shadow-none" placeholder="ใส่รายละเอียดเนื้อหา"></textarea>
                    <label class="text-secondary txt16">ใส่รายละเอียดเนื้อหา</label>
                </div>
            </div>
            <div class="col-md-12 text-end mt-2">
                <button type="button" class="btn btn-danger btn-sm removeField" style="width: auto; padding: 5px 15px;">
                    <i class="fa fa-trash-alt"></i> ลบหัวข้อ
                </button>
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

// ใช้ Event Delegation เพื่อลบ section
document.getElementById('dynamicFields').addEventListener('click', function (e) {
    if (e.target && e.target.closest('.removeField')) {
        e.target.closest('.row').remove();
        sectionCounter--;
    }
});
// <!------------------------------------------> Counst - Image and Image_content ---------------------------------------->
document.addEventListener("DOMContentLoaded", function () {
    updateAddButtonVisibility();
    sortImageFields();
});

function getNextAvailableIndex() {
    let existingFields = document.querySelectorAll('#imageFields .col-md-4[id^="imageField"]');
    let existingIndexes = Array.from(existingFields).map(field =>
        parseInt(field.id.replace("imageField", ""), 10)
    );

    for (let i = 1; i <= 3; i++) {
        if (!existingIndexes.includes(i)) {
            return i;
        }
    }
    return null;
}

function updateAddButtonVisibility() {
    const addImageContainer = document.getElementById("addImageContainer");
    let visibleImages = document.querySelectorAll('#imageFields .col-md-4[id^="imageField"]').length;
    addImageContainer.style.display = visibleImages < 3 ? "block" : "none";
}

function updatePreview(event, index) {
    let file = event.target.files[0];
    console.log(`ไฟล์ที่เลือก:`, file); 
    if (file) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let previewImage = document.getElementById(`previewImage${index}`);
            previewImage.src = e.target.result;
            document.getElementById(`previewContainer${index}`).style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}


function sortImageFields() {
    const container = document.getElementById("imageFields");
    let fields = Array.from(container.getElementsByClassName("col-md-4"))
        .filter(div => div.id.startsWith("imageField"));

    fields.sort((a, b) => {
        let idA = parseInt(a.id.replace("imageField", ""), 10);
        let idB = parseInt(b.id.replace("imageField", ""), 10);
        return idA - idB;
    });

    fields.forEach(field => container.insertBefore(field, document.getElementById("addImageContainer")));
    updateAddButtonVisibility();
}

function deleteImage(index) {
    let fieldToRemove = document.getElementById(`imageField${index}`);
    let deleteInput = document.getElementById(`delete_image_${index}`);
    let imageInput = document.getElementById(`imageFile${index}`);
    let contentInput = document.getElementById(`imageContent${index}`);

    if (fieldToRemove && deleteInput) {
        fieldToRemove.style.display = "none";
        deleteInput.value = "1";
        if (imageInput) imageInput.value = "";
        if (contentInput) contentInput.value = "";
    }

    updateAddButtonVisibility();
}

document.getElementById('addImageField').addEventListener('click', function () {
    let nextIndex = getNextAvailableIndex();
    if (nextIndex !== null) {
        const container = document.getElementById('imageFields');
        const newField = document.createElement('div');
        newField.classList.add('col-md-4');
        newField.setAttribute('id', `imageField${nextIndex}`);

        newField.innerHTML = `
            <div class="p-2 border rounded text-center">
             
                <input type="file" class="form-control d-none" id="imageFile${nextIndex}"
                    name="image_${nextIndex}" accept="image/*"
                    onchange="updatePreview(event, ${nextIndex})">

                <div id="previewContainer${nextIndex}" class="mt-2" style="display: none;">
                    <img id="previewImage${nextIndex}" class="img-fluid rounded border" style="max-width: 200px;">
                </div>

                <div class="form-floating mt-2">
                    <input type="text" id="imageContent${nextIndex}" name="image_content_${nextIndex}"
                        class="form-control txt16 shadow-none" placeholder="คำอธิบายสำหรับรูปที่ ${nextIndex}">
                    <label class="text-secondary txt16">คำอธิบายสำหรับรูปที่ ${nextIndex}</label>
                </div>
                <div class="d-flex justify-content-center align-items-center gap-2 mt-2">
                    <label for="imageFile${nextIndex}" class="btn btn-success border txt12">
                        <i class="fas fa-images"></i> เพิ่มรูปภาพ
                    </label>
                    <input type="hidden" name="delete_image_${nextIndex}" id="delete_image_${nextIndex}" value="0">
                    <button type="button" class="btn btn-danger btn-sm removeImage " data-id="${nextIndex}" onclick="deleteImage(${nextIndex})">
                        <i class="fa fa-trash-alt"></i> ลบ
                    </button>
                </div>
            </div>
        `;

        container.insertBefore(newField, document.getElementById("addImageContainer"));
        updateAddButtonVisibility();
    }
});


// <!------------------------------------------>  Update_location_Textarea  ---------------------------------------->

// ฟังก์ชันอัปเดตช่อง textarea ตามค่าที่เลือกใน dropdown
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

    if (select.value === "เลือกหรือระบุวันเวลาให้บริการเอง") {
        // เปลี่ยน select เป็น input ให้กรอกเอง
        var input = document.createElement("input");
        input.type = "text";
        input.name = "opening_days";
        input.className = "form-control txt16 shadow-none";
        input.placeholder = "ระบุเวลาทำการ";
        input.id = "openHoursSelect";
        input.value = ""; // กำหนดค่าเป็นค่าว่างเสมอเพื่อให้ผู้ใช้กรอกเอง

        // เมื่อ focus หาย ให้เปลี่ยนกลับเป็น select พร้อมเก็บค่าที่พิมพ์
        input.onblur = function() {
            revertToSelect(input);
        };

        select.parentNode.replaceChild(input, select);
        input.focus();
    }
}

// <!------------------------------------------>  Select_opening  ---------------------------------------->
function revertToSelect(input) {
    var select = document.createElement("select");
    select.className = "form-select txt16 shadow-none";
    select.id = "openHoursSelect";
    select.name = "opening_days";
    select.onchange = handleOpeningDays;

    var options = [
        "เลือกหรือระบุวันเวลาให้บริการ",
        "ทุกวันจันทร์ - เวลา 08.00 - 16.00 น.",
        "ทุกวันอังคาร - เวลา 08.00 - 16.00 น.",
        "ทุกวันพุธ - เวลา 08.00 - 16.00 น.",
        "ทุกวันพฤหัสบดี - เวลา 08.00 - 16.00 น.",
        "ทุกวันศุกร์ - เวลา 08.00 - 16.00 น.",
        "เลือกหรือระบุวันเวลาให้บริการเอง"
    ];

    // รับค่าที่ผู้ใช้พิมพ์
    var userValue = input.value.trim();

    options.forEach(function(text, index) {
        var option = document.createElement("option");
        option.value = text;
        option.textContent = text;
        if (index === 0) option.disabled = true;
        if (text === "<?= htmlspecialchars($clinic['opening_days']) ?>") option.selected = true;
        select.appendChild(option);
    });

    // ถ้ามีค่าที่พิมพ์เอง ให้เพิ่มเป็น option ใหม่
    if (userValue && !options.includes(userValue)) {
        var customOption = document.createElement("option");
        customOption.value = userValue;
        customOption.textContent = userValue;
        customOption.selected = true;
        select.appendChild(customOption);
    }

    input.parentNode.replaceChild(select, input);
}
