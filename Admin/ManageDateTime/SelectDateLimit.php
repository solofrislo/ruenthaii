<?php
require '../../Connect.php';

$qry_datalimit = "SELECT * FROM dateroundlimit";
$result_datalimit = mysqli_query($dbcon,$qry_datalimit);
if ($result_datalimit) {
  $row_datalimit = mysqli_fetch_array($result_datalimit,MYSQLI_ASSOC);
  $datelimit = $row_datalimit['datelimit'];
  $roundlimit = $row_datalimit['roundlimit'];
  echo $datelimit.'|'.$roundlimit;
}else {
  $datelimit = '0';
  $roundlimit = '0';
  echo $datelimit.'|'.$roundlimit;
}

?>
