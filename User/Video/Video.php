<div class="container-fluid py-xl-5 py-0">
    <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-10 col-md-10 col-sm-12">
            <img class="img-fluid w-100 rounded" src="Img/ImgWeb/Video_image01.png" alt="Header Image" />
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-xl-7 col-lg-10 col-md-10 col-sm-12">
            <div class="card border-0 shadow pb-2">
                <div class="carqd-body text-center">
                    <div class="row justify-content-center">
                        <h5 class="txt20 txt01 fw-bold mt-3">คลิปวิดีโอ </h5>
                        <p class="txt20 txt01 ">"คลินิกเเพทย์เเผนไทย"</ย>
                        <div class="col-xl-6 col-lg-6 col-sm-8 col-10 pe-0 mb-3">
                        <input type="text" class="form-control py-1 shadow mt-2" id="search_video"
                                placeholder="ค้นหาวิดีโอ" oninput="searchVideo()">
                        </div>
                        <div class="col-auto px-1">
                        <button type="button" class="btn btn-danger py-2 shadow-none mt-2">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-xl-7 col-lg-10 col-md-10 col-sm-12">
            <div class="card border-0 shadow pb-2">
                <div class="mt-1 px-xl-3 px-2" id="Show_Video_menu">
                    <?php require 'User/Video/SelectVideo.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Java-Script -->
<script src="User/Video/Js/Show_Video.js"></script>
<!-- Css -->
<link rel="stylesheet" href="User/Video/css/Style.css">

