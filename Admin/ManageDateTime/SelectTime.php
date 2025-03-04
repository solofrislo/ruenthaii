<?php
require '../../Connect.php';
$dateclick = $_POST['dateclick'];
$qry_check_time = "SELECT * FROM times WHERE times_date = '$dateclick'";
$result_check_time = mysqli_query($dbcon,$qry_check_time);
$row_cnt_time = mysqli_num_rows($result_check_time);
if ($row_cnt_time >= 1) {
  $row_times = mysqli_fetch_array($result_check_time,MYSQLI_ASSOC);
  echo $time = $row_times['times_timesoff'];
}else {
  echo 0;
}

 ?>
