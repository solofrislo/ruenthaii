<?php
require '../../Connect.php';
$date_current = date('Y-m-d');
$age = array();
$age_arrays = '' ;
$qry_report_age = "SELECT * FROM reserve WHERE reserve_status ='อนุมัติแล้ว' AND reserve_date <'$date_current'";
$result_report_age = mysqli_query($dbcon,$qry_report_age);
$row_report_age = mysqli_num_rows($result_report_age);
if ($row_report_age > 0) {
  while ($row_age = mysqli_fetch_array($result_report_age,MYSQLI_ASSOC)) {
    $age[] = $row_age['reserve_age'];
  }
  $count1 = $count2 = $count3 = $count4 = $count5 = 0;
  for ($i = 0; $i < sizeof($age); $i++) {
      if($age[$i] < 20) {
          $count1++;
      }
      if($age[$i] >= 20 && $age[$i] <= 30 ) {
          $count2++;
      }
      if($age[$i] >= 31 && $age[$i] <= 40 ) {
          $count3++;
      }
      if($age[$i] >= 41 && $age[$i] <= 50 ) {
          $count4++;
      }
      if($age[$i] > 50) {
          $count5++;
      }
  }

}else {
  $count1 = $count2 = $count3 = $count4 = $count5 = 0;
}
echo $count1.'|'.$count2.'|'.$count3.'|'.$count4.'|'.$count5;

?>
