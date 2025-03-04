<div class="container-fluid mt-4 px-0">
    <div class="row justify-content-center">
        <div class="col-xl-11 col-lg-12 col-md-12 col-sm-12 col-12 pb-3">
            <div class="card border-0 darker box">
                <div class="card-body darker box text-center">
                    <div class="py-1">
                        <span class="fw-bold txt01" style="font-size:20px;">จัดการข้อมูลคลิปวิดีโอ</span>
                        <div class="gradient-red mt-3 mb-3" style="height:3px;"></div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                        <div class="flex-grow-1" style="max-width: 500px;">
                            <input type="text" class="form-control py-1 shadow" id="search_video"
                                placeholder="ค้นหาวิดีโอ" oninput="searchVideo()">
                        </div>
                        <button type="button" class="btn btn-success py-2 shadow-none" onclick="searchVideo()">
                            <i class="fas fa-search"></i>
                        </button>
                        <button type="button" class="btn btn-success rounded-3 py-1 shadow" data-bs-toggle="modal"
                            data-bs-target="#insertVideoModal">
                            <i class="fa-solid fa-video"></i> เพิ่มวิดีโอ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- แสดงข้อมูลวิดีโอ -->
<div id="Show-video">
    <?php require 'Admin/ManageVideo/SelectManageVideo.php'; ?>
</div>
<!-- Style -->
<link rel="stylesheet" href="Admin/ManageVideo/css/Style.css">
<!-- โหลดไฟล์ JavaScript -->
<script src="Admin/ManageVideo/Js/VideoShow.js"></script>
