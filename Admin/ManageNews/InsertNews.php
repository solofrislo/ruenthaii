<?php
require '../../Connect.php';
$contentnews = $_POST['contentnews'];
$datenow = date("Y-m-d");
$timenow = date("H:i");
if(isset($_FILES["insertfileUpload"])){
  foreach($_FILES['insertfileUpload']['name'] as $key=>$val){
    $upload_dir = "../../Img/ImgNews/";
    $date = date("YmdHis");
    $file_name = $date.$_FILES['insertfileUpload']['name'][$key];
    $file_nameip[] = $date.$_FILES['insertfileUpload']['name'][$key];
    $upload_image = $upload_dir.$file_name;
    if(move_uploaded_file($_FILES['insertfileUpload']['tmp_name'][$key],$upload_image)){
      $images = $upload_image;
    }
  }

  $news_img = implode(",", $file_nameip);
  $insert_imgnews = "INSERT INTO 	news	(news_date,news_time,news_content,news_img)
    VALUES('$datenow','$timenow','$contentnews','$news_img')";
  $result_imgnews = mysqli_query($dbcon,$insert_imgnews);
  if ($result_imgnews) {
    echo '
    <script>
      localStorage.setItem("getinsertnews",1);
      window.location.href ="../../Admin.php?action=ManageNews";
    </script>
    ';
  }else {
  }
}



 ?>
