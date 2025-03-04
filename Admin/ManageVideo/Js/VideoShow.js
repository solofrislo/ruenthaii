document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('videoForm').addEventListener('submit', saveVideo);
    document.getElementById('search_video').addEventListener('input', searchVideo);
    
    $('#insertVideoModal').on('hidden.bs.modal', function () {
        resetUploadForm();
    });

    setupUploadTypeEvent();
    setupImagePreviewEvent();
    toggleUploadFields();
});

// -----------------------------------------

function saveVideo(event) {
    event.preventDefault();

    const form = event.target;
    const uploadType = document.getElementById('uploadType');
    const videoLinkField = document.getElementById('video_link');
    const videoFileField = document.getElementById('video_file');
    const videoFile = videoFileField.files.length > 0 ? videoFileField.files[0] : null;
    const videoImageFile = document.getElementById("video_image_file");

    if (uploadType.value === "url" && videoLinkField.value.trim() === "") {
        Swal.fire({ icon: 'error', title: 'โปรดใส่ลิงก์วิดีโอ' });
        return;
    }

    if (uploadType.value === "file" && !videoFile) {
        Swal.fire({ icon: 'error', title: 'โปรดอัปโหลดไฟล์วิดีโอ' });
        return;
    }

    if (videoFile && videoFile.size > 150 * 1024 * 1024) {
        Swal.fire({ icon: 'error', title: 'ขนาดไฟล์วิดีโอใหญ่เกินไป', text: 'โปรดอัปโหลดไฟล์ที่มีขนาดไม่เกิน 150MB' });
        return;
    }

    const formData = new FormData(form);
    formData.append("uploadType", uploadType.value);

    fetch('Admin/ManageVideo/InsertManageVideo.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            Swal.fire({ icon: 'error', title: 'เกิดข้อผิดพลาด', text: data.error });
            return;
        }

        Swal.fire({
            icon: 'success',
            title: 'บันทึกสำเร็จ!',
            text: 'วิดีโอถูกเพิ่มเรียบร้อยแล้ว',
            confirmButtonText: 'ตกลง'
        }).then(() => {
            resetUploadForm(); 
            $('#insertVideoModal').modal('hide'); 
            setTimeout(loadVideos, 500); 
        });
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({ icon: 'error', title: 'เกิดข้อผิดพลาดในการเชื่อมต่อ' });
    });
}

// -----------------------------------------

function toggleUploadFields() {
    const uploadType = document.getElementById("uploadType");
    const videoLinkGroup = document.getElementById("videoLinkGroup");
    const videoFileGroup = document.getElementById("videoFileGroup");

    if (uploadType.value === "url") {
        videoLinkGroup.style.display = "block";
        videoFileGroup.style.display = "none";
    } else if (uploadType.value === "file") {
        videoLinkGroup.style.display = "none";
        videoFileGroup.style.display = "block";
    } else {
        videoLinkGroup.style.display = "none";
        videoFileGroup.style.display = "none";
    }
}

function resetUploadForm() {
    document.getElementById('videoForm').reset();
    const uploadType = document.getElementById('uploadType');
    uploadType.value = "";

    const videoImagePreview = document.getElementById("video_image_preview");
    videoImagePreview.style.display = "none";
    videoImagePreview.src = "";

    document.getElementById("video_image_file").value = "";

    setTimeout(() => {
        toggleUploadFields(); 
        setupUploadTypeEvent(); 
        setupImagePreviewEvent(); 
    }, 50);
}

function setupUploadTypeEvent() {
    const uploadType = document.getElementById("uploadType");
    uploadType.removeEventListener("change", toggleUploadFields); 
    uploadType.addEventListener("change", toggleUploadFields);
}

function setupImagePreviewEvent() {
    const videoImageFile = document.getElementById("video_image_file");
    videoImageFile.removeEventListener("change", updateImagePreview);
    videoImageFile.addEventListener("change", updateImagePreview);
}

