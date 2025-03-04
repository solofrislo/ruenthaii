<?php
require '../../Connect.php';

$response = array();
$uploadDir = '../../Video/Video_upload/';
$imageDir = '../../Video/Video_image/';

$datenow = date("Y-m-d");
$timenow = date("H:i");
$video_upload = 'Admin';

if (!$dbcon) {
    $response['success'] = false;
    $response['error'] = 'ไม่สามารถเชื่อมต่อฐานข้อมูลได้';
    echo json_encode($response);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $video_id = $_POST['video_id'];
    $video_link = isset($_POST['video_link']) ? trim($_POST['video_link']) : null;
    $video_content = isset($_POST['video_content']) ? trim($_POST['video_content']) : null;
    $remove_image = isset($_POST['remove_image']) ? $_POST['remove_image'] : null;

    if (!empty($video_id) && !empty($video_content)) {
        $video_id = mysqli_real_escape_string($dbcon, $video_id);
        $video_content = stripslashes(htmlspecialchars_decode(mysqli_real_escape_string($dbcon, $video_content), ENT_QUOTES));

        // ✅ ดึงข้อมูลรูปภาพเก่า
        $qry_select = "SELECT video_image FROM video WHERE video_id = ?";
        $stmt = mysqli_prepare($dbcon, $qry_select);
        mysqli_stmt_bind_param($stmt, 'i', $video_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $old_video_image);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        function convertToEmbedLink($url) {
            if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
                return 'https://www.youtube.com/embed/' . $matches[1];
            }
            if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
                return 'https://www.youtube.com/embed/' . $matches[1];
            }
            return $url;
        }

        if (!empty($video_link)) {
            $video_link = convertToEmbedLink($video_link);
            $video_link = mysqli_real_escape_string($dbcon, $video_link);

            $qry_update = "UPDATE video SET video_link = ?, video_content = ?, video_file = NULL, video_date = ?, video_time = ?, video_upload = ? WHERE video_id = ?";
            $stmt = mysqli_prepare($dbcon, $qry_update);
            mysqli_stmt_bind_param($stmt, 'sssssi', $video_link, $video_content, $datenow, $timenow, $video_upload, $video_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } 

        // ✅ อัปโหลดไฟล์วิดีโอใหม่
        if (!empty($_FILES['video_file']['name'])) {
            $fileTmpPath = $_FILES['video_file']['tmp_name'];
            $fileSize = $_FILES['video_file']['size'];
            $fileExt = strtolower(pathinfo($_FILES['video_file']['name'], PATHINFO_EXTENSION));
            $allowedExt = ['mp4', 'avi', 'mov', 'wmv'];

            if ($fileSize > 150 * 1024 * 1024) {
                $response['success'] = false;
                $response['error'] = 'ขนาดไฟล์วิดีโอเกิน 150MB';
                echo json_encode($response);
                exit();
            }

            if (in_array($fileExt, $allowedExt)) {
                $newFileName = uniqid() . '.' . $fileExt;
                move_uploaded_file($fileTmpPath, $uploadDir . $newFileName);

                $qry_update = "UPDATE video SET video_file = ?, video_content = ?, video_link = NULL, video_date = ?, video_time = ?, video_upload = ? WHERE video_id = ?";
                $stmt = mysqli_prepare($dbcon, $qry_update);
                mysqli_stmt_bind_param($stmt, 'sssssi', $newFileName, $video_content, $datenow, $timenow, $video_upload, $video_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }

        // ✅ อัปโหลดรูปปกวิดีโอใหม่
        if (!empty($_FILES['video_image']['name'])) {
            $imageTmpPath = $_FILES['video_image']['tmp_name'];
            $imageExt = strtolower(pathinfo($_FILES['video_image']['name'], PATHINFO_EXTENSION));
            $allowedImageExt = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($imageExt, $allowedImageExt)) {
                if (!empty($old_video_image) && file_exists($imageDir . $old_video_image)) {
                    unlink($imageDir . $old_video_image);
                }

                $newImageName = uniqid() . '.' . $imageExt;
                move_uploaded_file($imageTmpPath, $imageDir . $newImageName);

                $qry_update = "UPDATE video SET video_image = ?, video_date = ?, video_time = ?, video_upload = ? WHERE video_id = ?";
                $stmt = mysqli_prepare($dbcon, $qry_update);
                mysqli_stmt_bind_param($stmt, 'ssssi', $newImageName, $datenow, $timenow, $video_upload, $video_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }

        // ✅ ลบรูปปกถ้าผู้ใช้เลือกที่จะลบ
        if (!empty($remove_image) && $remove_image === "1") {
            if (!empty($old_video_image) && file_exists($imageDir . $old_video_image)) {
                unlink($imageDir . $old_video_image);
            }
            $qry_update = "UPDATE video SET video_image = NULL, video_date = ?, video_time = ?, video_upload = ? WHERE video_id = ?";
            $stmt = mysqli_prepare($dbcon, $qry_update);
            mysqli_stmt_bind_param($stmt, 'sssi', $datenow, $timenow, $video_upload, $video_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = 'ข้อมูลไม่ครบถ้วน';
    }
}

echo json_encode($response);
?>
