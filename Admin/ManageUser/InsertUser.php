<?php
require '../../Connect.php';
$usersex = $_POST['usersex'];
$userage = $_POST['userage'];
$useraddress = $_POST['useraddress'];
$prefixname = $_POST['prefixname'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$card_id = $_POST['card_id'];
$tel = $_POST['tel'];
$typeuser = $_POST['typeuser'];
$user_cd = $_POST['user_cd'];
$user_da = $_POST['user_da'];
$vaccine = $_POST['vaccine'];



  $qry_check_acounts = "SELECT * FROM user
  WHERE user_card_id ='$card_id'";
  $result_check_acounts = mysqli_query($dbcon,$qry_check_acounts);
  $row_check_acounts = mysqli_num_rows($result_check_acounts);
  if ($row_check_acounts > 0) {
    echo 0 ;
  }else {
    $qry_insert_acounts = "INSERT INTO user
    (user_name_prefix,user_fname,user_lname,user_sex,user_age,user_card_id,user_tel,user_address,user_type,user_congenital_disease,user_drug_allergy,user_vaccine_covid_19)
    VALUES ('$prefixname','$fname','$lname','$usersex','$userage','$card_id','$tel','$useraddress','$typeuser','$user_cd','$user_da','$vaccine')";
    $result_insert_acounts = mysqli_query($dbcon,$qry_insert_acounts);
    if ($result_insert_acounts){
      echo 1;
    }
  }
?>
