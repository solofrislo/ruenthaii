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
    $uploadType = isset($_POST['uploadType']) ? $_POST['uploadType'] : null;
    $video_link = isset($_POST['video_link']) ? trim($_POST['video_link']) : null;
    $video_content = isset($_POST['video_content']) ? trim($_POST['video_content']) : null;
    $video_file = null;
    $video_image = null;

    if (empty($video_content)) {
        $response['success'] = false;
        $response['error'] = 'โปรดกรอกคำอธิบายวิดีโอ';
        echo json_encode($response);
        exit();
    }

    function convertToEmbedLink($url) {
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        return null;
    }

    if ($uploadType === 'url') {
        if (empty($video_link)) {
            $response['success'] = false;
            $response['error'] = 'โปรดใส่ลิงก์วิดีโอ';
            echo json_encode($response);
            exit();
        }

        $video_link = convertToEmbedLink($video_link);
        if ($video_link === null) {
            $response['success'] = false;
            $response['error'] = 'ลิงก์วิดีโอไม่ถูกต้อง โปรดใช้ YouTube เท่านั้น';
            echo json_encode($response);
            exit();
        }

        $video_file = ''; 
    }

    if ($uploadType === 'file' && !empty($_FILES['video_file']['name'])) {
        $fileTmpPath = $_FILES['video_file']['tmp_name'];
        $fileSize = $_FILES['video_file']['size'];
        $fileName = basename($_FILES['video_file']['name']);
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExt = ['mp4', 'avi', 'mov', 'wmv'];

        if ($fileSize > 150 * 1024 * 1024) { 
            $response['success'] = false;
            $response['error'] = 'ขนาดไฟล์วิดีโอเกิน 150MB';
            echo json_encode($response);
            exit();
        }

        if (in_array($fileExt, $allowedExt)) {
            $video_file = uniqid() . '.' . $fileExt;
            move_uploaded_file($fileTmpPath, $uploadDir . $video_file);
        } else {
            $response['success'] = false;
            $response['error'] = 'รูปแบบไฟล์วิดีโอไม่รองรับ';
            echo json_encode($response);
            exit();
        }

        $video_link = ''; 
    }

    if (!empty($_FILES['video_image']['name'])) {
        $imageTmpPath = $_FILES['video_image']['tmp_name'];
        $imageExt = strtolower(pathinfo($_FILES['video_image']['name'], PATHINFO_EXTENSION));
        $allowedImageExt = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageExt, $allowedImageExt)) {
            $video_image = uniqid() . '.' . $imageExt;
            move_uploaded_file($imageTmpPath, $imageDir . $video_image);
        }
    }

    $video_content = stripslashes(htmlspecialchars_decode($video_content, ENT_QUOTES));

    $stmt = mysqli_prepare($dbcon, "INSERT INTO video (video_link, video_file, video_content, video_image, video_date, video_time, video_upload) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'sssssss', $video_link, $video_file, $video_content, $video_image, $datenow, $timenow, $video_upload);

    if (mysqli_stmt_execute($stmt)) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = 'ไม่สามารถบันทึกข้อมูลได้: ' . mysqli_error($dbcon);
        error_log(mysqli_error($dbcon));
    }

    mysqli_stmt_close($stmt);
}

echo json_encode($response);
?>
