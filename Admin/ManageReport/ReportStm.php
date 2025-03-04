<?php
require '../../Connect.php';
$date_current = date('Y-m-d');
$qry_report_stm_other = "SELECT * FROM reserve WHERE reserve_stm_other !='' AND reserve_status ='อนุมัติแล้ว' AND reserve_date <'$date_current'";
$result_report_stm_other = mysqli_query($dbcon,$qry_report_stm_other);
$row_report_stm_other = mysqli_num_rows($result_report_stm_other);
if ($row_report_stm_other > 0) {
  $cnt_row_stmother = $row_report_stm_other;
}else {
  $cnt_row_stmother = 0;
}

$stm_array = array();
$stm_arrays = '' ;
$qry_report_stm = "SELECT * FROM reserve WHERE reserve_status ='อนุมัติแล้ว' AND reserve_date <'$date_current'";
$result_report_stm = mysqli_query($dbcon,$qry_report_stm);
$row_report_stm = mysqli_num_rows($result_report_stm);
if ($row_report_stm > 0) {
  while ($row_stm = mysqli_fetch_array($result_report_stm,MYSQLI_ASSOC)) {
    $stm_array[] = $row_stm['reserve_stm'];
  }
     $stm_arrays = implode(',',$stm_array);
     // $stm_arraysAll = explode(',',$stm_arrays);
     $stmcnt1 = substr_count($stm_arrays,'ปวดคอ บ่า ไหล่');
     $stmcnt2 = substr_count($stm_arrays,'ปวดหลัง');
     $stmcnt3 = substr_count($stm_arrays,'ปวดแขน');
     $stmcnt4 = substr_count($stm_arrays,'ปวดสะโพก');
     $stmcnt5 = substr_count($stm_arrays,'ไหล่ติด');
     $stmcnt6 = substr_count($stm_arrays,'ปวดขา');
     $stmcnt7 = substr_count($stm_arrays,'ปวดเข่า');
     $stmcnt8 = substr_count($stm_arrays,'ปวดเท้า/รองช้ำ');
     $stmcnt9 = substr_count($stm_arrays,'อัมพฤกษ์ อัมพาต');
     $stmcnt10 = $cnt_row_stmother;
}else {
    $stmcnt1 = 0;
    $stmcnt2 = 0;
    $stmcnt3 = 0;
    $stmcnt4 = 0;
    $stmcnt5 = 0;
    $stmcnt6 = 0;
    $stmcnt7 = 0;
    $stmcnt8 = 0;
    $stmcnt9 = 0;
    $stmcnt10 = 0;
}
echo $stmcnt1.'|'.$stmcnt2.'|'.$stmcnt3.'|'.$stmcnt4.'|'.$stmcnt5.'|'.
$stmcnt6.'|'.$stmcnt7.'|'.$stmcnt8.'|'.$stmcnt9.'|'.$stmcnt10;
?>
