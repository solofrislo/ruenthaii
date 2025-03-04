<div class="container-fluid">
    <div class="row justify-content-center mt-xl-5 mt-lg-5 mt-sm-5 mt-3">
        <div class="col-12 pb-5">
            <div class="card border-0 darker box text-center">
                <div class="card-body darker box">
                    <h5 class="txt01 fw-bold">จัดการข้อมูลคลินิกเฉพาะโรค</h5>
                    <div class="gradient-red mt-3 mb-3" style="height:3px;"></div>
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-7 col-md-8 col-sm-10 col-12">
                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                                <input type="text" class="form-control py-1 shadow" id="search_clinic" 
                                    placeholder="ค้นหาคลินิก" onkeyup="searchClinic()" style="flex: 1; min-width: 250px;">
                                
                                <button type="button" class="btn btn-success py-2 shadow-none">
                                    <i class="fas fa-search"></i>
                                </button>

                                <a href="Admin.php?action=AddClinic" class="btn btn-success py-1">
                                    <i class="fa fa-plus"></i> เพิ่มคลินิก
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="mt-4">
                <?php require 'Admin/ManageClinic/SelectManageClinic.php'; ?>
            </div>

        </div>
    </div>
</div>
