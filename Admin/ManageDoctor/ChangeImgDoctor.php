<?php
require '../../Connect.php';

$id=$_POST['iddtr'];
$qry_doctor ="SELECT doctor_img FROM doctor WHERE doctor_id = '$id' ";
$result_doctor = mysqli_query($dbcon,$qry_doctor);
$row_doctor = mysqli_num_rows($result_doctor);
if ($row_doctor > 0) {
  while ($row_img_doctor = mysqli_fetch_array($result_doctor,MYSQLI_ASSOC)) {
    $doctor_name_img = $row_img_doctor['doctor_img'];
    if ($doctor_name_img!='') {
      $path ='../../Img/ImgDoctor/'.$doctor_name_img;
        if(file_exists($path)){
          unlink($path);
        }
    }
  }
}
  if(isset($_FILES["files"])){
    $upload_dir = "../../Img/ImgDoctor/";
    $date = date("YmdHis");
    $file_name = $date.$_FILES['files']['name'];
    $upload_image = $upload_dir.$file_name;
    if(move_uploaded_file($_FILES['files']['tmp_name'],$upload_image)){
      $updatedoctor = "UPDATE doctor
      SET doctor_img = '$file_name'
      WHERE doctor_id  = $id";
      $result_updatedoctor = mysqli_query($dbcon, $updatedoctor);
      if ($result_updatedoctor) {
        echo 1;
      }
    }
  }


 ?>
