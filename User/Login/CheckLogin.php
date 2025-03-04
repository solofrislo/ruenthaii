<?php
require '../../Connect.php';
  $login_card_id = $_POST['login_card_id'];
  $login_tel = $_POST['login_tel'];

  $qry_checklogin = "SELECT * FROM user WHERE user_card_id = '$login_card_id' AND user_tel = '$login_tel'";
  $result_checklogin = mysqli_query($dbcon,$qry_checklogin);
  $row_checklogin = mysqli_num_rows($result_checklogin);
  if ($row_checklogin > 0) {
    session_start();
    $row_user = mysqli_fetch_array($result_checklogin,MYSQLI_ASSOC);
    $_SESSION["user_allow"]= $row_user['user_allow'];

    if ($_SESSION["user_allow"]=='ไม่อนุญาต') {
      echo 3;
    }else {
      $_SESSION["user_id"] = $row_user['user_id'];
      $_SESSION["user_name_prefix"] = $row_user['user_name_prefix'];
      $_SESSION["user_fname"] = $row_user['user_fname'];
      $_SESSION["user_lname"] = $row_user['user_lname'];
      $_SESSION["user_type"] = $row_user['user_type'];
      $_SESSION["user_sex"] = $row_user['user_sex'];
      $_SESSION["user_age"] = $row_user['user_age'];
      $_SESSION["user_tel"] = $row_user['user_tel'];
      $_SESSION["user_address"] = $row_user['user_address'];
      $_SESSION["user_card_id"] = $row_user['user_card_id'];
      $_SESSION["user_congenital_disease"] = $row_user['user_congenital_disease'];
      $_SESSION["user_drug_allergy"] = $row_user['user_drug_allergy'];
      $_SESSION["fullname"] = $_SESSION["user_name_prefix"].''.$_SESSION["user_fname"].' '.$_SESSION["user_lname"];
      if ($_SESSION["user_type"]=='ผู้ดูแลระบบ') {
        echo 2;
      }elseif ($_SESSION["user_type"]=='ผู้ใช้งานทั่วไป'){
        echo 1;
      }
    }
  }else {
    echo 0;
  }

?>
