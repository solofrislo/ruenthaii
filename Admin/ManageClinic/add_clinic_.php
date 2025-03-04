<div class="container-fluid py-xl-5 py-lg-5 py-md-5 py-sm-5 py-3">
    <div class="row justify-content-center px-0">
        <div class="col-xl-12 col-12 px-2">
            <div class="card rounded-3 shadow border-0">
                <div class="card-body">
                    <form id="addClinicForm" onsubmit="event.preventDefault(); insertClinic('addClinicForm');"
                        enctype="multipart/form-data" novalidate>
                        <!-------------------------------------------- ชื่อคลินิก -------------------------------------------->
                        <h4 class="txt24 txt01 fw-bold text-center text-success ">เพิ่มข้อมูลคลินิกเฉพาะโรค</h4>
                        <hr>
                        <h5 class="text-danger txt18 mt-3">ชื่อคลินิก</h5>
                        <div class="form-floating  mb-3">
                            <input type="text" name="clinic_name" class="form-control" placeholder="ชื่อคลินิก"
                                required>
                            <label class="txt18 text-secondary">ใส่ชื่อคลินิก</label>
                        </div>
                        <!-------------------------------------------- รูปภาพหน้าปก -------------------------------------------->
                        <div class="row mt-3 mb-3 align-items-center">
                            <!-- ช่องเลือกไฟล์ (ปรับขนาดตามหน้าจอ) -->
                            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                                <label class="form-label txt18 text-danger">รูปภาพหน้าปก <i
                                        class="fa-sharp fa-solid fa-circle-exclamation text-primary fs-3"
                                        data-bs-toggle="modal" data-bs-target="#infoModal-01"
                                        style="cursor: pointer;"></i></label>
                                <p class="txt16 text-danger ">(ขนาดรูปภาพที่เหมาะสม 1470 x 800 พิกเซล)</p>
                                <input type="file" class="form-control" name="head_img" accept="image/*"
                                    onchange="updatePreviewHead(event)">
                            </div>

                            <!-- ส่วนแสดงตัวอย่างรูปภาพ (แสดงด้านข้าง ถ้าหน้าจอใหญ่) -->
                            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 mt-2 mt-md-0 d-flex align-items-center"
                                id="previewContainerHead"
                                style="display: <?= !empty($clinic['head_img']) ? 'flex' : 'none'; ?>; gap: 10px;">

                                <div class="position-relative d-inline-block mt-5">
                                    <!-- ปุ่มลบ -->
                                    <button id="removeImageBtnHead" type="button"
                                        class="btn-close position-absolute top-0 start-100 translate-middle p-2"
                                        aria-label="Close" onclick="removePreviewHead()"
                                        style="display: none; z-index: 10; background-color: rgba(255,255,255,0.8); border-radius: 50%;">
                                    </button>

                                    <?php if (!empty($clinic['head_img'])): ?>
                                    <img id="previewImageHead" src="<?= $clinic['head_img'] ?>"
                                        class="img-fluid rounded border" style="max-width: 150px; position: relative;">
                                    <?php else: ?>
                                    <img id="previewImageHead" class="img-fluid rounded border"
                                        style="max-width: 150px; display: none; position: relative;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-------------------------------------------- ส่วนเนื้อหา -------------------------------------------->
                        <div id="dynamicFields">
                            <div class="row g-3 mb-3">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <h5 class="text-danger txt18 mt-3">หัวข้อเนื้อหา</h5>
                                    <div class="form-floating">
                                        <input type="text" name="section_1" class="form-control txt16 shadow-none"
                                            placeholder="ใส่ข้อมูลหัวข้อ" required>
                                        <label class="text-secondary txt16">ใส่ข้อมูลหัวข้อเนื้อหา</label>
                                        <div class="invalid-feedback">กรุณากรอกข้อมูล</div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <h5 class="text-danger txt18 mt-3">รายละเอียดเนื้อหา</h5>
                                    <div class="form-floating">
                                        <textarea name="subhead_1" class="form-control txt16 shadow-none"
                                            placeholder="ใส่รายละเอียดเนื้อหา"></textarea>
                                        <label class="text-secondary txt16">ใส่รายละเอียดเนื้อหา</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="button" id="addField" class="btn btn-success"><i class="fas fa-plus"></i>
                                เพิ่มหัวข้อ</button>
                        </div>

                        <!-------------------------------------------- รูปภาพการรักษา -------------------------------------------->
                        <h5 class="text-danger txt18 mt-3">รูปภาพประกอบ
                            <i class="fa-sharp fa-solid fa-circle-exclamation text-primary fs-3" data-bs-toggle="modal"
                                data-bs-target="#infoModal-02" style="cursor: pointer;"></i>
                        </h5>
                        <div id="imageFields" class="row row-cols-1 row-cols-md-3 g-3"></div>

                        <div class="text-end mt-3">
                            <button type="button" id="addImageField" class="btn btn-success mt-2">
                                <i class="fas fa-plus"></i> เพิ่มรูปภาพ
                            </button>
                        </div>
                        <!-------------------------------------------- เนื้อหาการรักษา -------------------------------------------->
                        <div class="row g-3">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <h5 class="text-danger txt18 mt-3">หมายเหตุ</h5>
                                <div class="form-floating mb-3">
                                    <input type="text" name="Trast_1" class="form-control" id="trast1"
                                        placeholder="ใส่หัวข้อหมายเหตุ" required>
                                    <label for="trast1" class="text-secondary">ใส่หัวข้อหมายเหตุ</label>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <h5 class="text-danger txt18 mt-3">รายละเอียดหมายเหตุ</h5>
                                <div class="form-floating mb-3">
                                    <textarea name="subtrast_1" class="form-control" id="subtrast1"
                                        placeholder="ใส่รายละเอียดหมายเหตุ"></textarea>
                                    <label for="subtrast1" class="text-secondary">ใส่รายละเอียดหมายเหตุ</label>
                                </div>
                            </div>
                        </div>

                        <!-------------------------------------------- สถานที่ให้บริการ - วันให้บริการ -------------------------------------------->
                        <div class="row g-3">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <h5 class="text-danger txt18 mt-3">สถานที่ให้บริการ</h5>
                                <div class="form-floating">
                                    <input type="text" name="location_clinic" class="form-control txt16 shadow-none"
                                        placeholder="สถานที่ให้บริการเช่น ตึก , อาคาร , ชั้นที่" required>
                                    <label class="text-secondary txt16">สถานที่ให้บริการเช่น ตึก , อาคาร , ชั้นที่</label>
                                    <div class="invalid-feedback">กรุณากรอกข้อมูล</div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <h5 class="text-danger txt18 mt-3">วันเวลาให้บริการ</h5>
                                <div class="form-floating">
                                    <select class="form-select txt16 shadow-none" id="openHoursSelect"
                                        name="opening_days" onchange="handleOpeningDays()"
                                        aria-label="วันเวลาให้บริการ">
                                        <option selected disabled>เลือกหรือระบุวันเวลาให้บริการ</option>
                                        <option value="ทุกวันจันทร์ - เวลา 08.00 - 16.00 น.">ทุกวันจันทร์ - เวลา 08.00 -
                                            16.00 น.</option>
                                        <option value="ทุกวันอังคาร - เวลา 08.00 - 16.00 น.">ทุกวันอังคาร - เวลา 08.00 -
                                            16.00 น.</option>
                                        <option value="ทุกวันพุธ - เวลา 08.00 - 16.00 น.">ทุกวันพุธ - เวลา 08.00 - 16.00
                                            น.</option>
                                        <option value="ทุกวันพฤหัสบดี - เวลา 08.00 - 16.00 น.">ทุกวันพฤหัสบดี - เวลา
                                            08.00 - 16.00 น.</option>
                                        <option value="ทุกวันศุกร์ - เวลา 08.00 - 16.00 น.">ทุกวันศุกร์ - เวลา 08.00 -
                                            16.00 น.</option>
                                        <option value="เลือกหรือระบุวันเวลาให้บริการเอง">
                                            เลือกหรือระบุวันเวลาให้บริการเอง...</option>
                                    </select>
                                    <label class="text-secondary txt16">เลือกหรือระบุวันเวลาให้บริการ</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 mb-3 align-items-center">
                            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                                <label class="form-label txt18 text-danger">รูปภาพสถานที่ให้บริการ <i
                                        class="fa-sharp fa-solid fa-circle-exclamation text-primary fs-3"
                                        data-bs-toggle="modal" data-bs-target="#infoModal-03"
                                        style="cursor: pointer;"></i></label>
                                <input type="file" class="form-control" name="location_img" accept="image/*"
                                    onchange="updatePreviewLocation(event)">
                            </div>
                            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 mt-2 mt-md-0 d-flex align-items-center"
                                id="previewContainerLocation"
                                style="display: <?= !empty($clinic['location_img']) ? 'flex' : 'none'; ?>; gap: 10px;">

                                <div class="position-relative d-inline-block mt-3">
                                    <!-- ปุ่มลบ -->
                                    <button id="removeImageBtnLocation" type="button"
                                        class="btn-close position-absolute top-0 start-100 translate-middle p-2"
                                        aria-label="Close" onclick="removePreviewLocation()"
                                        style="display: none; z-index: 10; background-color: rgba(255,255,255,0.8); border-radius: 50%;">
                                    </button>

                                    <?php if (!empty($clinic['location_img'])): ?>
                                    <img id="previewImageLocation" src="<?= $clinic['location_img'] ?>"
                                        class="img-fluid rounded border" style="max-width: 150px; position: relative;">
                                    <?php else: ?>
                                    <img id="previewImageLocation" class="img-fluid rounded border"
                                        style="max-width: 150px; display: none; position: relative;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                        <!-------------------------------------------- ปุ่มส่งฟอร์ม -------------------------------------------->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">บันทึก</button>
                            <a href="Admin.php?action=ManageClinic" class="btn btn-secondary">ย้อนกลับ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
