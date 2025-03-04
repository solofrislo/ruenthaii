document.addEventListener("click", function(event) {
    if (event.target.classList.contains("delete-btn")) {
        let clinicID = event.target.getAttribute("data-clinic-id"); // ดึงค่า clinic_id จาก data-attribute
        confirmDelete(clinicID);
    }
});

function confirmDelete(clinicID) {
    Swal.fire({
        title: "ยืนยันการลบ?",
        text: "คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "ลบ!",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "Admin/ManageClinic/delete_clinic.php",
                type: "POST",
                data: {
                    clinic_id: clinicID
                },
                success: function(response) {
                    console.log("Response:", response);
                    Swal.fire({
                        icon: response.includes("สำเร็จ") ? "success" : "error",
                        title: response,
                        confirmButtonText: "ตกลง"
                    }).then(() => {
                        if (response.includes("สำเร็จ")) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "โปรดลองอีกครั้ง",
                        confirmButtonText: "ตกลง"
                    });
                }
            });
        }
    });
}


function searchClinic() {
    const searchQuery = document.getElementById('search_clinic').value.trim();

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "Admin/ManageClinic/SelectManageClinic.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('clinic_list').innerHTML = xhr.responseText;
        }
    };
    xhr.send("search=" + encodeURIComponent(searchQuery));
}