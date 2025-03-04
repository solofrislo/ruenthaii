<?php
require '../../Connect.php';
  $eddbus_userid = $_POST['eddbus_userid'];
  $eddbus_prefixname = $_POST['eddbus_prefixname'];
  $eddbus_fname = $_POST['eddbus_fname'];
  $eddbus_lname = $_POST['eddbus_lname'];
  $eddbus_userage = $_POST['eddbus_userage'];
  $eddbus_usersex = $_POST['eddbus_usersex'];
  $eddbuscv_19 =$_POST['eddbuscv_19'];
  $eddbus_card_id = $_POST['eddbus_card_id'];
  $eddbus_tel = $_POST['eddbus_tel'];
  $eddbus_useraddress = $_POST['eddbus_useraddress'];
  $eddbus_cd = $_POST['eddbus_cd'];
  $eddbus_da = $_POST['eddbus_da'];

  $qry_update_acounts = "UPDATE user SET
  user_name_prefix ='$eddbus_prefixname',user_fname='$eddbus_fname',
  user_lname='$eddbus_lname',
  user_sex='$eddbus_usersex',
  user_age='$eddbus_userage',
  user_card_id='$eddbus_card_id',
  user_tel='$eddbus_tel',
  user_address='$eddbus_useraddress',
  user_congenital_disease='$eddbus_cd',
  user_vaccine_covid_19='$eddbuscv_19',
  user_drug_allergy='$eddbus_da'
  WHERE user_id = $eddbus_userid";
  $result_update_acounts = mysqli_query($dbcon,$qry_update_acounts);
  if ($result_update_acounts){
    echo 1;
  }else {
    echo 0;
  }



?>