#removeImageBtn {
    z-index: 10;
    /* ทำให้ปุ่มอยู่ด้านหน้ารูป */
    background-color: rgba(255, 255, 255, 0.8);
    /* ให้มีพื้นหลังสีขาวโปร่งใสเล็กน้อย */
    border-radius: 50%;
    /* ทำให้เป็นวงกลม */
    padding: 5px;
    /* ขยายพื้นที่ปุ่มให้กดง่ายขึ้น */
}
</style>
<!-- Javascirpt_new -->
<script src="Admin/ManageClinic/Js/Insert1.js"></script>

<!-- Modal Image_head -->
<div class="modal fade" id="infoModal-01" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="infoModalLabel"><i class="fa fa-info-circle"></i> รูปภาพตัวอย่าง
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="Img/imgClinic/Picture_1.png" alt="Sample Image" class="img-fluid rounded w-100">
            </div>
        </div>
    </div>
</div>
<!-- Modal Image_trast -->
<div class="modal fade" id="infoModal-02" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="infoModalLabel"><i class="fa fa-info-circle"></i> รูปภาพตัวอย่าง
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="Img/imgClinic/Picture_2.png" alt="Sample Image" class="img-fluid rounded w-100">
            </div>
        </div>
    </div>
</div>
<!-- Modal Image-location -->
<div class="modal fade" id="infoModal-03" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="infoModalLabel"><i class="fa fa-info-circle"></i> รูปภาพตัวอย่าง
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="Img/imgClinic/Picture_3.png" alt="Sample Image" class="img-fluid rounded w-100">
            </div>
        </div>
    </div>
</div>