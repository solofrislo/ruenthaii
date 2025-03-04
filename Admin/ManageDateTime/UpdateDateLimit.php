<?php
require '../../Connect.php';

if (isset($_POST['inputdatelimit'])) {
  $inputdatelimit = $_POST['inputdatelimit'];
  $qry_upd_datelimit = "UPDATE dateroundlimit
  SET datelimit ='$inputdatelimit'";
  $result_upd_datelimit = mysqli_query($dbcon,$qry_upd_datelimit);
  if ($result_upd_datelimit ) {
    echo 1;
  }else {
    echo 0;
  }
}elseif (isset($_POST['inputroundlimit'])) {
  $inputroundlimit = $_POST['inputroundlimit'];
  $qry_upd_datelimit = "UPDATE dateroundlimit
  SET roundlimit ='$inputroundlimit'";
  $result_upd_datelimit = mysqli_query($dbcon,$qry_upd_datelimit);
  if ($result_upd_datelimit ) {
    echo 1;
  }else {
    echo 0;
  }
}
