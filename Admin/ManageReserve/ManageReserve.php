<div class="container-fluid">
  <div class="row justify-content-center mt-xl-5 mt-lg-5 mt-sm-5 mt-3">
    <div class="col-xl-11 col-lg-11 col-sm-11 col-12 pb-600">
      <div class="h5 txt01 fw-bold text-center">
        จัดการข้อมูลการจอง
      </div>
      <div class="row justify-content-center py-0 mt-3">
        <div class="col-12 text-center px-0">
          <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-5 col-3 my-auto pe-0">
              <input type="text" class="form-control py-1 shadow-none " id="search_reserve" placeholder="ค้นหา">
            </div>
            <div class="col-auto my-auto px-1">
              <button type="button"class="btn btn-primary py-2 position-relative shadow-none" onclick="slstatus(0)"><i class="fa fa-bell" aria-hidden="true"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white text-primary border border-1 border-primary">
                  <div id="loadstatusedit0">
                    <?php require 'Admin/ManageReserve/SelectStReMg.php'; ?>
                  </div>
                </span>
              </button>
            </div>
            <div class="col-auto my-auto me-auto ps-3">
              <a href="#" class="calendarMd"><button type="button" class="btn btn-light py-2 border border-2 shadow-none"><i class="fas fa-calendar-alt"></i></button></a>
            </div>
            <div class="col-auto my-auto">
              <div class="dropdown">
                <button class="btn hover-light border-danger shadow-none dropdown-toggle py-1 txt13" type="button" id="btnshowstatus" data-bs-toggle="dropdown" aria-expanded="false">
                สถานะการจอง
                </button>
                <ul class="dropdown-menu col-12" aria-labelledby="btnshowstatus">
                  <li><button type="button" class="dropdown-item btn shadow-none col-12 hover-light txt13" onclick="slstatus(0)"><i class="fa fa-circle text-warning" aria-hidden="true"></i> รอการอนุมัติ</button></li>
                  <li><button type="button" class="dropdown-item btn shadow-none col-12 hover-light txt13" onclick="slstatus(4)"><i class="fa fa-circle text-success" aria-hidden="true"></i> อนุมัติแล้ว</button></li>
                  <li><button type="button" class="dropdown-item btn shadow-none col-12 hover-light txt13" onclick="slstatus(1)"><i class="fa fa-circle text-primary" aria-hidden="true"></i> รับบริการเเล้ว</button></li>
                  <li><button type="button" class="dropdown-item btn shadow-none col-12 hover-light txt13" onclick="slstatus(2)"><i class="fa fa-circle text-danger" aria-hidden="true"></i> ไม่ได้รับบริการ</button></li>
                  <li><button type="button" class="dropdown-item btn shadow-none col-12 hover-light txt13" onclick="slstatus(3)"><i class="fa fa-bars" aria-hidden="true"></i> ทั้งหมด</button></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="row justify-content-center">
            <div class="col border-y bg02 py-1 d-none d-xl-block d-lg-block d-md-none d-sm-block">
              <div class="text-white txt13">
                เลขบัตรประชาชน
              </div>
            </div>
            <div class="col border-y bg02 py-1 d-none d-xl-block d-lg-block d-md-block d-sm-block">
              <div class="text-white txt13">
                ชื่อ - นามสกุล
              </div>
            </div>
            <div class="col border-y bg02 py-1">
              <div class="text-white txt13">
                วันที่ ว/ด/ป
              </div>
            </div>
            <div class="col border-y bg02 py-1">
              <div class="text-white txt13">
                เวลา
              </div>
            </div>
            <div class="col-3 border-y bg02 py-1 d-none d-xl-block d-lg-block d-md-block d-sm-block">
              <div class="text-white txt13">
                อาการ
              </div>
            </div>
            <div class="col border-y text-center bg02 py-1">
              <div class="text-white txt13">
                สถานะ
              </div>
            </div>
            <div class="col border-y text-center bg02 py-1">
              <div class="text-white txt13">
                จัดการข้อมูล
              </div>
            </div>
          </div>
          <div id="show_status_reserve"></div>
        </div>
      </div>
    </div>
  </div>
</div>






<script src="calendar/js/pignose.calendar.full.js"></script>
<link href="calendar/css/pignose.calendar.css" rel="stylesheet" />
<script src="Admin/ManageReserve/ManageReservejs.js"></script>
