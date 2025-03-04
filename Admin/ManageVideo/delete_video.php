<?php
require '../../Connect.php'; 

header('Content-Type: application/json; charset=UTF-8'); 

if (isset($_POST['video_id'])) {
    $video_id = $_POST['video_id'];

    $qry_select_video = "SELECT video_file, video_image FROM video WHERE video_id = ?";
    if ($stmt = mysqli_prepare($dbcon, $qry_select_video)) {
        mysqli_stmt_bind_param($stmt, "i", $video_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $video_file, $video_image);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if (!empty($video_file)) {
            $videoFilePath = "../../Video/Video_upload/" . $video_file;
            if (file_exists($videoFilePath)) {
                unlink($videoFilePath);
            }
        }

        if (!empty($video_image)) {
            $imageFilePath = "../../Video/Video_image/" . $video_image;
            if (file_exists($imageFilePath)) {
                unlink($imageFilePath);
            }
        }

        $qry_delete_video = "DELETE FROM video WHERE video_id = ?";
        if ($stmt = mysqli_prepare($dbcon, $qry_delete_video)) {
            mysqli_stmt_bind_param($stmt, "i", $video_id);
            
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(["success" => true, "message" => "วิดีโอถูกลบเรียบร้อยแล้ว"]);
                exit();
            } else {
                echo json_encode(["success" => false, "error" => "เกิดข้อผิดพลาดในการลบวิดีโอ: " . mysqli_error($dbcon)]);
                exit();
            }
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(["success" => false, "error" => "เกิดข้อผิดพลาดในการเตรียมคำสั่งลบวิดีโอ: " . mysqli_error($dbcon)]);
            exit();
        }
    } else {
        echo json_encode(["success" => false, "error" => "เกิดข้อผิดพลาดในการค้นหาวิดีโอ: " . mysqli_error($dbcon)]);
        exit();
    }
} else {
    echo json_encode(["success" => false, "error" => "ไม่มี video_id ที่ถูกส่งมา"]);
    exit();
}

mysqli_close($dbcon);
?>
