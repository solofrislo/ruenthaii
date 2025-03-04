<?php
require_once __DIR__ . '/../../Connect.php';

if (!isset($_GET['clinic_id'])) {
    die("ไม่พบข้อมูลคลินิก");
}

$clinic_id = intval($_GET['clinic_id']);

$stmt = $dbcon->prepare("SELECT * FROM clinic WHERE clinic_id = ?");
$stmt->bind_param("i", $clinic_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("ไม่พบข้อมูลคลินิก");
}

$clinic = $result->fetch_assoc();
$stmt->close();
$dbcon->close();
?>

<div class="container-fluid py-xl-5 py-lg-5 py-md-5 py-sm-5 py-3">
    <div class="row justify-content-center px-0">
        <div class="col-xl-12 col-12 px-2">
            <div class="card rounded-3 shadow border-0">
                <div class="card-body">
                    <form id="editClinicForm" onsubmit="event.preventDefault(); updateClinic();"
                        enctype="multipart/form-data" novalidate>
                        <input type="hidden" name="clinic_id" value="<?= $clinic['clinic_id'] ?>">

                        <h5 class="txt24 fw-bold text-center text-warning mb-3">เเก้ไขข้อมูลคลินิก</h5>
                        <hr>
                        <!---------------------- ชื่อคลินิก ---------------------->
                        <div class="mb-3">
                            <label class="form-label txt18 text-danger">ชื่อคลินิกเฉพาะโรค</label>
                            <input type="text" name="clinic_name" class="form-control"
                                value="<?= $clinic['clinic_name'] ?>" required>
                        </div>
                        <!---------------------- รูปภาพหน้าปก ---------------------->
                        <div class="row mt-5 mb-3 align-items-center">
                            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                                <label class="form-label txt18 text-danger">รูปภาพหน้าปก
                                    <i class="fa-sharp fa-solid fa-circle-exclamation text-primary fs-3"
                                        data-bs-toggle="modal" data-bs-target="#infoModal-01"
                                        style="cursor: pointer;"></i>
                                </label>
                                <p class="txt16 text-danger ">(ขนาดรูปภาพที่เหมาะสม 1470 x 800 พิกเซล)</p>
                                <input type="file" class="form-control" name="head_img" accept="image/*"
                                    onchange="updatePreviewHead(event)">
                            </div>
                            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 mt-2 mt-md-0 d-flex align-items-center"
                                id="previewContainerHead"
                                style="display: <?= !empty($clinic['head_img']) ? 'flex' : 'none'; ?>; gap: 10px;">
                                <div class="position-relative d-inline-block">
                                    <button id="removeImageBtnHead" type="button"
                                        class="btn-close position-absolute top-0 start-100 translate-middle p-2"
                                        aria-label="Close" onclick="removePreviewHead()" style="display: <?= !empty($clinic['head_img']) ? 'block' : 'none'; ?>; 
                                        z-index: 10; background-color: rgba(255,255,255,0.8); border-radius: 50%;">
                                    </button>
                                    <img id="previewImageHead"
                                        src="<?= !empty($clinic['head_img']) ? 'Img/ImgClinic/' . $clinic['head_img'] : '' ?>"
                                        class="img-fluid rounded border"
                                        style="max-width: 200px; <?= empty($clinic['head_img']) ? 'display: none;' : '' ?>">
                                </div>
                            </div>
                        </div>
                        <!---------------------- ส่วนเนื้อหา ---------------------->
                        <h5 class="text-danger txt18 mt-5">ส่วนเนื้อหา</h5>
                        <div id="dynamicFields">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                            <div class="row g-3">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <h5 class="text-danger txt18 mt-3">หัวข้อเนื้อหาที่ <?= $i ?></h5>
                                    <div class="form-floating">
                                        <input type="text" name="section_<?= $i ?>"
                                            class="form-control txt16 shadow-none" placeholder="หัวข้อเนื้อหา"
                                            value="<?= $clinic['section_'.$i] ?? '' ?>">
                                        <label class="text-secondary txt16">หัวข้อเนื้อหา</label>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <h5 class="text-danger txt18 mt-3">รายละเอียดเนื้อหาที่ <?= $i ?></h5>
                                    <div class="form-floating">
                                        <textarea name="subhead_<?= $i ?>" class="form-control txt16 shadow-none"
                                            placeholder="ใส่รายละเอียดเนื้อหา"><?= $clinic['subhead_'.$i] ?? '' ?></textarea>
                                        <label class="text-secondary txt16">ใส่รายละเอียดเนื้อหา</label>
                                    </div>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>
                        <div class="text-end mt-2">
                            <button type="button" id="addField" class="btn btn-success"><i class="fas fa-plus"></i>
                                เพิ่มหัวข้อ</button>
                        </div>
                        <!---------------------- รูปภาพการรักษา ---------------------->
                        <h5 class="text-danger txt18">รูปภาพประกอบ</h5>
                        <div id="imageFields" class="row row-cols-1 row-cols-md-3 g-3">
                            <?php for ($i = 1; $i <= 3; $i++): ?>
                            <?php if (!empty($clinic['image_'.$i])): ?>
                            <div class="col-md-4 image-field" id="imageField<?= $i ?>">
                                <div class="p-2 border rounded text-center">
                                    <input type="file" class="form-control d-none image-input" id="imageFile<?= $i ?>"
                                        name="image_<?= $i ?>" onchange="updatePreview(event, <?= $i ?>)">
                                    <div id="previewContainer<?= $i ?>" class="mt-2">
                                        <img id="previewImage<?= $i ?>"
                                            src="<?= !empty($clinic['image_'.$i]) ? 'Img/ImgClinic/' . $clinic['image_'.$i] : '' ?>"
                                            class="img-fluid rounded border"
                                            style="max-width: 200px; <?= empty($clinic['image_'.$i]) ? 'display: none;' : '' ?>">
                                    </div>
                                    <div class="form-floating mt-2">
                                        <input type="text" id="imageContent<?= $i ?>" name="image_content_<?= $i ?>"
                                            class="form-control txt16 shadow-none image-content"
                                            placeholder="คำอธิบายสำหรับรูปที่ <?= $i ?>"
                                            value="<?= $clinic['image_content_'.$i] ?? '' ?>">
                                        <label class="text-secondary txt16">คำอธิบายสำหรับรูปที่ <?= $i ?></label>
                                    </div>
                                    <input type="hidden" name="delete_image_<?= $i ?>" id="delete_image_<?= $i ?>"
                                        value="0">

                                    <div class="d-flex justify-content-center align-items-center gap-2 mt-2">
                                        <label for="imageFile<?= $i ?>" class="btn btn-warning border txt12">
                                            <i class="fas fa-images"></i> เเก้ไขรูปภาพ
                                        </label>
                                        <button type="button" class="btn btn-danger btn-sm removeImage "
                                            data-id="<?= $i ?>" onclick="deleteImage(<?= $i ?>)">
                                            <i class="fa fa-trash-alt"></i> ลบ
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endfor; ?>
                            <div class="col-md-4 mb-3" id="addImageContainer">
                                <div class="p-2 border rounded text-center">
                                    <button type="button" id="addImageField" class="btn btn-success w-100">
                                        <i class="fas fa-plus"></i> เพิ่มรูปภาพ
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!---------------------- เนื้อหาการรักษา ---------------------->
                        <div class="row g-3">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <h5 class="text-danger txt18 mt-3">หมายเหตุ</h5>
                                <div class="form-floating mb-3">
                                    <input type="text" name="Trast_1" class="form-control"
                                        placeholder="หัวข้อเนื้อหาการรักษา" value="<?= $clinic['Trast_1'] ?>" required>
                                    <label class="text-secondary" for="Trast_1">หัวข้อเนื้อหาการรักษา</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <h5 class="text-danger txt18 mt-3">รายละเอียดหมายเหตุ</h5>
                                <div class="form-floating mb-3">
                                    <textarea name="subtrast_1" class="form-control "
                                        placeholder="รายละเอียดการรักษา"><?= $clinic['subtrast_1'] ?></textarea>
                                    <label for="subtrast_1" class="text-secondary">รายละเอียดการรักษา</label>
                                </div>
                            </div>
                        </div>
                        <!---------------------- สถานที่และวันให้บริการ ---------------------->
                        <div class="row g-3">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <h5 class="text-danger txt18 mt-3">สถานที่ให้บริการ</h5>
                                <div class="form-floating">
                                    <input type="text" name="location_clinic" class="form-control txt16 shadow-none"
                                        placeholder="สถานที่ตั้ง" value="<?= $clinic['location_clinic'] ?>" required>
                                    <label class="text-secondary txt16">สถานที่ให้บริการ</label>
                                    <div class="invalid-feedback">กรุณากรอกข้อมูล</div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <h5 class="text-danger txt18 mt-3">วันเวลาให้บริการ</h5>
                                <div class="form-floating">
                                    <select class="form-select txt16 shadow-none" id="openHoursSelect"
                                        name="opening_days" onchange="handleOpeningDays()">
                                        <option disabled>เลือกหรือระบุวันเวลาให้บริการ</option>
                                        <option value="ทุกวันจันทร์ - เวลา 08.00 - 16.00 น."
                                            <?= ($clinic['opening_days'] == "ทุกวันจันทร์ - เวลา 08.00 - 16.00 น.") ? 'selected' : '' ?>>
                                            ทุกวันจันทร์ - เวลา 08.00 - 16.00 น.</option>
                                        <option value="ทุกวันอังคาร - เวลา 08.00 - 16.00 น."
                                            <?= ($clinic['opening_days'] == "ทุกวันอังคาร - เวลา 08.00 - 16.00 น.") ? 'selected' : '' ?>>
                                            ทุกวันอังคาร - เวลา 08.00 - 16.00 น.</option>
                                        <option value="ทุกวันพุธ - เวลา 08.00 - 16.00 น."
                                            <?= ($clinic['opening_days'] == "ทุกวันพุธ - เวลา 08.00 - 16.00 น.") ? 'selected' : '' ?>>
                                            ทุกวันพุธ - เวลา 08.00 - 16.00 น.</option>
                                        <option value="ทุกวันพฤหัสบดี - เวลา 08.00 - 16.00 น."
                                            <?= ($clinic['opening_days'] == "ทุกวันพฤหัสบดี - เวลา 08.00 - 16.00 น.") ? 'selected' : '' ?>>
                                            ทุกวันพฤหัสบดี - เวลา 08.00 - 16.00 น.</option>
                                        <option value="ทุกวันศุกร์ - เวลา 08.00 - 16.00 น."
                                            <?= ($clinic['opening_days'] == "ทุกวันศุกร์ - เวลา 08.00 - 16.00 น.") ? 'selected' : '' ?>>
                                            ทุกวันศุกร์ - เวลา 08.00 - 16.00 น.</option>
                                        <option value="เลือกหรือระบุวันเวลาให้บริการเอง">
                                            เลือกหรือระบุวันเวลาให้บริการเอง</option>
                                    </select>
                                    <label class="text-secondary txt16"
                                        id="openHoursLabel">เลือกหรือระบุวันเวลาให้บริการ</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5 mb-3 align-items-center">
                            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                                <label class="form-label txt18 text-danger">รูปภาพสถานที่ให้บริการ</label>
                                <input type="file" class="form-control" name="location_img" accept="image/*"
                                    onchange="updatePreviewLocation(event)">
                            </div>
                            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 mt-2 mt-md-0 d-flex align-items-center"
                                id="previewContainerLocation"
                                style="display: <?= !empty($clinic['location_img']) ? 'flex' : 'none'; ?>; gap: 10px;">
                                <div class="position-relative d-inline-block">
                                    <button id="removeImageBtnLocation" type="button"
                                        class="btn-close position-absolute top-0 start-100 translate-middle p-2"
                                        aria-label="Close" onclick="removePreviewLocation()" style="display: <?= !empty($clinic['location_img']) ? 'block' : 'none'; ?>; 
                                         z-index: 10; background-color: rgba(255,255,255,0.8); border-radius: 50%;">
                                    </button>
                                    <img id="previewImageLocation"
                                        src="<?= !empty($clinic['location_img']) ? 'Img/ImgClinic/' . $clinic['location_img'] : '' ?>"
                                        class="img-fluid rounded border"
                                        style="max-width: 200px; <?= empty($clinic['location_img']) ? 'display: none;' : '' ?>">
                                </div>
                            </div>
                        </div>
                        <!---------------------- ปุ่มอัปเดต ---------------------->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">อัปเดตข้อมูล</button>
                            <a href="Admin.php?action=ManageClinic" class="btn btn-secondary">ย้อนกลับ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Javascritp -->
<script src="Admin/ManageClinic/Js/Edit.js"></script>