<div class="container-fluid">
  <div class="row justify-content-center mt-xl-5 mt-lg-5 mt-sm-5 mt-3">
    <div class="col-xl-11 col-lg-11 col-sm-11 col-12">
      <div class="h5 txt01 fw-bold text-center">
        จัดการข้อมูลเเพทย์
      </div>
      <div class="row justify-content-center py-0 mt-3 ">
        <div class="col-12 text-center px-0">
          <div class="row justify-content-start">
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-5 col-7 my-auto pe-0">
              <input type="text"class="form-control py-1 shadow-none" name="fname" id="search_doctor" placeholder="ค้นหาแพทย์" required>
            </div>
            <div class="col-auto px-1">
              <button type="button" class="btn btn-success rounded-3 py-2 shadow-none" data-bs-toggle="modal" data-bs-target="#insertdoctor"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
            <div class="col-auto ps-0 pe-1">
              <a  href="Admin.php?action=ManageDoctor" class="btn btn-primary rounded-3 py-2 shadow-none"><i class="fas fa-user-md"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center pb-3">
        <div id="show_doctor">
          <?php require 'Admin/ManageDoctor/SelectManageDoctor.php'; ?>
        </div>
      </div>
    </div>
  </div>
</div>



<script src="Admin/ManageDoctor/ManageDoctorjs.js"></script>
