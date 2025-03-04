<?php
require_once __DIR__ . '/../../Connect.php';

if (!$dbcon) {
    die("เกิดข้อผิดพลาด: ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (!isset($_POST['clinic_id']) || empty($_POST['clinic_id'])) {
        die("ไม่พบข้อมูลคลินิกที่ต้องการอัปเดต");
    }

    $clinic_id = intval($_POST['clinic_id']);

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

    function uploadFile($fileKey, $upload_dir, $existing_file) {
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
            $file_name = time() . '_' . basename($_FILES[$fileKey]['name']);
            $file_path = $upload_dir . $file_name;
    
            if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $file_path)) {
                if (!empty($existing_file) && file_exists($upload_dir . $existing_file)) {
                    unlink($upload_dir . $existing_file); 
                }
                return $file_name; 
            }
        }
        return $existing_file; 
    }
    

    $stmt = $dbcon->prepare("SELECT * FROM clinic WHERE clinic_id = ?");
    $stmt->bind_param("i", $clinic_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $clinic = $result->fetch_assoc();
    $stmt->close();

    $image_1 = isset($_POST['delete_image_1']) && $_POST['delete_image_1'] == "1" ? NULL : uploadFile('image_1', $upload_dir, $clinic['image_1']);
    $image_content_1 = isset($_POST['delete_image_1']) && $_POST['delete_image_1'] == "1" ? NULL : $_POST['image_content_1'] ?? '';

    $image_2 = isset($_POST['delete_image_2']) && $_POST['delete_image_2'] == "1" ? NULL : uploadFile('image_2', $upload_dir, $clinic['image_2']);
    $image_content_2 = isset($_POST['delete_image_2']) && $_POST['delete_image_2'] == "1" ? NULL : $_POST['image_content_2'] ?? '';

    $image_3 = isset($_POST['delete_image_3']) && $_POST['delete_image_3'] == "1" ? NULL : uploadFile('image_3', $upload_dir, $clinic['image_3']);
    $image_content_3 = isset($_POST['delete_image_3']) && $_POST['delete_image_3'] == "1" ? NULL : $_POST['image_content_3'] ?? '';

    $head_img = uploadFile('head_img', $upload_dir, $clinic['head_img']);
    $location_img = uploadFile('location_img', $upload_dir, $clinic['location_img']);

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

    // ทำการอัปเดตข้อมูล
    $stmt = $dbcon->prepare("UPDATE clinic SET
            clinic_name = ?, head_img = ?, location_clinic = ?, opening_days = ?,
            section_1 = ?, subhead_1 = ?, section_2 = ?, subhead_2 = ?, section_3 = ?, subhead_3 = ?, 
            section_4 = ?, subhead_4 = ?, section_5 = ?, subhead_5 = ?, 
            trast_1 = ?, subtrast_1 = ?, image_1 = ?, image_content_1 = ?, 
            image_2 = ?, image_content_2 = ?, image_3 = ?, image_content_3 = ?, location_img = ?
        WHERE clinic_id = ?");

    if (!$stmt) {
        die("เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $dbcon->error);
    }

    $stmt->bind_param(
        'sssssssssssssssssssssssi',
        $clinic_name, $head_img, $location_clinic, $opening_days,
        $section_1, $subhead_1, $section_2, $subhead_2, $section_3, $subhead_3,
        $section_4, $subhead_4, $section_5, $subhead_5,
        $trast_1, $subtrast_1, $image_1, $image_content_1,
        $image_2, $image_content_2, $image_3, $image_content_3, $location_img,
        $clinic_id
    );

    if ($stmt->execute()) {
        echo "อัปเดตข้อมูลคลินิกสำเร็จ";
    } else {
        die("เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . $stmt->error);
    }

    $stmt->close();
    $dbcon->close();
} else {
    die("คำขอไม่ถูกต้อง");
}
?>
