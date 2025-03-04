<div class="container-fluid">
  <div class="row justify-content-center mt-xl-5 mt-lg-5 mt-sm-5 mt-3">
    <div class="col-xl-11 col-lg-11 col-sm-11 col-12">
      <div class="h5 txt01 fw-bold text-center">
        จัดการข้อมูลผู้ใช้งาน
      </div>
      <div class="row justify-content-center py-0 mt-3 ">
        <div class="col-12 text-center px-0">
          <div class="row justify-content-start">
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-5 col-7 my-auto pe-0">
              <input type="text"class="form-control py-1 shadow-none" name="fname" id="search_user" placeholder="ค้นหาผู้ใช้งาน" required>
            </div>
            <div class="col-auto px-1">
              <button type="button" class="btn btn-success rounded-3 zoom py-2" data-bs-toggle="modal" data-bs-target="#insertuser"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
            <div class="col-auto ps-0 pe-1">
              <a  href="Admin.php?action=User" class="btn btn-primary rounded-3 py-2 shadow-none"><i class="fas fa-users"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col py-1 bg02 d-none d-xl-block d-lg-block d-md-block d-sm-block">
          <div class="txt13 text-white">เลขบัตรประชาชน</div>
        </div>
        <div class="col py-1 bg02">
          <div class="txt13 text-white">ชื่อ - นามสกุล</div>
        </div>
        <div class="col py-1 bg02 d-none d-xl-block d-lg-block d-md-block d-sm-none">
          <div class="txt13 text-white">เบอร์โทรศัพท์</div>
        </div>
        <div class="col py-1 bg02 d-none d-xl-block d-lg-block d-md-none d-sm-none">
          <div class="txt13 text-white">ประเภทผู้ใช้งาน</div>
        </div>
        <div class="col py-1 text-center bg02 ">
          <div class="txt13 text-white">การอนุญาต</div>
        </div>
        <div class="col-xl-2 col-lg-2 col-sm-3 col-4 py-1 text-center bg02">
          <div class="txt13 text-white">จัดการข้อมูล</div>
        </div>
      </div>
      <div class="row justify-content-center pb-3">
        <div class="col-12" id="show_user">
          <?php require 'Admin/ManageUser/SelectUser.php'; ?>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="Admin/ManageUser/js.js"></script>
