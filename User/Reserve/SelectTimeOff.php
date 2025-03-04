<?php
require '../../Connect.php';

$dateclick =$_POST['dateclick'];

$qry_timeoff = "SELECT * FROM times WHERE times_date = '$dateclick'";
$result_timeoff= mysqli_query($dbcon,$qry_timeoff);
$row_timeoff = mysqli_num_rows($result_timeoff);
if ($row_timeoff > 0) {
  $row_times = mysqli_fetch_array($result_timeoff,MYSQLI_ASSOC);
  echo $time = $row_times['times_timesoff'];
}else {
  echo 0;
}
 ?>
