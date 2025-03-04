<?php 
require '../../Connect.php';

$response = ["status" => "error", "message" => ""]; 

if (isset($_POST['banner_id'])) {
    $banner_id = $_POST['banner_id'];
    $qry_get_filename = "SELECT banner_img FROM banner WHERE banner_id = ?";
    if ($stmt = mysqli_prepare($dbcon, $qry_get_filename)) {
        mysqli_stmt_bind_param($stmt, "i", $banner_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $file_name);

        if (mysqli_stmt_fetch($stmt)) {
            mysqli_stmt_close($stmt);
            $image_path = __DIR__ . '/../../Img/ImgBanner/' . $file_name;
            if ($file_name && file_exists($image_path)) {
                if (unlink($image_path)) {
                    $response["message"] = "Image file deleted successfully.";
                } else {
                    $response["message"] = "Failed to delete image file.";
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response["message"] = "Image file not found.";
                echo json_encode($response);
                exit;
            }
            $qry_delete_banner = "DELETE FROM banner WHERE banner_id = ?";
            if ($stmt = mysqli_prepare($dbcon, $qry_delete_banner)) {
                mysqli_stmt_bind_param($stmt, "i", $banner_id);
                if (mysqli_stmt_execute($stmt)) {
                    $response["status"] = "success";
                    $response["message"] = "ลบข้อมูลเเบนเนอร์สำเร็จ";
                } else {
                    $response["message"] = "Error deleting banner: " . mysqli_error($dbcon);
                }
                mysqli_stmt_close($stmt);
            } else {
                $response["message"] = "Error preparing the query to delete banner: " . mysqli_error($dbcon);
            }
        } else {
            mysqli_stmt_close($stmt);
            $response["message"] = "No banner found with the given ID.";
        }
    } else {
        $response["message"] = "Error preparing the query to fetch filename: " . mysqli_error($dbcon);
    }
} else {
    $response["message"] = "No banner ID provided.";
}

mysqli_close($dbcon);

echo json_encode($response);
?>
