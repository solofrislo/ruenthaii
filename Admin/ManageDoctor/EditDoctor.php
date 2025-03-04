<?php

 require '../../Connect.php';

 $doctor_id=$_POST['iddtr'];
 $doctor_prefix_name = $_POST['doctor_prefix_name'];
 $doctor_fname = $_POST['doctor_fname'];
 $doctor_lname = $_POST['doctor_lname'];
 $doctor_rank = $_POST['doctor_rank'];
 $doctor_professional_license = $_POST['doctor_professional_license'];
 $doctor_transcript = $_POST['doctor_transcript'];
 $doctor_allow = $_POST['doctor_allow'];
 $doctor_sort = $_POST['doctor_sort'];
 $doctor_sort_sum = $doctor_sort+1 ;

 $qry_edit_doctor = "UPDATE doctor SET
 doctor_prefix_name ='$doctor_prefix_name',
 doctor_fname='$doctor_fname',
 doctor_lname='$doctor_lname',
 doctor_rank='$doctor_rank',
 doctor_professional_license='$doctor_professional_license',
 doctor_transcript='$doctor_transcript',
 doctor_allow='$doctor_allow',
 doctor_sort='$doctor_sort'
 WHERE doctor_id = '$doctor_id'";
$result_edit_doctor = mysqli_query($dbcon,$qry_edit_doctor);
if ($result_edit_doctor) {
 echo 1;
}else {
 echo 0;
}

  ?>
