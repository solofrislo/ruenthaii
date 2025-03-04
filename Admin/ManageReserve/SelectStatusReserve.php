<?php
require_once '../../Connect.php';

$date_current = date('Y-m-d');
if (!isset($_POST['search'])) { //ไม่มีค่าค้นหาส่งมา
  if (!isset($_POST['status'])) { //ไม่มีค่ามา status ส่งมา
    $qry_statusreserve = "SELECT * FROM reserve WHERE reserve_status = 'รอการอนุมัติ' ORDER BY reserve_date ASC";
    $date_show_not_found = 0;
  }else { //มีค่า status ส่งมา
    $status = $_POST['status'];
    if ($status == 4) {
      $qry_statusreserve = "SELECT * FROM reserve WHERE reserve_status = 'อนุมัติแล้ว' AND reserve_date > '$date_current' ORDER BY reserve_date ASC";
      $date_show_not_found = 1;
    }elseif ($status == 3) { //ถ้าค่า status เท่ากับ 3
      $qry_statusreserve = "SELECT * FROM reserve ORDER BY reserve_date DESC";
      $date_show_not_found = 1;
    }elseif ($status == 2){//ถ้าค่า status เท่ากับค่าว่าง
      $qry_statusreserve = "SELECT * FROM reserve WHERE reserve_status = 'ไม่ได้รับบริการ' ORDER BY reserve_date ASC";
      $date_show_not_found = 1;
    }elseif ($status == 1) {
      $qry_statusreserve = "SELECT * FROM reserve WHERE reserve_status = 'อนุมัติแล้ว' AND reserve_date < '$date_current' ORDER BY reserve_date ASC";
      $date_show_not_found = 1;
    }elseif ($status == 0){//ถ้าค่า status เท่ากับค่าว่าง
      $qry_statusreserve = "SELECT * FROM reserve WHERE reserve_status = 'รอการอนุมัติ' ORDER BY reserve_date ASC";
      $date_show_not_found = 1;
    }
  }
}elseif (isset($_POST['search'])) { //มีค่าค้นหาส่งมา
  $search = $_POST['search'];
  if ($search !=='') { //มีค่าไม่เท่ากับค่าว่าง
    $search = mysqli_real_escape_string($dbcon, $search);
    $qry_statusreserve = "SELECT * FROM reserve WHERE CONCAT_WS('',reserve_prefixname, reserve_fname, reserve_lname,
    reserve_card_id, reserve_tel, reserve_age, reserve_sex, reserve_address, reserve_stm, reserve_date, reserve_time,
    reserve_status, reserve_congenital_disease, reserve_drug_allergy, reserve_vaccine_covid_19)
    LIKE '%".$search."%' ORDER BY reserve_id DESC LIMIT 10";
    $date_show_not_found = 1;
  }else { //มีค่าเท่ากับค่าว่าง
    $qry_statusreserve = "SELECT * FROM reserve WHERE reserve_status = 'รอการอนุมัติ'  ORDER BY reserve_date ASC";
    $date_show_not_found = 0;
  }
}


