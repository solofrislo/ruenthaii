<?php
require '../../Connect.php';
$date_current = date('Y-m-d');
$qry_search_report_all = "SELECT * FROM reserve WHERE reserve_status ='อนุมัติแล้ว' AND reserve_date <'$date_current'";
$result_search_report_all = mysqli_query($dbcon,$qry_search_report_all);
$row_search_report_all = mysqli_num_rows($result_search_report_all);
$cnt_row_search_report_all = $row_search_report_all;

if (!isset($_POST['search'])) {
  $search ='';
}else {
$search = $_POST['search'];
}
$qry_search_report = "SELECT * FROM reserve WHERE $search AND reserve_status ='อนุมัติแล้ว' AND reserve_date <'$date_current'";
$result_search_report = mysqli_query($dbcon,$qry_search_report);
$row_search_report = mysqli_num_rows($result_search_report);
$cnt_row_search_report = $row_search_report;

$cnt_dataall = $cnt_row_search_report_all - $cnt_row_search_report;

echo $cnt_row_search_report.'|'.$cnt_dataall;

 ?>


