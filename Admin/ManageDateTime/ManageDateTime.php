<?php

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

<div class="container-fluid py-4">
  <div class="row justify-content-center">
    <div class="col-12 h5 fw-bold txt01 text-center mb-xl-4 mb-lg-4 mb-sm-4 mb-2 ">
      จัดการวันที่
    </div>
    <div class="col-12 text-center mb-3">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-8 col-12">
          <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 py-auto mt-2">
              <button type="button" class="btn bg02 col-12 shadow-none text-white txt15" onclick="editdatelimit()">
                <div class="row justify-content-center">
                  <div class="col-auto me-auto">
                    <i class="fas fa-calendar-alt"></i> จำนวนวันจองล่วงหน้า
                  </div>
                  <div class="col-auto">
                    <div class="badge bg-white text-dark m-0 px-2 py-2"><span class="txt12"id="editdatelimit"></span> วัน</div>
                  </div>
                </div>
              </button>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 py-auto mt-2">
              <button type="button" class="btn bg02 col-12 shadow-none text-white txt15" onclick="editlimitround()">
                <div class="row justify-content-center">
                  <div class="col-auto me-auto">
                    <i class="fa fa-users" aria-hidden="true"></i> จำนวนคนต่อรอบ
                  </div>
                  <div class="col-auto">
                    <div class="badge bg-white text-dark m-0 px-2 py-2"><span class="txt12"id="editlimitround"></span> คน</div>
                  </div>
                </div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-lg-5 col-sm-6 col-12 py-xl-0 py-lg-0 py-sm-0 py-3">
      <div class="text-center txt01 txt18 fw-bold">เลือกวันที่</div>
      <div class="calendar-light"></div>
    </div>
    <div class="col-xl-4 col-lg-5 col-sm-6 col-12 py-xl-0 py-lg-0 py-sm-0 py-3" id="showeditdatetime">
      <?php
      require 'Admin/ManageDateTime/GetDateTime.php';
      require 'Admin/ManageDateTime/DateOff.php';
      ?>
    </div>
  </div>
</div>

<!-- modal input datelimit...................................................................................... -->
<div class="modal fade" id="modaleditdatelimit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content border-0">
      <div class="bg02 py-2 rounded-top">
        <div class="txt16 text-white text-center"><i class="fas fa-calendar-alt"></i> จำนวนวันจองล่วงหน้า</div>
      </div>
      <div class="modal-body py-0">
        <form class="needs-validation" novalidate id="formmodaleditdatelimit">
          <div class="row justify-content-center">
            <div class="col-12 my-3">
              <div class="form-floating mb-3">
                <input class="form-control txt15 shadow-none" id="inputdatelimit" placeholder="..." required onkeypress="javascript:return isNumber(event)"/>
                <label class="text-secondary txt13"for="inputdatelimit">จำนวนวัน</label>
                <div class="invalid-feedback">
                  โปรดระบุจำนวนวัน
                </div>
              </div>
            </div>
            <div class="col-12 text-end">
              <button onclick="confirmformmodaleditdatelimit()" type="button"class="btn btn-success text-white txt13 shadow-none">ยืนยัน</button>
              <a href="#" class="btn btn-light border border-2 txt13 shadow-none" data-bs-toggle="modal" data-bs-dismiss="modal">ยกเลิก</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- modal input roundlimit...................................................................................... -->
<div class="modal fade" id="modaleditlimitround" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content border-0">
      <div class="bg02 py-2 rounded-top">
        <div class="txt16 text-white text-center"><i class="fa fa-users" aria-hidden="true"></i> จำนวนคนต่อรอบ</div>
      </div>
      <div class="modal-body py-0">
        <form class="needs-validation" novalidate id="formmodaleditlimitround">
          <div class="row justify-content-center">
            <div class="col-12 my-3">
              <div class="form-floating mb-3">
                <input class="form-control txt15 shadow-none" id="inputroundlimit" placeholder="..." required onkeypress="javascript:return isNumber(event)"/>
                <label class="text-secondary txt13"for="inputroundlimit">จำนวนคน</label>
                <div class="invalid-feedback">
                  โปรดระบุจำนวนคน
                </div>
              </div>
            </div>
            <div class="col-12 text-end">
              <button onclick="confirmformmodaleditlimitround()" type="button"class="btn btn-success text-white txt13 shadow-none">ยืนยัน</button>
              <a href="#" class="btn btn-light border border-2 txt13 shadow-none" data-bs-toggle="modal" data-bs-dismiss="modal">ยกเลิก</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script src="calendar/js/pignose.calendar.full.js"></script>
<link href="calendar/css/pignose.calendar.css" rel="stylesheet" />
<script src="Admin/ManageDateTime/ManageDateTimejs.js"></script>