function updateImagePreview(event) {
    const file = event.target.files[0];
    const videoImagePreview = document.getElementById("video_image_preview");

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            videoImagePreview.src = e.target.result;
            videoImagePreview.style.display = "block";
        };
        reader.readAsDataURL(file);
    } else {
        videoImagePreview.style.display = "none";
    }
}

$('#insertVideoModal').on('hidden.bs.modal', function () {
    resetUploadForm();
});
// --------------------------------------------------------------



function saveEditedVideo(event, videoId) {
    event.preventDefault();

    Swal.fire({
        title: 'ยืนยันการแก้ไขข้อมูลวิดีโอ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('editVideoForm' + videoId);
            const formData = new FormData(form);
            const videoFileField = document.getElementById('videoFile' + videoId);
            const videoFile = videoFileField.files[0];

            if (videoFile) {
                const maxSize = 150 * 1024 * 1024; // 150MB
                if (videoFile.size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'ไฟล์ใหญ่เกินไป!',
                        text: 'โปรดอัปโหลดวิดีโอขนาดไม่เกิน 150MB',
                        confirmButtonText: 'ตกลง'
                    });
                    return;
                }
            } else {
                formData.delete("video_file");
            }

            const removeImageInput = document.getElementById('removeImageInput' + videoId);
            if (removeImageInput && removeImageInput.value === "1") {
                formData.append("remove_image", "1");
            }

            fetch('Admin/ManageVideo/edit_video.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            text: data.error || 'ไม่สามารถบันทึกข้อมูลได้',
                            confirmButtonText: 'ลองใหม่'
                        });
                        return;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'บันทึกสำเร็จ!',
                        text: 'ข้อมูลวิดีโอได้รับการแก้ไขเรียบร้อยแล้ว',
                        confirmButtonText: 'ตกลง'
                    }).then(() => {
                        const modal = document.getElementById('editModal' + videoId);
                        bootstrap.Modal.getInstance(modal)?.hide();
                        loadVideos();
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด!',
                        text: error.message || 'ไม่สามารถติดต่อเซิร์ฟเวอร์ได้.',
                        confirmButtonText: 'ลองใหม่'
                    });
                });
        }
    });
}


function removeVideoImage(videoId) {
    const imagePreview = document.getElementById('editVideoImagePreview' + videoId);
    if (imagePreview) {
        imagePreview.style.display = 'none';
        imagePreview.src = ''; // เคลียร์ค่าของรูป
    }

    const removeBtn = document.getElementById('removeVideoImageBtn' + videoId);
    if (removeBtn) {
        removeBtn.style.display = 'none';
    }

    const videoImageInput = document.getElementById('editVideoImage' + videoId);
    if (videoImageInput) {
        videoImageInput.value = ""; // รีเซ็ต input file
    }

    const form = document.getElementById('editVideoForm' + videoId);
    if (form) {
        let removeImageInput = document.getElementById('removeImageInput' + videoId);
        if (!removeImageInput) {
            removeImageInput = document.createElement('input');
            removeImageInput.type = 'hidden';
            removeImageInput.id = 'removeImageInput' + videoId;
            removeImageInput.name = 'remove_image';
            form.appendChild(removeImageInput);
        }
        removeImageInput.value = '1';
    }
}



function loadVideos() {
    fetch('Admin/ManageVideo/SelectManageVideo.php')
        .then(response => response.text())
        .then(html => {
            document.getElementById('Show-video').innerHTML = html;
            setupEventListeners();

            resetUploadForm();
        })
        .catch(error => {
            console.error('เกิดข้อผิดพลาด:', error);
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาดในการโหลดวิดีโอ',
                text: 'โปรดลองใหม่อีกครั้ง',
                confirmButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
            });
        });
}




