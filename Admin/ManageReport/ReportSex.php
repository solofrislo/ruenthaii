<?php
require '../../Connect.php';
$date_current = date('Y-m-d');
$sex_array = array();
$sex_arrays = '' ;
$qry_report_sex = "SELECT * FROM reserve WHERE reserve_status ='อนุมัติแล้ว' AND reserve_date <'$date_current'";
$result_report_sex = mysqli_query($dbcon,$qry_report_sex);
$row_report_sex = mysqli_num_rows($result_report_sex);
if ($row_report_sex > 0) {
  while ($row_sex = mysqli_fetch_array($result_report_sex,MYSQLI_ASSOC)) {
    $sex_array[] = $row_sex['reserve_sex'];
  }
     $sex_arrays = implode('|',$sex_array);
     $sex_count_male = substr_count($sex_arrays,'ชาย');
     $sex_count_female = substr_count($sex_arrays,'หญิง');
}else {
  $sex_count_male = 0;
  $sex_count_female = 0;
}
echo $sex_count_male.'|'.$sex_count_female;
?>
