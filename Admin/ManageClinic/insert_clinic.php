<?php
require_once __DIR__ . '/../../Connect.php';

if (!$dbcon) {
    die("เกิดข้อผิดพลาด: ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $clinic_name = $_POST['clinic_name'] ?? '';
    $location_clinic = $_POST['location_clinic'] ?? '';
    $opening_days = $_POST['opening_days'] ?? '';

    if (empty($clinic_name) || empty($location_clinic) || empty($opening_days)) {
        die("กรุณากรอกข้อมูลให้ครบถ้วน");
    }

    $upload_dir = __DIR__ . '/../../Img/ImgClinic/';
    if (!is_dir($upload_dir) && !mkdir($upload_dir, 0777, true)) {
        die("ไม่สามารถสร้างโฟลเดอร์สำหรับอัปโหลดไฟล์ได้");
    }

    function uploadFile($fileKey, $upload_dir) {
        if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
            return ''; 
        }

        $file_name = time() . '_' . basename($_FILES[$fileKey]['name']);
        $file_path = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $file_path)) {
            return $file_name; 
        }

        return '';
    }

    $head_img = uploadFile('head_img', $upload_dir) ?? '';
    $image_1 = uploadFile('image_1', $upload_dir) ?? '';
    $image_2 = uploadFile('image_2', $upload_dir) ?? '';
    $image_3 = uploadFile('image_3', $upload_dir) ?? '';
    $location_img = uploadFile('location_img', $upload_dir) ?? '';

    $section_1 = $_POST['section_1'] ?? '';
    $subhead_1 = $_POST['subhead_1'] ?? '';
    $section_2 = $_POST['section_2'] ?? '';
    $subhead_2 = $_POST['subhead_2'] ?? '';
    $section_3 = $_POST['section_3'] ?? '';
    $subhead_3 = $_POST['subhead_3'] ?? '';
    $section_4 = $_POST['section_4'] ?? '';
    $subhead_4 = $_POST['subhead_4'] ?? '';
    $section_5 = $_POST['section_5'] ?? '';
    $subhead_5 = $_POST['subhead_5'] ?? '';
    $trast_1 = $_POST['Trast_1'] ?? '';
    $subtrast_1 = $_POST['subtrast_1'] ?? '';
    $image_content_1 = $_POST['image_content_1'] ?? '';
    $image_content_2 = $_POST['image_content_2'] ?? '';
    $image_content_3 = $_POST['image_content_3'] ?? '';

    $stmt = $dbcon->prepare("INSERT INTO clinic (
            clinic_name, head_img, location_clinic, opening_days, 
            section_1, subhead_1, section_2, subhead_2, section_3, subhead_3, 
            section_4, subhead_4, section_5, subhead_5, 
            trast_1, subtrast_1, image_1, image_content_1, 
            image_2, image_content_2, image_3, image_content_3, location_img
        ) VALUES (
            ?, ?, ?, ?, 
            ?, ?, ?, ?, ?, ?, 
            ?, ?, ?, ?, 
            ?, ?, ?, ?, 
            ?, ?, ?, ?, ?
        )");

    if (!$stmt) {
        die("เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $dbcon->error);
    }

    $stmt->bind_param(
        'sssssssssssssssssssssss',
        $clinic_name, $head_img, $location_clinic, $opening_days,
        $section_1, $subhead_1, $section_2, $subhead_2, $section_3, $subhead_3,
        $section_4, $subhead_4, $section_5, $subhead_5,
        $trast_1, $subtrast_1, $image_1, $image_content_1,
        $image_2, $image_content_2, $image_3, $image_content_3, $location_img
    );

    if ($stmt->execute()) {
        echo "เพิ่มข้อมูลคลินิกสำเร็จ";
    } else {
        die("เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . $stmt->error);
    }

    $stmt->close();
    $dbcon->close();
} else {
    die("คำขอไม่ถูกต้อง");
}
?>

