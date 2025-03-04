<?php 
require '../../Connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['banner_img']) && $_FILES['banner_img']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['banner_img']['tmp_name'];
        $fileExtension = strtolower(pathinfo($_FILES['banner_img']['name'], PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedExtensions)) {
            list($width, $height) = getimagesize($fileTmpPath);
            if ($width == 945 && $height == 445) {
                $uploadFileDir = __DIR__ . '/../../Img/ImgBanner/';
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0777, true);
                }
                
                $originalFileName = $_FILES['banner_img']['name'];
                $uniqueFileName = uniqid() . '_' . $originalFileName;
                $destPath = $uploadFileDir . $uniqueFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $qry_banner = "INSERT INTO banner (banner_img, banner_sort) VALUES (?, ?)";
                    $stmt = mysqli_prepare($dbcon, $qry_banner);
                    $bannerSort = $_POST['banner_sort'];
                    mysqli_stmt_bind_param($stmt, "si", $uniqueFileName, $bannerSort);

                    if (mysqli_stmt_execute($stmt)) {
                        echo "บันทึกเเบนเนอร์สำเร็จ";
                    } else {
                        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($dbcon);
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "เกิดข้อผิดพลาดในการย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด";
                }
            } else {
                echo "ขนาดรูปภาพไม่ถูกต้อง! (กรุณาอัปโหลดรูปภาพขนาด 945x445 พิกเซล)";
            }
        } else {
            echo "ประเภทนามสกุลไฟล์ไม่ถูกต้อง! (เฉพาะ JPG, JPEG, PNG เท่านั้น)";
        }
    } else {
        echo "ไม่มีไฟล์ที่อัปโหลดหรือเกิดข้อผิดพลาด";
    }
}
?>
