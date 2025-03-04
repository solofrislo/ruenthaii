function updateBanner(formId) {
    const form = document.getElementById(formId);
    const formData = new FormData(form);

    $.ajax ({
        url: "Admin/ManageBanner/EditBanner.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.trim() === "แก้ไขแบนเนอร์สำเร็จ") {
                Swal.fire({
                    icon: "success",
                    title: "เเก้ไขเเบนเนอร์สำเร็จ",
                    confirmButtonText: "ตกลง"
                }).then(() => {
                    location.reload();
                });
            }else {
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: response,
                    comfirmButton: "ตกลง"
                });
            }
        },
        error: function(xhr, status,error) {
            console.error("Error:" , error);
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดในการเชื่อมต่อไฟล์ update",
                confirmButtonText: "ตกลง"
            });
        }
    });

}





// Save Banner
function insertBanner(formID) {
    const form = document.getElementById(formID);
    const formData = new FormData(form);
    $.ajax({
        url: "Admin/ManageBanner/insertbanner.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.trim() === "บันทึกเเบนเนอร์สำเร็จ") {
                Swal.fire({
                icon: "success",
                title: "เพิ่มเเบนเนอร์สำเร็จ",
                confirmButtonText: "ตกลง",
            }).then(() =>{
                location.reload();
            })

            } else {
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: response,
                    confirmButtonText: "ตกลง",
                });
            }
          
        },
        error: function(xhr, status, error){
            console.error("Error:" , error),
            Swal.fire ({
                icon: "error",
                title: "เกิดข้อผิดพลาดในการเชื่อมต่อ",
                text: "โปรดลองอีกครั้ง",
                confirmButtonText: "ตกลง",
            });
        }
    });
}

 // Delete Banner 
function deleteBanner(id) {
    let banner_id = id;
    Swal.fire({
        title: '<span class="h5 text-dark fw-bold">คุณต้องการลบเเบนเนอร์ใช่หรือไม้</span>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax ({
                url: "Admin/ManageBanner/DeleteBannner.php",
                type: "POST",
                data: {
                    'banner_id' : banner_id
                },
                dataType: 'json', 
                cache: false,
                success: function(response) {
                    if (response.status == "success") {
                        Swal.fire({
                            icon: "success",
                            title: '<span class="h5 text-dark fw-bold">' + response.message + '</span>',
                            confirmButtonColor: '#198754',
                            showConfirmButton: true,
                            confirmButtonText: 'ตกลง',
                        }).then(() => {
                            $.ajax({
                                url: "Admin/ManageBanner/SelectManageBanner.php",
                                type: "GET",
                                success: function(html) {
                                    $('#Show-banner').html(html);
                                }
                            });
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: '<span class="h5 text-dark fw-bold">เกิดข้อผิดพลาด</span>',
                            text: response.message,
                            confirmButtonColor: '#d33',
                            showConfirmButton: true,
                            confirmButtonText: 'ตกลง',
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: '<span class="h5 text-dark fw-bold">ข้อผิดพลาดการเชื่อมต่อ</span>',
                        text: 'โปรดลองอีกครั้ง',
                        confirmButtonColor: '#d33',
                        showConfirmButton: true,
                        confirmButtonText: 'ตกลง',
                    });
                }
            });
        }
    });
}


    //Show previewImage
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove("d-none"); // แสดงตัวอย่างรูปภาพ
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "#";
            preview.classList.add("d-none"); // ซ่อนตัวอย่างรูปภาพ
        }
    }