function searchVideo() {
    const searchQuery = document.getElementById('search_video').value.trim();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "Admin/ManageVideo/SelectManageVideo.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('Show-video').innerHTML = xhr.responseText;
            setupEventListeners();
        }
    };

    xhr.send(searchQuery === "" ? null : "search=" + encodeURIComponent(searchQuery));
}
function setupEventListeners() {
    const videoForm = document.getElementById('videoForm');
    if (videoForm) {
        videoForm.removeEventListener('submit', saveVideo);
        videoForm.addEventListener('submit', saveVideo);
    }
} 

function deletevideo(id) {
    Swal.fire({
        title: 'คุณต้องการลบข้อมูลวิดีโอใช่หรือไม่',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("Admin/ManageVideo/delete_video.php", {
                method: "POST",
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ 'video_id': id })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบวิดีโอสำเร็จ',
                            confirmButtonColor: '#198754',
                            confirmButtonText: 'ตกลง',
                        }).then(() => {
                            loadVideos(); // โหลดข้อมูลใหม่
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: data.error || 'ไม่สามารถลบข้อมูลได้',
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'ตกลง',
                        });
                    }
                })
                .catch(error => {
                    console.error("Fetch error:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาดในการเชื่อมต่อ',
                        text: 'โปรดลองใหม่อีกครั้ง',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'ตกลง',
                    });
                });
        }
    });
}

// -----------------------------------------

function toggleUploadFields() {
    const uploadType = document.getElementById("uploadType");
    const videoLinkGroup = document.getElementById("videoLinkGroup");
    const videoFileGroup = document.getElementById("videoFileGroup");

    console.log("toggleUploadFields called, uploadType.value =", uploadType.value);

    if (uploadType.value === "url") {
        videoLinkGroup.style.display = "block";
        videoFileGroup.style.display = "none";
    } else if (uploadType.value === "file") {
        videoLinkGroup.style.display = "none";
        videoFileGroup.style.display = "block";
    } else {
        videoLinkGroup.style.display = "none";
        videoFileGroup.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('videoForm').addEventListener('submit', saveVideo);
    document.getElementById('search_video').addEventListener('input', searchVideo);

    $('#insertVideoModal').on('hidden.bs.modal', function () {
        resetUploadForm();
    });

    $('#insertVideoModal').on('shown.bs.modal', function () {
        setupUploadTypeEvent();
        toggleUploadFields();
    });

    setupUploadTypeEvent();
    toggleUploadFields();
});

function setupEditImagePreview(videoId) {
    let imageInput = document.getElementById("editVideoImage" + videoId);
    let imagePreview = document.getElementById("editVideoImagePreview" + videoId);

    if (imageInput) {
        imageInput.addEventListener("change", function(event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = "block";
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = "none";
            }
        });
    }
}

document.addEventListener("DOMContentLoaded", function() {
    let editModals = document.querySelectorAll('[id^="editModal"]');
    editModals.forEach(modal => {
        modal.addEventListener("shown.bs.modal", function() {
            let videoId = modal.id.replace("editModal", "");
            setupEditImagePreview(videoId);
        });
    });
});


function toggleEditVideoFields(videoId) {
    let uploadType = document.getElementById("editUploadType" + videoId);
    let videoLinkGroup = document.getElementById("editVideoLinkGroup" + videoId);
    let videoFileGroup = document.getElementById("editVideoFileGroup" + videoId);

    if (uploadType.value === "url") {
        videoLinkGroup.style.display = "block";
        videoFileGroup.style.display = "none";
    } else if (uploadType.value === "file") {
        videoLinkGroup.style.display = "none";
        videoFileGroup.style.display = "block";
    } else {
        videoLinkGroup.style.display = "none";
        videoFileGroup.style.display = "none";
    }
}


// Show-Image-Video
function showVideo(wrapperId, videoId) {
    document.getElementById(wrapperId).style.display = "none"; // ซ่อนรูปปก
    document.getElementById(videoId).style.display = "block";  // แสดงวิดีโอ
}

