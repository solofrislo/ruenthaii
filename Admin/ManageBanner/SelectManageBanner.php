<?php
require __DIR__ . '/../../Connect.php';


$qry_banner = "SELECT * FROM banner ORDER BY banner_sort ASC";
$result_banner = mysqli_query($dbcon, $qry_banner);

$banners = [];
while ($row_banner = mysqli_fetch_array($result_banner, MYSQLI_ASSOC)) {
    $banners[$row_banner['banner_sort']] = $row_banner;
}

// เริ่มต้นส่วนแสดงผล
echo '<div class="container-fluid">';
echo '<div class="row justify-content-center">';

for ($i = 1; $i <= 3; $i++) {
    echo '<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-3 px-2">';
    echo '<h5 class="text-center txt01 fw-bold">แบนเนอร์ที่ ' . $i . '</h5>';

    if (isset($banners[$i])) {
        $banner_id = $banners[$i]['banner_id'];
        $banner_img = trim($banners[$i]['banner_img']);
        $imagePath = file_exists(__DIR__ . '/../../Img/ImgBanner/' . $banner_img)
        ? 'Img/ImgBanner/' . $banner_img
        : 'Img/ImgBanner/default.jpg';

        echo ' 
        <div class="container-image">
            <img src="' .htmlspecialchars($imagePath,ENT_QUOTES, 'UTF-8') . '" 
            class="card-img-top img-fluid rounded-top" alt="Banner Image hover-zoom"
            data-bs-toggle="modal" data-bs-target="#zoomModal' . $banner_id . '">
            <div class="card-body text-center shadow rounded-3">
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-warning border text-white shadow-none me-2" data-bs-toggle="modal" data-bs-target="#editModal' . $banner_id . '">
                        <i class="fas fa-edit"></i> เเก้ไข
                    </button>
                    <button type="button" class="btn btn-danger shadow-none" onclick="deleteBanner( ' . $banner_id .')">
                        <i class="fa fa-trash-alt"></i> ลบ
                    </button>
                </div>
            </div>
  
        </div>';
        //Modal เรียกใช้การเเสดงภาพ
        echo '
        <div class="modal fade" id="zoomModal'. $banner_id . '" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <img src="' . htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') .'"
                        class="img-fluid w-100" alt="Zoomed Banner Image">
                    </div>
                </div>
            </div>
        </div>';
        //Modal สำหรับเเก้ไขเเบนเนอร์
        echo ' 
        <div class="modal fade" id="editModal' . $banner_id . '" tabindex="-1" aria-labelledby="editModalLabel' . $banner_id . '" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning  ">
                        <h5 class="modal-title text-white fw-bold txt18" id="editModalLabel' . $banner_id . '"><i class="fas fa-edit"> เเก้ไขเเบนเนอร์ที่ ' . $i . '</i></h5>
                    </div>
                    <div class="modal-body">
                         <form id="editBannerForm' . $banner_id . '" method="post" action="Admin/ManageBanner/EditBanner.php" enctype="multipart/form-data">
                    <input type="hidden" name="banner_id" value="' . $banner_id . '">
                    <input type="hidden" name="banner_sort" value="' . $i . '">
                        <div class="mb-3 >
                        <label for="bannerImage' . $i . '" class="form-label">เลือกภาพเเบนเนอร์ (ขนาด: 945 x 445 พิกเซล)</label><br>
                        <input type="file" class="form-control d-none" id="bannerImage' . $i . '" nameฤ="banner_img" accept="image/*" onchange="previewImage(this, \'preview' . $i . '\')">
                        <label for="bannerImage' . $i . '" class="btn btn-ight border  txt12">
                            <i class="fas fa-images" aria-hidden="true"></i> เเก้ไขรูปภาพ
                        </label>
                        <small class="text-danger">กรุณาอัปโหลดไฟล์ที่มีนามสกุลไฟล์ jpg, jpeg, png</small>
                    </div>
                    <div class="mb-3">
                        <!-- แสดงภาพที่ใช้งานอยู่ -->
                        <img id="preview' . $i . '" src="Img/ImgBanner/' . htmlspecialchars($banner_img, ENT_QUOTES, 'UTF-8') . '" 
                        alt="ตัวอย่างแบนเนอร์" class="img-thumbnail" style="max-width: 100%; height: auto;">
                    </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="updateBanner(\'editBannerForm' . $banner_id . '\')">ยืนยัน</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>';
    }else {
        echo '
        <div class="card shadow border-0 text-center" style="min-height:250px;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <p class="card-text text-secondary">ยังไม่รูปภาพ</p>
                <button type="button" class="btn btn-success rounded-3 shadow" data-bs-toggle="modal" data-bs-target="#insertbanner' . $i . '">
                    <i class="fa-regular fa-image "></i> เพิ่มเเบนเนอร์
                </button>
            </div>
        </div>';
        //Modal สำหรับเพื่มเเบนเนอร์
        echo ' 
        <div>
        <div class="modal fade" id="insertBanner' . $i . '" tabindex="-1" aria-labelledby="insertBannerLabel' . $i . '" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title  txt18 text-white fw-bold " id="insertBannerLabel' . $i . '"><i class="fa fa-plus"> เพิ่มเเบนเนอร์ที่ ' . $i . '</i></h5>
                </div>
            <div class="modal-body">
                <form id="insertBannerForm' . $i . '" method="post" action="Admin/ManageBanner/insertbanner.php" enctype="multipart/form-data">
                    <input type="hidden" name="banner_sort" value="' . $i . '">
                       <div class="mb-3">
                            <label for="bannerImage' . $i . '" class="form-label">เลือกภาพเเบนเนอร์ (ขนาด: 945 x 445 พิกเซล)</label><br>
                            <input type="file" class="form-control d-none" id="bannerImage' . $i . '" name="banner_img" accept="image/*" onchange="previewImage(this, \'preview' . $i . '\')" required>
                            <label for="bannerImage' . $i . '" class="btn btn-light border txt12">
                                <i class="fas fa-images" aria-hidden="true"></i> เพิ่มรูปภาพ
                            </label>
                            <small class="text-danger">กรุณาอัปโหลดไฟล์ที่มีนามสกุลไฟล์ jpg, jpeg, png</small>
                        </div>
                        <div class="mb-3 text-center">
                            <img id="preview' . $i . '" src="#" alt="ตัวอย่างรูปภาพ" class="img-thumbnail d-none" style="max-width: 100%; height: auto;">
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" 
                        onclick="insertBanner(\'insertBannerForm' . $i . '\', \'insertBanner' . $i . '\');">บันทึก</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
        </div>';
    }

    echo '</div>'; //ปิด div ของเเบนเนอร์เเต่ละรายการ

}

    echo '</div>'; //ปิด row
    echo '</div>'; //ปิด container-fluid

?>

<script src="Admin/ManageBanner/Js/Banner.js"></script>
