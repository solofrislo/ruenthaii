<?php
require __DIR__ . '/../../Connect.php';


$searchTerm = isset($_POST['search']) ? mysqli_real_escape_string($dbcon, trim($_POST['search'])) : '';

$query = "SELECT * FROM clinic";
if (!empty($searchTerm)) {
    $query .= " WHERE clinic_name LIKE '%$searchTerm%'";
}
$query .= " ORDER BY clinic_id DESC";

$result = mysqli_query($dbcon, $query);

if (!isset($_POST['search'])) {
    echo '<div class="container-fluid mt-4 px-0">
            <div class="row justify-content-center">
                <div class="col-12 pb-3">
                    <div class="card border-0 darker box">
                        <div class="card-body ">
                            <h5 class="fw-bold txt01">รายการคลินิกเฉพาะโรค</h5>
                            <div class="gradient-red mt-3 mb-3" style="height:3px;"></div>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3" id="clinic_list">';
}
$modal_detail = ""; 
if (mysqli_num_rows($result) > 0) {
    while ($clinic = mysqli_fetch_assoc($result)) {
        $clinic_id = htmlspecialchars($clinic['clinic_id']);
        $clinic_name = htmlspecialchars($clinic['clinic_name']);
        $clinic_img = !empty($clinic['head_img']) ? htmlspecialchars($clinic['head_img']) : 'default_image.jpg';
        $Trast_1 = htmlspecialchars($clinic['Trast_1'] ?? 'ไม่มีเนื้อหา');
        $subtrast_1 = htmlspecialchars($clinic['subtrast_1'] ?? 'ไม่มีรายละเอียด');
        $location_clinic = htmlspecialchars($clinic['location_clinic'] ?? 'ไม่มีข้อมูล');
        $opening_days = htmlspecialchars($clinic['opening_days'] ?? 'ไม่มีข้อมูล');
        $location_img = !empty($clinic['location_img']) ? htmlspecialchars($clinic['location_img']) : 'default_image.jpg';

        $sections = [];
        $subheads = [];
        for ($i = 1; $i <= 5; $i++) {
            $sections[$i] = htmlspecialchars($clinic["section_$i"] ?? '');
            $subheads[$i] = htmlspecialchars($clinic["subhead_$i"] ?? '');
        }

        $imageData = [];
        for ($i = 1; $i <= 3; $i++) {
            $imageData[$i]['image'] = !empty($clinic["image_$i"]) ? htmlspecialchars($clinic["image_$i"]) : 'default_image.jpg';
            $imageData[$i]['content'] = htmlspecialchars($clinic["image_content_$i"] ?? '');
        }
        echo '
        <div class="col">
            <div class="card shadow border-0 rounded-3">
                <div class="text-center">
                    <img src="Img/ImgClinic/' . $clinic_img . '" alt="Clinic Image" class="img-fluid rounded-top w-100" style="max-height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title txt01 txt18 fw-bold">' . $clinic_name . '</h5>
                        <button class="btn btn-warning text-white btn-sm me-2" onclick="window.location.href=\'Admin.php?action=EditClinic&clinic_id=' . $clinic_id . '\'">
                            <i class="fa fa-edit"></i> แก้ไข
                        </button>
                        <button class="btn btn-danger btn-sm me-2 delete-btn" data-clinic-id="'. $clinic_id .'">
                            <i class="fa fa-trash-alt"></i> ลบ
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewClinicModal' . $clinic_id . '">
                            <i class="fa fa-eye"></i> ดูข้อมูล
                        </button>
                    </div>
                </div>
            </div>
        </div>';
    $modal_detail .= '
    <div class="modal fade" id="viewClinicModal' . $clinic_id . '" tabindex="-1" aria-labelledby="viewClinicModalLabel' . $clinic_id . '" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title fw-bold text-white">ดูข้อมูลคลินิก</h5> 
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-danger" style="font-size: 16px;">ชื่อคลินิก:</h5>
                    <p class="text-secondary">' . $clinic_name . '</p>
                    
                    <h5 class="text-danger" style="font-size: 16px;">รูปภาพหน้าปก:</h5>
                    <img src="Img/ImgClinic/' . $clinic_img . '" class="img-fluid rounded border" style="max-width: 50%;">';

                    for ($i = 1; $i <= 5; $i++) {
                        if (!empty($sections[$i])) {
                            $modal_detail .= '<h5 class="text-danger txt18 mt-3" style="font-size: 16px;">' . $sections[$i] . '</h5>
                                              <p class="text-secondary txt16">' . nl2br($subheads[$i]) . '</p>';
                        }
                    }
                    $modal_detail .= '<h5 class="text-danger mt-3"style="font-size: 16px;">รูปภาพการรักษา:</h5>
                    <div class="row row-cols-1 row-cols-md-3 g-3">';
                    for ($i = 1; $i <= 3; $i++) {
                        $modal_detail .= '<div class="col-md-4 text-center">
                                            <img src="Img/ImgClinic/' . $imageData[$i]['image'] . '" class="img-fluid rounded border" alt="ยังไม่ได้ใส่รูปภาพ" style="max-width: 200px;">
                                            <p class="text-secondary mt-2">' . $imageData[$i]['content'] . '</p>
                                          </div>';
                    }
                    $modal_detail .= '</div>'; 
                    $modal_detail .= '<div class="d-flex flex-wrap gap-4 mt-3">
                                        <div class="container-box-1">
                                            <h5 class="text-danger "style="font-size: 16px;">สถานที่ให้บริการ:</h5>
                                            <p class="text-secondary">' . $location_clinic . '</p>
                                        </div>
                                        <div class="container-box-2">
                                            <h5 class="text-danger "style="font-size: 16px;">วันเเละเวลาให้บริการ:</h5>
                                             <p class="text-secondary">' . $opening_days . '</p>
                                        </div>
                                      </div>
                                      <h5 class="text-danger" style="font-size: 16px;">รูปภาพสถานที่ให้บริการ:</h5>
                                      <img src="Img/ImgClinic/' . $location_img . '" class="img-fluid rounded border" style="max-width: 200px;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>';

    }
} else {
    echo '<div class="d-flex justify-content-center align-items-center" style="min-height: 50vh; width: 100%;">
                <div class="text-center ">
                    <p class="fw-bold txt01  fw-bold txt16">ไม่พบข้อมูลคลินิกเฉพาะโรค!</p>
                    <p class="txt01 txt16">"โปรดลองค้นหาข้อมูลอีกครั้ง"</p>
                    <img src="Img/ImgWeb/2808164.png" class="img-fluid" style="max-width: 400px;">
                </div>
          </div>';
}

echo '</div></div></div></div></div>';
echo $modal_detail;
?> 

<!-- JavaScript  -->
<script src="Admin/ManageClinic/Js/Show.js"></script>
<!-- css -->
<link rel="stylesheet" href="Admin/ManageClinic/css/Style_1.css">

