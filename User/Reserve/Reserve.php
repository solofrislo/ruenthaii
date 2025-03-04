<?php
// require 'Htmltag/Navbar.php';
$qry_drop_dateoff="SELECT * FROM dateoff";
$result_drop_dateoff = mysqli_query($dbcon,$qry_drop_dateoff);
$row_drop_dateoff = mysqli_num_rows($result_drop_dateoff);
if ($row_drop_dateoff > 0) {
  while ($row_dateoff = mysqli_fetch_array($result_drop_dateoff,MYSQLI_ASSOC)) {
    echo '<input type="hidden" name="dateoff" value="'.$row_dateoff['dateoff_date'].'"/>';
  }
}else {
  echo '<input type="hidden" name="dateoff" value="0"/>';
}
 ?>
<div class="container-fluid">
  <div class="row justify-content-center py-xl-5 py-lg-5 py-sm-5 py-0">
    <div class="col-xl-7 col-12 py-3">
      <div class="card border-0 bg-transparent">
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-12 text-center">
              <div class="txt18 txt01 fw-bold">จองคิวรักษา</div>
              <div class="txt15">" คลินิกการเเพทย์แผนไทย โรงพยาบาลมหาราชนครราชสีมา "</div>
            </div>
            <div class="col-12 position-relative mt-5">
              <center>
                <div class="col-9 bg02"style="height:3px;"></div>
              </center>
              <div class="col-11 middle">
                <div class="row justify-content-between">
                  <div class="col-3 d-flex justify-content-center">
                    <div class="rounded-circle position-relative border-color-red bg-white pt-1"id="activebaricon1"style="height:40px; width:40px;">
                      <span class="txt01 txt20 fw-bold" id="stepnumberreserve1">1</span>
                    </div>
                  </div>
                  <div class="col-3 d-flex justify-content-center">
                    <div class="rounded-circle position-relative border-color-red bg-white pt-1"id="activebaricon2"style="height:40px; width:40px;">
                      <span class="txt01 txt20 fw-bold" id="stepnumberreserve2">2</span>
                    </div>
                  </div>
                  <div class="col-3 d-flex justify-content-center">
                    <div class="rounded-circle position-relative border-color-red bg-white pt-1"id="activebaricon3"style="height:40px; width:40px;">
                      <span class="txt01 txt20 fw-bold" id="stepnumberreserve3">3</span>
                    </div>
                  </div>
                  <div class="col-3 d-flex justify-content-center">
                    <div class="rounded-circle position-relative border-color-red bg-white pt-1"id="activebaricon4"style="height:40px; width:40px;">
                      <span class="txt01 txt20 fw-bold" id="stepnumberreserve4">4</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 position-relative mt-4">
              <div class="row justify-content-center">
                <div class="col-11 px-0">
                  <div class="row justify-content-between">
                    <div class="col-3 text-center txt15">
                      ข้อมูลจอง
                    </div>
                    <div class="col-3 text-center txt15">
                      อาการ
                    </div>
                    <div class="col-3 text-center txt15">
                      วันที่จอง
                    </div>
                    <div class="col-3 text-center txt15">
                      ตอบกลับ
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div>
              <div id="step1">
                <?php require 'User/Reserve/Step1.php' ?>
              </div>
              <div id="step2">
                <?php require 'User/Reserve/Step2.php' ?>
              </div>
              <div id="step3">
                <?php require 'User/Reserve/Step3.php' ?>
              </div>
              <div id="step4">
                <?php require 'User/Reserve/Step4.php' ?>
              </div>
            </div>

            <div class="col-12">
              <div class="row">
                <div class="col-auto me-auto d-flex justify-content-center">
                  <button type="button" class="btn btn-danger btnReserve txt14 shadow-none"id="btnBack"><i class="fa fa-chevron-left" aria-hidden="true"></i> ย้อนกลับ</button>
                </div>
                <div class="col-auto d-flex justify-content-center">
                  <button type="button" class="btn btn-Primary btnReserve txt14 shadow-none" id="btnNext">ถัดไป <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="calendar/js/pignose.calendar.full.js"></script>
<link href="calendar/css/pignose.calendar.css" rel="stylesheet" />
<script src="User/Reserve/Reservejs.js"></script>
