<?php

$qry_status = "SELECT * FROM reserve WHERE reserve_status = 'รอการอนุมัติ' ";
$result_status = mysqli_query($dbcon,$qry_status);
$row_result_status = mysqli_num_rows($result_status);
$num_st_re_mg = $row_result_status ;
echo $num_st_re_mg;
 ?>
