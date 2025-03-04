<?php
require '../../Connect.php';
$dateclick = $_POST['timecancle'];
$time_array = array();
$time_cancles='';
$normal_day = $_POST['normal_day'];

if ($normal_day==1) {
  $qry_timecancle = "SELECT * FROM reserve WHERE reserve_date = '$dateclick'
  AND (reserve_status='รอการอนุมัติ' OR reserve_status='อนุมัติแล้ว')";
  $result_timecancle = mysqli_query($dbcon,$qry_timecancle);
  $row_timecancle = mysqli_num_rows($result_timecancle);
  if ($row_timecancle > 0) {
    while ($row_times = mysqli_fetch_array($result_timecancle,MYSQLI_ASSOC)) {
      $time_array[] = $row_times['reserve_time'];
    }
      $time_cancles = implode(',',$time_array);
      $time_cancle1 = substr_count($time_cancles,'08:30');
      $time_cancle2 = substr_count($time_cancles,'10:30');
      $time_cancle3 = substr_count($time_cancles,'13:00');
      $time_cancle4 = substr_count($time_cancles,'14:00');
      $time_cancle5 = substr_count($time_cancles,'16:00');
      $time_cancle6 = substr_count($time_cancles,'18:00');
  }else {
      $time_cancle1 = 0;
      $time_cancle2 = 0;
      $time_cancle3 = 0;
      $time_cancle4 = 0;
      $time_cancle5 = 0;
      $time_cancle6 = 0;
  }
  echo $time_cancle1.'|'.$time_cancle2.'|'.$time_cancle3.'|'.$time_cancle4.'|'.$time_cancle5.'|'.$time_cancle6;

}elseif ($normal_day==0) {
  $qry_timecancle = "SELECT * FROM reserve WHERE reserve_date = '$dateclick'
  AND (reserve_status='รอการอนุมัติ' OR reserve_status='อนุมัติแล้ว')";
  $result_timecancle = mysqli_query($dbcon,$qry_timecancle);
  $row_timecancle = mysqli_num_rows($result_timecancle);
  if ($row_timecancle > 0) {
    while ($row_times = mysqli_fetch_array($result_timecancle,MYSQLI_ASSOC)) {
      $time_array[] = $row_times['reserve_time'];
    }
      $time_cancles = implode(',',$time_array);
      $time_cancle1 = substr_count($time_cancles,'08:00');
      $time_cancle2 = substr_count($time_cancles,'10:00');
  }else {
      $time_cancle1 = 0;
      $time_cancle2 = 0;

  }
  echo $time_cancle1.'|'.$time_cancle2;

}






 ?>
