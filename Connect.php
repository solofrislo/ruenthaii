<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db = "napaphat_thaimassage";

  $dbcon = mysqli_connect($servername, $username, $password, $db);

  if (!$dbcon) {
      die("Connect failed: " . mysqli_connect_error());
  }

  mysqli_set_charset($dbcon, "utf8");
?>
