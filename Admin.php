<?php
session_start();
require 'Header.php';

if (isset($_SESSION["user_id"])) {
  if ($_SESSION["user_type"] == 'ผู้ดูแลระบบ') {
  }elseif($_SESSION["user_type"] == 'ผู้ใช้งานทั่วไป'){
    echo '
    <script>
      window.location.href ="Index.php";
    </script>
    ';
  }
}else {
  echo '
  <script>
    window.location.href ="Index.php";
  </script>
  ';
}

?>
<input type="hidden" name="" value="<?php echo isset($_GET['action']) ? $_GET['action'] : ''; ?>" id="active_menu">
<div class="container-fluid position-relative" >
  <div class="row justify-content-start">
    <div class="col-xl-2 col-lg-12 col-md-12 col-sm-12 col-12 bg-light ablmenu heigthmenu border-left shadow" >
      <div class="col-12" >
        <div class="row pt-2">
          <div class="col-auto">
              <img src="Img/ImgWeb/logo002.png" height="50" width="auto"/>
          </div>
          <div class="col-auto ps-0">
            <div class="h4 txt01 fw-bold">
              <span class="p-0 m-0">คลินิกเเพทย์</span><br />
              <span class="p-0 m-0">แผนไทย</span>
            </div>
          </div>
          <div class="col-12 d-block d-xl-none position-absolute d-flex justify-content-end" onclick="showmenuadmin()">
            <i class="fa fa-bars px-2 py-2 txt01"style="font-size:35px;" aria-hidden="true"></i>
          </div>
        </div>
      </div>
      <div class="col-12 d-none d-xl-block" id="hiddenmenuadmin">
        <div class="gradient3 my-0 d-block d-sm-block d-md-block d-lg-block d-xl-none" style="height:2px;"></div>
        <div class="col-12 text-center text-secondary my-3 txt14">
          ผู้ดูแลระบบ : <?php echo $_SESSION["fullname"]; ?>
        </div>
        <div class="col-12 my-3">
          <div class="row justify-content-center">
            <div class="col-auto d-flex justify-content-center">
              <a href="Admin.php?action=HomeAdmin"class="btn zoom shadow-none"><i class="fa fa-home txt01" aria-hidden="true" style="font-size:18px;"></i><br /><span class="txt11 fw-bold txt01">หน้าหลัก</span></a>
            </div>
            <div class="col-auto d-flex justify-content-center">
              <a href="Admin.php?action=Manual" class="btn zoom shadow-none"><i class="fas fa-book txt01"></i><br /><span class="txt11 fw-bold txt01">คู่มือ</span></a>
            </div>
            <div class="col-auto d-flex justify-content-center">
              <a class="btn zoom shadow-none" data-bs-toggle="modal" data-bs-target="#modallogout"><i class="fas fa-power-off txt01 txt18"></i><br /><span class="txt11 fw-bold txt01">ออกระบบ</span></a>
            </div>
          </div>
        </div>
        <div class="gradient3 my-3 d-none d-xl-block d-lg-none d-md-none d-sm-none" style="height:2px;"></div>
        <div class="mb-2">
          <a id="active_menu_reserve" href="Admin.php?action=ManageReserve"class="btn hover_border_red_txt_red_bg_white col-12 mb-2 mx-0 ps-2 pe-0 shadow text-start position-relative">
            <i class="fa fa-bell" aria-hidden="true"></i> จัดการข้อมูลการจอง
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white txt01 border-red">
                <?php require 'Admin/ManageReserve/SelectStReMg.php'; ?>
            </span>
          </a>
          <a id="active_menu_user" href="Admin.php?action=User"class="btn hover_border_red_txt_red_bg_white col-12 mb-2 mx-0 ps-2 pe-0 shadow text-start"><i class="fa fa-users" aria-hidden="true" style="font-size:12px;"></i> จัดการข้อมูลผู้ใช้งาน</a>
          <a id="active_menu_ManageDoctor" href="Admin.php?action=ManageDoctor"class="btn hover_border_red_txt_red_bg_white col-12 mb-2 mx-0 ps-2 pe-0 shadow text-start"><i class="fa fa-user-md" aria-hidden="true" style="font-size:12px;"></i> จัดการข้อมูลแพทย์</a>
          <a id="active_menu_ManageDateTime" href="Admin.php?action=ManageDateTime"class="btn hover_border_red_txt_red_bg_white col-12 mb-2 mx-0 ps-2 pe-0 shadow text-start"><i class="fas fa-calendar-alt"></i> จัดการวันที่</a>
          <a id="active_menu_ManageNews" href="Admin.php?action=ManageNews"class="btn hover_border_red_txt_red_bg_white col-12 mb-2 mx-0 ps-2 pe-0 shadow text-start"><i class="fas fa-globe-americas" style="font-size:12px;"></i> จัดการข้อมูลข่าว</a>
          <a id="active_menu_ManageBanner" href="Admin.php?action=ManageBanner"class="btn hover_border_red_txt_red_bg_white col-12 mb-2 mx-0 ps-2 pe-0 shadow text-start"><i class="fa-regular fa-image" aria-hidden="true" style="font-size:12px;"></i> จัดการข้อมูลเเบนเนอร์</a>
          <a id="active_menu_ManageClinic" href="Admin.php?action=ManageClinic"class="btn hover_border_red_txt_red_bg_white col-12 mb-2 mx-0 ps-2 pe-0 shadow text-start"><i class="fa-solid fa-house-chimney-medical" aria-hidden="true" style="font-size:12px;"></i> จัดการข้อมูลคลินิกเฉพาะโรค</a>
          <a id="active_menu_ManageVideo" href="Admin.php?action=ManageVideo"class="btn hover_border_red_txt_red_bg_white col-12 mb-2 mx-0 ps-2 pe-0 shadow text-start"><i class="fa-solid fa-video" aria-hidden="true" style="font-size:12px;"></i> จัดการข้อมูลคลิปวิดีโอ</a>
          <a id="active_menu_ManageReport" href="Admin.php?action=ManageReport"class="btn hover_border_red_txt_red_bg_white col-12 mb-2 mx-0 ps-2 pe-0 shadow text-start"><i class="fa fa-pie-chart" aria-hidden="true" style="font-size:12px;"></i> สรุปรายงาน</a>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-12 px-0">
    </div>
    <div class="col-xl-10 col-12 px-0"style="max-height:100vh;overflow:auto;">
      <?php
      if (isset($_GET['action'])) {
        switch ($_GET['action']) {
          case 'User':
            require 'Admin/ManageUser/ManageUser.php';
            break;
          case 'HomeAdmin':
            require 'Admin/HomeAdmin/HomeAdmin.php';
            break;
          case 'ManageDateTime':
            require 'Admin/ManageDateTime/ManageDateTime.php';
            break;
          case 'ManageReserve':
            require 'Admin/ManageReserve/ManageReserve.php';
            break;
          case 'ManageDoctor':
            require 'Admin/ManageDoctor/ManageDoctor.php';
            break;
          case 'ManageReport':
            require 'Admin/ManageReport/ManageReport.php';
            break;
          case 'ManageNews':
            require 'Admin/ManageNews/ManageNews.php';
            break;
          case 'Manual':
            require 'Admin/Manual/Manual.php';
            break;
          case 'ManageVideo':
            require 'Admin/ManageVideo/ManageVideo.php';
            break;
          case 'ManageBanner':
           require 'Admin/ManageBanner/ManageBanner.php';
            break;
          case 'ManageClinic':
            require 'Admin/ManageClinic/ManageClinic.php';
            break;
          case 'AddClinic': 
            require 'Admin/ManageClinic/add_clinic_.php';
              break;
          case 'EditClinic':
            require 'Admin/ManageClinic/Edit_clinic.php';
            break;
          case 'Back_page_clinic':
            require 'Admin/ManageClinic/ManageClinic.php';
            break;
          default:
          '';
        }
      }else{
        require 'Admin/HomeAdmin/HomeAdmin.php';
      }
       ?>
    </div>
  </div>
</div>

<!-- modal logout..................................................................................................... -->

<div class="modal fade" id="modallogout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="text-end p-3 pb-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="text-center h5 py-2">
        <p>ออกจากระบบหรือไม่</p>
      </div>
      <div class="py-3 text-center">
        <a href="User/Logout/Logout.php"class="text-decoration-none"><button type="button " class="btn text-white bg02 shadow-none">ยืนยัน</button></a>
        <a class="text-decoration-none me-3"><button type="button" class="btn btn-light border border-2 shadow-none" data-bs-dismiss="modal">ยกเลิก</button></a>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script src="JsAdmin.js"></script>
<?php
  require 'Footer.php';
?>
