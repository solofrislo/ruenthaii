<?php
require '../../Connect.php';
  $userid = $_POST['userid'];
  $usersex = $_POST['usersex'];
  $userage = $_POST['userage'];
  $useraddress = $_POST['useraddress'];
  $prefixname = $_POST['prefixname'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $card_id = $_POST['card_id'];
  $tel = $_POST['tel'];
  $typeuser = $_POST['typeuser'];
  $allow = $_POST['allow'];
  $user_cd = $_POST['user_cd'];
  $user_da = $_POST['user_da'];
  $user_vaccine = $_POST['user_vaccine'];

  $qry_edit_acounts = "UPDATE user SET
  user_name_prefix ='$prefixname',
  user_fname='$fname',
  user_lname='$lname',
  user_sex='$usersex',
  user_age='$userage',
  user_card_id='$card_id',
  user_tel='$tel',
  user_address='$useraddress',
  user_type='$typeuser',
  user_allow='$allow',
  user_congenital_disease='$user_cd',
  user_drug_allergy='$user_da',
  user_vaccine_covid_19='$user_vaccine'
  WHERE user_id = $userid";
  $result_edit_acounts = mysqli_query($dbcon,$qry_edit_acounts);
  if ($result_edit_acounts){
    echo 1;
  }else {
    echo 0;
  }



?>
