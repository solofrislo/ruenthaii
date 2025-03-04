 <?php
 require '../../Connect.php';

 $idnews = $_POST['idnews'];

 $news_content = $_POST['news_content'];

 $news_allow =$_POST['news_allow'];

 $totalimg='';

 $array_imgnews=array();

 if (isset($_POST['datapacknameimg'])) {
     $totalimg =$_POST['datapacknameimg'];
 }


 $addnews_img='';
 $file_nameip=array();
 if(isset($_FILES["addimage"])){
   foreach($_FILES['addimage']['name'] as $key=>$val){
     $upload_dir = "../../Img/ImgNews/";
     $date = date("YmdHis");
     $file_name = $date.$_FILES['addimage']['name'][$key];
     $file_nameip[] = $date.$_FILES['addimage']['name'][$key];
     $upload_image = $upload_dir.$file_name;
     move_uploaded_file($_FILES['addimage']['tmp_name'][$key],$upload_image);
   }
     $addnews_img = implode(",", $file_nameip);
 }

 $totalimplodes=array();
 if ($_POST['datapacknameimg'][0] !='' AND isset($_FILES["addimage"])) {
  $totalimplode=array($totalimg,$addnews_img);
  foreach ($totalimplode as $valueimgname) {
    $totalimplodes[] = $valueimgname;
  }
     $totalall = implode(',',$totalimplodes);
 }elseif ($_POST['datapacknameimg'][0] !='' AND !isset($_FILES["addimage"])) {
     $totalall = $totalimg;
 }elseif ($_POST['datapacknameimg'][0] =='' AND isset($_FILES["addimage"])) {
    $totalall = $addnews_img;
 }


// $post_imgname_array = array();
//  if (isset($_POST['imgname_array'])) {
//    $post_imgname_array = $_POST['imgname_array'];
//    foreach ($post_imgname_array as $value) {
//      $path ='../../Img/ImgNews/'.$value;
//        if(file_exists($path)){
//          unlink($path);
//      }
//    }
//  }

$post_imgname_array = array();
if (isset($_POST['imgname_array'])) {
$post_imgname_array = explode(",",$_POST['imgname_array']);
  foreach ($post_imgname_array as $value) {
    if ($value!='') {
      $path ='../../Img/ImgNews/'.$value;
          if(file_exists($path)){
            unlink($path);
        }
    }
  }
}





 $qry_edit_news ="UPDATE news SET news_content ='$news_content',news_img ='$totalall',news_allow ='$news_allow' WHERE news_id ='$idnews'";
 $result_edit_news = mysqli_query($dbcon,$qry_edit_news);
 if ($result_edit_news) {
   echo 1;
 }else {
   echo 2;
 }

  ?>
