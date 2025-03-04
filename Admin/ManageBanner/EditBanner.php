<?php
require '../../Connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $banner_id = $_POST['banner_id'];
    $banner_sort = $_POST['banner_sort'];
    $fileName = null;

    // ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
    if (isset($_FILES['banner_img']) && $_FILES['banner_img']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['banner_img']['tmp_name'];
        $fileExtension = strtolower(pathinfo($_FILES['banner_img']['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        // ตรวจสอบประเภทไฟล์
        if (in_array($fileExtension, $allowedExtensions)) {
            list($width, $height) = getimagesize($fileTmpPath);
            if ($width == 945 && $height == 445) {
                // ดึงชื่อไฟล์เก่าจากฐานข้อมูล
                $qry_select = "SELECT banner_img FROM banner WHERE banner_id = ?";
                $stmtSelect = mysqli_prepare($dbcon, $qry_select);
                mysqli_stmt_bind_param($stmtSelect, "i", $banner_id);
                mysqli_stmt_execute($stmtSelect);
                mysqli_stmt_bind_result($stmtSelect, $oldFileName);
                mysqli_stmt_fetch($stmtSelect);
                mysqli_stmt_close($stmtSelect);

                $uploadFileDir = __DIR__ . '/../../Img/ImgBanner/';
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0777, true);
                }

                // เปลี่ยนชื่อไฟล์ให้ไม่ซ้ำ
                $originalFileName = $_FILES['banner_img']['name'];
                $uniqueFileName = uniqid() . '_' . $originalFileName;
                $destPath = $uploadFileDir . $uniqueFileName;

                // ย้ายไฟล์ใหม่เข้าโฟลเดอร์
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    // ลบไฟล์เก่าถ้ามีอยู่ในโฟลเดอร์
                    if ($oldFileName && file_exists($uploadFileDir . $oldFileName)) {
                        unlink($uploadFileDir . $oldFileName);
                    }

                    $fileName = $uniqueFileName; // ตั้งชื่อไฟล์ใหม่สำหรับอัปเดตในฐานข้อมูล
                } else {
                    echo "เกิดข้อผิดพลาดในการย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด";
                    exit;
                }
            } else {
                echo "ขนาดรูปภาพไม่ถูกต้อง! (กรุณาอัปโหลดรูปภาพขนาด 945x445 พิกเซล)";
                exit;
            }
        } else {
            echo "ประเภทนามสกุลไฟล์ไม่ถูกต้อง! (เฉพาะ JPG, JPEG, PNG เท่านั้น)";
            exit;
        }
    }

    // อัปเดตข้อมูลในฐานข้อมูล
    $updateQuery = "UPDATE banner SET banner_sort = ?" . ($fileName ? ", banner_img = ?" : "") . " WHERE banner_id = ?";
    $stmt = mysqli_prepare($dbcon, $updateQuery);
    if ($fileName) {
        mysqli_stmt_bind_param($stmt, "ssi", $banner_sort, $fileName, $banner_id);
    } else {
        mysqli_stmt_bind_param($stmt, "si", $banner_sort, $banner_id);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo "แก้ไขแบนเนอร์สำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($dbcon);
    }

    mysqli_stmt_close($stmt);
}
?>