<?php
require '../../Connect.php';
  $prefixname = $_POST['prefixname'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $card_id = $_POST['card_id'];
  $tel = $_POST['tel'];

  $qry_check_acounts = "SELECT * FROM user WHERE user_card_id = '$card_id'";
  $result_check_acounts = mysqli_query($dbcon,$qry_check_acounts);
  $row_check_acounts = mysqli_num_rows($result_check_acounts);
  if ($row_check_acounts > 0) {
    echo 0 ;
  }else {
    $qry_insert_acounts = "INSERT INTO user (user_name_prefix,user_fname,user_lname,user_card_id,user_tel)
    VALUES ('$prefixname','$fname','$lname','$card_id','$tel')";
    $result_insert_acounts = mysqli_query($dbcon,$qry_insert_acounts);
    if ($result_insert_acounts){
      $qry_loginauto = "SELECT * FROM user WHERE user_card_id = '$card_id' AND user_tel = '$tel'";
      $result_loginauto = mysqli_query($dbcon,$qry_loginauto);
      $row_loginauto = mysqli_num_rows($result_loginauto);
      if ($row_loginauto > 0) {
        session_start();
        $row_user = mysqli_fetch_array($result_loginauto,MYSQLI_ASSOC);
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
        $_SESSION["user_allow"]= $row_user['user_allow'];
        $_SESSION["fullname"] = $_SESSION["user_name_prefix"].''.$_SESSION["user_fname"].' '.$_SESSION["user_lname"];
      }
      echo 1;
    }
  }


?>
