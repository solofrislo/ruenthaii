<?php
require '../../Connect.php';

if (isset($_POST['timepack'])) {
  $timepack = implode(",",$_POST['timepack']);
}else {
  $timepack = 'no';
}
$primarydate = $_POST['primarydate'];

$qry_check_date = "SELECT * FROM times WHERE times_date = '$primarydate'";
$result_check_date = mysqli_query($dbcon,$qry_check_date);
$row_cnt_date = mysqli_num_rows($result_check_date);
if ($row_cnt_date >= 1) {
  if ($timepack == 'no') {
    $qry_timeoff = "DELETE FROM times WHERE times_date = '$primarydate'";
    $result_timeoff = mysqli_query($dbcon,$qry_timeoff);
    if ($result_timeoff) {
      echo 3;
    }
  }else {
    $update_timeoff = "UPDATE times
    SET times_timesoff = '$timepack'
    WHERE times_date  = '$primarydate'";
    $res_timeoff = mysqli_query($dbcon, $update_timeoff);
    if ($res_timeoff) {
      echo 2;
    }
  }
}else {
  $insert_timeoff = "INSERT INTO 	times	(times_date,times_timesoff)
    VALUES('".$primarydate."','".$timepack."')";
  $result_timeoff = mysqli_query($dbcon,$insert_timeoff);
  if ($result_timeoff) {
    echo 1;
  }
}


 ?>
