<?php
// เชื่อมต่อฐานข้อมูล
require_once __DIR__ . '/../../Connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clinic_id'])) {
    $clinic_id = intval($_POST['clinic_id']); 

    $check_stmt = $dbcon->prepare("SELECT head_img, image_1, image_2, image_3, location_img FROM clinic WHERE clinic_id = ?");
    $check_stmt->bind_param("i", $clinic_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $upload_dir = __DIR__ . '/../../Img/ImgClinic/';
        $images = ['head_img', 'image_1', 'image_2', 'image_3', 'location_img'];

        foreach ($images as $img) {
            if (!empty($row[$img])) {
                $file_path = $upload_dir . basename($row[$img]);
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
        }

        $stmt = $dbcon->prepare("DELETE FROM clinic WHERE clinic_id = ?");
        $stmt->bind_param("i", $clinic_id);

        if ($stmt->execute()) {
            echo "ลบข้อมูลสำเร็จ";
        } else {
            echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "ไม่พบข้อมูลคลินิก";
    }

    $check_stmt->close();
    $dbcon->close();
} else {
    echo "คำขอไม่ถูกต้อง";
}
