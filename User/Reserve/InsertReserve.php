<?php
require '../../Connect.php';
  session_start();
  $date_current = date('Y-m-d');
  $re_prefixname = $_POST['re_prefixname'];
  $re_fname = $_POST['re_fname'];
  $re_lname = $_POST['re_lname'];
  $re_card_id = $_POST['re_card_id'];
  $re_tel = $_POST['re_tel'];
  $re_age = $_POST['re_userage'];
  $re_sex = $_POST['re_usersex'];
  $re_vaccine = $_POST['re_vaccine'];
  $re_address = $_POST['re_useraddress'];
  $re_user_cd = $_POST['re_user_cd'];
  $re_user_da = $_POST['re_user_da'];
  $fullname= $re_prefixname.$re_fname.' '.$re_lname;
  $issetspt = 0;

  if (isset($_POST['re_stm'])) {
    $re_stm = $_POST['re_stm'];
    $re_stm = implode(",", $re_stm);
  }else {
    $re_stm = '';
  }

  if (isset($_POST['re_stm_other'])){
      $re_stm_other = $_POST['re_stm_other'];
  }else {
    $re_stm_other = '';
  }

  $re_date = $_POST['re_date'];
  $re_date = date_create($re_date);
  $re_date = date_format($re_date,"Y-m-d");
  $re_time = $_POST['re_time'];
  $re_status = 'รอการอนุมัติ';

  $qry_check_re_card_id = "SELECT * FROM reserve WHERE reserve_card_id = '$re_card_id' AND (reserve_status = 'รอการอนุมัติ' OR reserve_status = 'อนุมัติแล้ว') AND reserve_date > '$date_current'";
  $result_check_re_card_id= mysqli_query($dbcon,$qry_check_re_card_id);
  $row_check_re_card_id = mysqli_num_rows($result_check_re_card_id);
  if ($row_check_re_card_id > 0 ) {
  echo '0|'.$fullname;
  }else {
    $qry_check_card_id = "SELECT * FROM user WHERE user_card_id = '$re_card_id'";
    $result_check_card_id= mysqli_query($dbcon,$qry_check_card_id);
    $row_check_card_id = mysqli_num_rows($result_check_card_id);
    if ($row_check_card_id > 0 ) {
      $row_user_id = mysqli_fetch_array($result_check_card_id,MYSQLI_ASSOC);
      $re_user_id_old = $row_user_id['user_id'];
        $qry_upd_user = "UPDATE user SET
        user_name_prefix ='$re_prefixname',
        user_fname='$re_fname',
        user_lname='$re_lname',
        user_sex='$re_sex',
        user_age='$re_age',
        user_card_id='$re_card_id',
        user_tel='$re_tel',
        user_address='$re_address',
        user_congenital_disease='$re_user_cd',
        user_drug_allergy='$re_user_da',
        user_vaccine_covid_19='$re_vaccine'
        WHERE user_id = $re_user_id_old";
        $result_upd_user = mysqli_query($dbcon,$qry_upd_user);
        if ($result_upd_user) {
          $qry_insert_re_user_old = "INSERT INTO reserve (reserve_prefixname,reserve_fname,reserve_lname,reserve_card_id,
            reserve_tel,reserve_age,reserve_sex,reserve_address,reserve_congenital_disease,reserve_drug_allergy,reserve_stm,
            reserve_stm_other,reserve_date,reserve_time,reserve_status,user_id,reserve_vaccine_covid_19)
            VALUES ('$re_prefixname','$re_fname','$re_lname','$re_card_id','$re_tel','$re_age','$re_sex','$re_address',
            '$re_user_cd','$re_user_da','$re_stm','$re_stm_other','$re_date','$re_time','$re_status','$re_user_id_old','$re_vaccine')";
            $result_insert_re_user_old = mysqli_query($dbcon,$qry_insert_re_user_old);
            if ($result_insert_re_user_old){
            $_SESSION["user_id"] = $re_user_id_old;
            $_SESSION["fullname"] = $fullname;
            $_SESSION["user_type"] = 'ผู้ใช้งานทั่วไป';
            echo '1|'.$fullname;
            }
        }
    }else {
      $qry_register_user = "INSERT INTO user (user_name_prefix,user_fname,user_lname,user_card_id,
        user_tel,user_age,user_sex,user_address,user_congenital_disease,user_drug_allergy,user_vaccine_covid_19)
        VALUES ('$re_prefixname','$re_fname','$re_lname','$re_card_id','$re_tel','$re_age','$re_sex','$re_address',
        '$re_user_cd','$re_user_da','$re_vaccine')";
        $result_register_user = mysqli_query($dbcon,$qry_register_user);
        if ($result_register_user) {
          $qry_check_card_id_new = "SELECT * FROM user WHERE user_card_id = '$re_card_id'";
          $result_check_card_id_new = mysqli_query($dbcon,$qry_check_card_id_new);
          $row_check_card_id_new  = mysqli_num_rows($result_check_card_id_new);
          if ($row_check_card_id_new > 0) {
            $row_user_id_new = mysqli_fetch_array($result_check_card_id_new,MYSQLI_ASSOC);
            $re_user_id_new = $row_user_id_new['user_id'];

            $qry_insert_re_user_new = "INSERT INTO reserve (reserve_prefixname,reserve_fname,reserve_lname,reserve_card_id,
              reserve_tel,reserve_age,reserve_sex,reserve_address,reserve_congenital_disease,reserve_drug_allergy,reserve_stm,
              reserve_stm_other,reserve_date,reserve_time,reserve_status,user_id,reserve_vaccine_covid_19)
              VALUES ('$re_prefixname','$re_fname','$re_lname','$re_card_id','$re_tel','$re_age','$re_sex','$re_address',
              '$re_user_cd','$re_user_da','$re_stm','$re_stm_other','$re_date','$re_time','$re_status','$re_user_id_new','$re_vaccine')";
              $result_insert_re_user_new = mysqli_query($dbcon,$qry_insert_re_user_new);
              if ($result_insert_re_user_new){
                $_SESSION["user_id"] = $re_user_id_new;
                $_SESSION["fullname"] = $fullname;
                $_SESSION["user_type"] = 'ผู้ใช้งานทั่วไป';
                echo '1|'.$fullname;
              }
          }
        }
    }
  }

?>
