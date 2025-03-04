<?php
require '../../Connect.php';

$doctor_prefix_name = $_POST['insert_doctor_prefix_name'];
$doctor_fname = $_POST['insert_doctor_fname'];
$doctor_lname = $_POST['insert_doctor_lname'];
$doctor_rank = $_POST['insert_doctor_rank'];
$doctor_professional_license = $_POST['insert_doctor_professional_license'];
$doctor_transcript = $_POST['insert_doctor_transcript'];

    $qry_insert_doctor = "INSERT INTO doctor
    (doctor_prefix_name,
      doctor_fname,
      doctor_lname,
      doctor_rank,
      doctor_professional_license,
      doctor_transcript)
    VALUES ('$doctor_prefix_name',
      '$doctor_fname',
      '$doctor_lname',
      '$doctor_rank',
      '$doctor_professional_license',
      '$doctor_transcript')";
    $result_insert_doctor = mysqli_query($dbcon,$qry_insert_doctor);
    if ($result_insert_doctor){
      echo 1;
    }else if(!$result_insert_doctor){
      echo 0;
    }else {
      echo 2;
    }

 ?>
