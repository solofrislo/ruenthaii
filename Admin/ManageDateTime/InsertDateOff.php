<?php
require '../../Connect.php';
$dateoff = $_POST['dateoff'];
$comment = $_POST['comment'];

$qry_insert_dateoff="INSERT INTO 	dateoff	(dateoff_date,dateoff_comment)
  VALUES('".$dateoff."','".$comment."')";
$result_insert_dateoff = mysqli_query($dbcon,$qry_insert_dateoff);
if ($result_insert_dateoff) {
echo 1;
}else {
  echo 2;
}
 ?>
