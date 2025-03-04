<?php
session_start();
require 'Header.php';
require 'HtmlTag/Navbar.php';
echo '<div class="background-1">';

if (isset($_SESSION["user_id"])) {
  if ($_SESSION["user_type"]== 'ผู้ใช้งานทั่วไป') {
  }elseif($_SESSION["user_type"] == 'ผู้ดูแลระบบ'){
    echo '
    <script>
      window.location.href ="Admin.php";
    </script>
    ';
  }
}else {

}

if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    case 'News':
      require 'User/News/News.php';
      break;
    case 'Video':
      require 'User/Video/Video.php';
      break;
    case 'DataDoctor':
      require 'User/DataDoctor/DataDoctor.php';
      break;
    case 'Contact':
      require 'User/Contact/Contact.php';
      break;
    case 'Service':
      require 'User/Service/Service.php';
      break;
    case 'Reserve':
      require 'User/Reserve/Reserve.php';
      break;
    case 'DataUser':
      require 'User/DataUser/DataUser.php';
      break;
    case 'HistoryReserve':
      require 'User/HistoryReserve/HistoryReserve.php';
      break;
    case 'HistoryHospital':
      require 'User/HistoryHospital/HistoryHospital.php';
      break;
    case 'Spa_services':
      require 'User/medical_services/Spa_massage.php';
      break;
    case 'Balancing_massage':
      require 'User/medical_services/Balancing_massage.php';
      break;
    case 'foot_massage':
      require 'User/medical_services/foot_massage.php';
      break;
    case 'Health_massage':
      require 'User/medical_services/Health_massage.php';
      break;
    case 'Royal_massgae':
      require 'User/medical_services/Royal_massgae.php';
      break;
    case 'Mother_massage':
      require 'User/medical_services/Mother_massage.php';
      break;
    case 'Herbal_steaming':
      require 'User/medical_services/Herbal_steaming.php';
      break;
    case 'herbal_medicine':
      require 'User/medical_services/herbal_medicine.php';
      break;
    case 'Clinic':
      require 'User/Clinic/Clinic.php';
      break;
    default:'';
  }
}else {
  require 'User/HomeUser/Menu.php';
  require 'User/HomeUser/HomeNews/HomeNews.php';
  require 'User/HomeUser/HomeVideo/HomeVideo.php';
  require 'User/HomeUser/ServiceHome.php';
  require 'User/HomeUser/Knowledge.php';
  require 'User/HomeUser/advice.php';
  require 'User/HomeUser/taboo.php';
}
echo '</div>';
require 'HtmlTag/NavFoot.php';
require 'Footer.php';
?>
