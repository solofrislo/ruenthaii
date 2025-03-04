<?php
require '../../connect.php';

$idnews = $_POST['idnews'];
$qry_img_news ="SELECT news_img FROM news WHERE news_id = '$idnews' ";
$result_img_news = mysqli_query($dbcon,$qry_img_news);
$row_img_news = mysqli_num_rows($result_img_news);
if ($row_img_news > 0) {
  while ($row_imgnews = mysqli_fetch_array($result_img_news,MYSQLI_ASSOC)) {
    $news_name_img_all = $row_imgnews['news_img'];
    $news_name_img_array = explode(',' ,$news_name_img_all);
    foreach ($news_name_img_array as $value) {
      $path ='../../Img/ImgNews/'.$value;
      if(file_exists($path)){
        unlink($path);
      }
    }
  }
  $qry_dlt_news ="DELETE FROM news WHERE news_id ='$idnews'";
  $result_dlt_news = mysqli_query($dbcon,$qry_dlt_news);
  if ($result_dlt_news) {
    echo 1;
  }else {
    echo 0;
  }
}else {
  echo 0;
}


 ?>
