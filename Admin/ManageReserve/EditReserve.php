<?php
require '../../Connect.php';
$reserve_status = $_POST['reserve_status'];
$reserve_id = $_POST['reserve_id'];
$reserve_date = $_POST['reserve_date'];
$reserve_time = $_POST['reserve_time'];

$qry_edit_reserve = "UPDATE reserve SET
reserve_status ='$reserve_status',
reserve_date ='$reserve_date',
reserve_time ='$reserve_time'
WHERE reserve_id = '$reserve_id'";
$result_edit_reserve = mysqli_query($dbcon,$qry_edit_reserve);
if ($result_edit_reserve){
  echo 1;
}else {
  echo 0;
}

 ?>