$result_statusreserve = mysqli_query($dbcon,$qry_statusreserve);
$row_result_statusreserve = mysqli_num_rows($result_statusreserve);
if ($row_result_statusreserve > 0) {
  $cnt_number = 1;
  $cnt_color = 0;
  while ($row_statusreserve = mysqli_fetch_array($result_statusreserve,MYSQLI_ASSOC)) {
    $reserve_id = $row_statusreserve['reserve_id'];
    $reserve_prefixname = $row_statusreserve['reserve_prefixname'];
    $reserve_fname = $row_statusreserve['reserve_fname'];
    $reserve_lname = $row_statusreserve['reserve_lname'];
    $reserve_card_id = $row_statusreserve['reserve_card_id'];
    $reserve_tel = $row_statusreserve['reserve_tel'];
    $reserve_age = $row_statusreserve['reserve_age'];
    $reserve_sex = $row_statusreserve['reserve_sex'];
    $reserve_address = $row_statusreserve['reserve_address'];
    $reserve_stm = $row_statusreserve['reserve_stm'];
    $reserve_date = $row_statusreserve['reserve_date'];
    $date = date_create($reserve_date);
    $d = date_format($date,"d");
    $m = date_format($date,"m");
    $Y = date_format($date,"Y")+543;
    $reserve_date_show = $d.'/'.$m.'/'.$Y;
    $reserve_time = $row_statusreserve['reserve_time'];
    $reserve_status = $row_statusreserve['reserve_status'];
    $reserve_congenital_disease = $row_statusreserve['reserve_congenital_disease'];
    $reserve_drug_allergy = $row_statusreserve['reserve_drug_allergy'];
    $reserve_vaccine_covid_19 = $row_statusreserve['reserve_vaccine_covid_19'];
    $user_id = $row_statusreserve['user_id'];
    $fullname = $reserve_prefixname.$reserve_fname.' '.$reserve_lname;

    // $reserve_dateshow = date_create($reserve_date);
    // $reserve_dateshow = date_format($reserve_dateshow,"d/m/Y");
    if ($reserve_drug_allergy =='') {
      $reserve_drug_allergy_show ='-';
    }else {
      $reserve_drug_allergy_show = $reserve_drug_allergy;
    }

    if ($reserve_congenital_disease =='') {
      $reserve_congenital_disease_show ='-';
    }else {
      $reserve_congenital_disease_show = $reserve_congenital_disease ;
    }

    if (fmod($cnt_color,2) == 0 || fmod($cnt_color,2) == NAN) {
          $bgre = 'background-color:#ffffff;';
        }else {
          $bgre = 'background-color:#eeeeee;';
        }

    if ($reserve_status == 'รอการอนุมัติ') {
      $reserve_statusshow ='<span class="text-white bg-warning rounded-pill px-2 txt13">รอการอนุมัติ</span>';
      $reserve_statusshow_modal ='รอการอนุมัติ';
      $reserve_statusshow_mb ='<div class="bg-warning rounded-circle txt13" style="height:20px; width:20px;"></div>';
    }elseif ($reserve_status == 'อนุมัติแล้ว') {
      if ($reserve_date <$date_current) {
        $reserve_statusshow ='<span class="text-white bg-primary rounded-pill px-2 txt13">รับบริการเเล้ว</span>';
        $reserve_statusshow_mb ='<div class="bg-primary rounded-circle txt13" style="height:20px; width:20px;"></div>';
      }else {
        $reserve_statusshow ='<span class="text-white bg-success rounded-pill px-2 txt13">อนุมัติแล้ว</span>';
        $reserve_statusshow_mb ='<div class="bg-success rounded-circle txt13" style="height:20px; width:20px;"></div>';
      }
      $reserve_statusshow_modal ='อนุมัติแล้ว';
    }elseif ($reserve_status == 'ไม่ได้รับบริการ') {
      $reserve_statusshow ='<span class="text-white bg-danger rounded-pill px-2 txt13">ไม่ได้รับบริการ</span>';
      $reserve_statusshow_modal ='ไม่ได้รับบริการ';
      $reserve_statusshow_mb ='<div class="bg-danger rounded-circle txt13" style="height:20px; width:20px;"></div>';
    }

    echo '
          <div class="row justify-content-center">
            <div class="col border-s py-1 d-none d-xl-block d-lg-block d-md-none d-sm-block" style="'.$bgre.'">
              <div class="txt13">
                '.$reserve_card_id.'
              </div>
            </div>
            <div class="col border-y py-1 d-none d-xl-block d-lg-block d-md-block d-sm-block" style="'.$bgre.'">
              <div class="txt13">
                '.$fullname.'
              </div>
            </div>
            <div class="col border-y py-1" style="'.$bgre.'">
              <div class="txt13">
                '.$reserve_date_show.'
              </div>
            </div>
            <div class="col border-y py-1" style="'.$bgre.'">
              <div class="txt13">
                '.$reserve_time.' น.
              </div>
            </div>
            <div class="col-3 border-y py-1 d-none d-xl-block d-lg-block d-md-block d-sm-block" style="'.$bgre.'">
              <div class="txt13">
                '.$reserve_stm.'
              </div>
            </div>
            <div class="col border-y text-center py-1 d-none d-xl-block d-lg-block d-md-none d-sm-none" style="'.$bgre.'">
              <div class="txt13">
                '.$reserve_statusshow.'
              </div>
            </div>
            <div class="col border-y text-center py-1 d-block d-xl-none d-lg-none d-md-block d-sm-block" style="'.$bgre.'">
              <center>
                <div class="txt13">
                  '.$reserve_statusshow_mb.'
                </div>
              </center>
            </div>
            <div class="col border-e text-center py-1" style="'.$bgre.'">
              <button class="btn btn-primary p-1 shadow-none" data-bs-toggle="modal" data-bs-target="#modalshowdatareserve'.$reserve_id.'"><i class="fa fa-eye" aria-hidden="true"></i></button>
              <button class="btn bg-warning text-white py-1 px-2 shadow-none" onclick="modaleditdatareserve('.$reserve_id.')"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>
            </div>
          </div>
    ';
    //modal แสดงข้อมูลการจอง
    echo '
          <div class="modal fade" id="modalshowdatareserve'.$reserve_id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
              <div class="modal-content border-0">
              <div class="bg-primary py-1">
                <h5 class="fw-bold text-white text-center">ข้อมูลการจอง</h5>
              </div>
                  <div class="card-body">
                    <div class="row mb-3 px-2">
                      <div class="col-6">
                        <span class="txt13">ชื่อ - นามสกุล :</span>
                        <p class="card-text txt13 text-secondary">'.$fullname.'</p>
                        <span class="txt13">เพศ :</span>
                        <p class="card-text txt13 text-secondary">'.$reserve_sex.'</p>
                        <span class="txt13">อายุ :</span>
                        <p class="card-text txt13 text-secondary">'.$reserve_age.' ปี</p>
                        <span class="txt13">เลขบัตรประชาชน :</span>
                        <p class="card-text txt13 text-secondary">'.$reserve_card_id.'</p>
                        <span class="txt13">เบอร์โทรศัพท์ :</span>
                        <p class="card-text txt13 text-secondary"><a href="tel:'.$reserve_tel.'"class="text-decoration-none text-dark"><i class="fa fa-phone" aria-hidden="true"></i> '.$reserve_tel.'</a></p>
                        <span class="txt13">ประวัติการรับวัคซีน :</span>
                        <p class="card-text txt13 text-secondary">'.$reserve_vaccine_covid_19.'</p>
                        <span class="txt13">โรคประจำตัว :</span>
                        <p class="card-text txt13 text-secondary">'.$reserve_congenital_disease_show.'</p>
                      </div>

                      <div class="col-6">
                        <span class="txt13">ประวัติการเเพ้ยา :</span>
                        <p class="card-text txt13 text-secondary">'.$reserve_drug_allergy_show.'</p>
                        <span class="txt13">ที่อยู่ :</span>
                        <p class="card-text txt13 text-secondary">'.$reserve_address.'</p>
                        <span class="txt13">อาการ :</span>
                        <p class="card-text txt13 text-secondary">'.$reserve_stm.'</p>
                        <span class="txt13">วันที่ :</span>
                        <p class="card-text txt13 text-secondary">'.$reserve_date_show.'</p>
                        <span class="txt13">เวลา :</span>
                        <p class="card-text txt13 text-secondary">'.$reserve_time.' น.</p>
                        <span class="txt13">สถานะคำขอจองคิว :</span>
                        <p class="card-text txt13 text-secondary">'.$reserve_statusshow_modal.'</p>
                      </div>

                    </div>
                    <div class="text-end modal-footer">
                      <button class="btn btn-light border border-2 shadow-none txt13txt13" data-bs-toggle="modal" data-bs-dismiss="modal">ปิด</button>
                    </div>
              </div>
              </div>
            </div>
          </div>
    ';
    echo '
          <div class="modal fade" id="modaleditdatareserve'.$reserve_id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
              <div class="modal-content border-0">
                <div class="bg-warning py-1">
                  <h5 class="fw-bold text-white text-center">จัดการคำขอจองคิว</h5>
                </div>
                <div class="modal-body my-0 py-0">
                  <form class="needs-validation" id="formeditreserve'.$reserve_id.'" novalidate>
                    <div class="row justify-content-center py-0 my-0">
                      <div class="col-6 px-2">
                        <div class="card border-0 py-0 my-0">
                          <div class="card-body">
                            <div class="txt11 text-secondary mt-2">ชื่อ - นามสกุล</div>
                            <div class="txt13">'.$fullname.'</div>
                            <div class="txt11 text-secondary mt-2">วันที่จอง</div>
                            <input type="date" class="form-control txt13 col-12 shadow-none" value="'.$reserve_date.'" id="dateupdatereserve'.$reserve_id.'"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-6 px-2">
                        <div class="card border-0 py-0 my-0">
                          <div class="card-body">
                            <div class="txt11 text-secondary mt-2">เบอร์โทรศัพท์</div>
                            <a href="Tel:'.$reserve_tel.'"class="txt13 text-decoration-none text-dark"><i class="fas fa-phone-alt"></i> โทร : '.$reserve_tel.'</a>
                            <div class="txt11 text-secondary mt-2">เวลา</div>
                            <input type="time" class="form-control txt13 col-12 shadow-none" value="'.$reserve_time.'" id="timeupdatereserve'.$reserve_id.'"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 text-center mb-3 px-4">
                        <div class="form-floating">
                          <input type="hidden" name="" id="reserve_id'.$reserve_id.'" value="'.$reserve_id.'">
                          <input type="hidden" name="" id="getidstatus'.$reserve_id.'" value="'.$reserve_status.'">
                          <select class="form-select shadow-none txt13" id="re_edit_status'.$reserve_id.'" aria-label="Floating label select example" required>
                            <option class="txt13" value="รอการอนุมัติ">รอการอนุมัติ</option>
                            <option class="txt13" value="อนุมัติแล้ว">อนุมัติแล้ว</option>
                            <option class="txt13" value="ไม่ได้รับบริการ">ไม่ได้รับบริการ</option>
                          </select>
                          <label class="txt13" for="floatingSelect">คำขอจองคิว</label>
                          <div class="invalid-feedback txt13">
                            โปรดตอบกลับคำขอจองคิว
                          </div>
                        </div>
                      </div>
                    </div>
                  </from>
                </div>
                <div class="modal-footer">
                  <button type="button"class="btn btn-success text-white border border-2 shadow-none txt13" onclick="formeditreserve('.$reserve_id.')">ยืนยัน</button>
                  <button type="button"class="btn btn-light border border-2 shadow-none txt13" data-bs-toggle="modal" data-bs-dismiss="modal">ปิด</button>
                </div>
              </div>
            </div>
            </div>
    ';
    $cnt_number++;
    $cnt_color++;
  }
}else {
  if ($date_show_not_found == 0) {
    echo '
          <div class="row justify-content-center">
            <div class="col-12 text-center py-3">
              <div class="h6 text-danger mt-3">ไม่พบข้อมูลการจองคิวรักษาใหม่</div>
              <div class="txt12 text-secondary mb-4">
              </div>
              <img src="Img/ImgWeb/2808164.png" class="col-xl-4 col-lg-5 col-sm-10 col-11"/>
            </div>
          </div>
    ';
  }elseif ($date_show_not_found == 1) {
    echo '
          <div class="row justify-content-center">
            <div class="col-12 text-center py-3">
              <div class="h6 text-danger mt-3">ไม่พบข้อมูลการจองคิวรักษา</div>
              <div class="txt12 text-secondary mb-4">
                ดูเหมือนว่าคุณจะไม่พบข้อมูลการจอง ลองใช้ข้อมูลส่วนตัวของผู้จอง<br>สำหรับในการค้นหาครั้งต่อไป " โปรดลองอีกครั้ง "
              </div>
              <img src="Img/ImgWeb/2808164.png" class="col-xl-4 col-lg-5 col-sm-10 col-11"/>
            </div>
          </div>
    ';
  }
}

 ?>
