<?php
require '../../Connect.php';
$dateoff_id = $_POST['dateoff_id'];

$qry_delete_dateoff="DELETE FROM dateoff WHERE dateoff_id = '$dateoff_id'";
$result_delete_dateoff = mysqli_query($dbcon,$qry_delete_dateoff);
if ($result_delete_dateoff) {
echo 1;
}else {
  echo 2;
}

 ?>
