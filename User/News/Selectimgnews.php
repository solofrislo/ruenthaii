<?php
require '../../Connect.php';
$newsid = $_POST['newsid'];

$qry_img_news ="SELECT news_img FROM news WHERE news_id = '$newsid' ";
$result_img_news = mysqli_query($dbcon,$qry_img_news);
$row_img_news = mysqli_num_rows($result_img_news);
if ($row_img_news > 0) {
  while ($row_imgnews = mysqli_fetch_array($result_img_news,MYSQLI_ASSOC)) {
    echo $news_img_array = $row_imgnews['news_img'];

  }
}

?>
