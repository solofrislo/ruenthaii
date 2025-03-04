
<div class="container-fluid py-xl-5 py-lg-5 py-sm-5 py-2">
  <div class="row justify-content-center">
    <div class="col-xl-8 col-12">
      <center>
        <img src="Img/ImgWeb/2428645278545.png" class="img-fulid col-xl-5 col-lg-5 col-sm-6 col-11">
      </center>
      <div class="txt18 fw-bold txt01 text-center pt-3">
        ประวัติการจอง
      </div>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-xl-8 col-lg-9 col-sm-11 col-12 py-0 px-0">
      <div class="row justify-content-center px-4">
        <div class="col border-0 bg02 py-1">
          <div class="text-white txt13">
            วันที่
          </div>
        </div>
        <div class="col border-0 bg02 py-1">
          <div class="text-white txt13">
            เวลา
          </div>
        </div>
        <div class="col border-0 bg02 py-1 d-none d-xl-block d-lg-block d-md-block d-sm-block">
          <div class="text-white txt13">
            อาการ
          </div>
        </div>
        <div class="col border-0 bg02 py-1 d-none d-xl-block d-lg-none d-md-none d-sm-none">
          <div class="text-white txt13">
            ประวัติการรับวัคฉีน Covid-19
          </div>
        </div>
        <div class="col border-0 bg02 py-1">
          <div class="text-white txt13">
            สถานะ
          </div>
        </div>
      </div>



      <?php
      $date_current = date('Y-m-d');
      if (isset($_SESSION["user_id"])) {

        $user_id=$_SESSION["user_id"];
        $qry_history_re_user="SELECT * FROM reserve WHERE user_id ='$user_id' ORDER BY reserve_id DESC";
        $result_history_re_user = mysqli_query($dbcon,$qry_history_re_user);
        $row_history_re_user= mysqli_num_rows($result_history_re_user);
        if ($row_history_re_user > 0) {
          $cnt_color = 0;
          while ($row_history_re_user = mysqli_fetch_array($result_history_re_user,MYSQLI_ASSOC)) {
              $reserve_id = $row_history_re_user['reserve_id'];
              $reserve_prefixname = $row_history_re_user['reserve_prefixname'];
              $reserve_fname = $row_history_re_user['reserve_fname'];
              $reserve_lname = $row_history_re_user['reserve_lname'];
              $reserve_card_id = $row_history_re_user['reserve_card_id'];
              $reserve_tel = $row_history_re_user['reserve_tel'];
              $reserve_age = $row_history_re_user['reserve_age'];
              $reserve_sex = $row_history_re_user['reserve_sex'];
              $reserve_address = $row_history_re_user['reserve_address'];
              $reserve_stm = $row_history_re_user['reserve_stm'];
              $reserve_date = $row_history_re_user['reserve_date'];
              $reserve_time = $row_history_re_user['reserve_time'];
              $reserve_status = $row_history_re_user['reserve_status'];
              $reserve_congenital_disease = $row_history_re_user['reserve_congenital_disease'];
              $reserve_drug_allergy = $row_history_re_user['reserve_drug_allergy'];
              $reserve_vaccine_covid_19 = $row_history_re_user['reserve_vaccine_covid_19'];
              $user_id = $row_history_re_user['user_id'];

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

              // if ($reserve_status=='รอการอนุมัติ') {
              //   $reserve_status_clr= '<div class="text-warning">รอการอนุมัติ</div>';
              // }elseif ($reserve_status=='อนุมัติแล้ว') {
              //   $reserve_status_clr= '<div class="text-success">อนุมัติแล้ว</div>';
              // }elseif ($reserve_status=='ไม่ได้รับบริการ') {
              //   $reserve_status_clr= '<div class="text-danger">ไม่ได้รับบริการ</div>';
              // }

              if (fmod($cnt_color,2) == 0 || fmod($cnt_color,2) == NAN) {
                    $bg_hi_re = 'style="background-color:#ffffff;"';
                  }else {
                    $bg_hi_re = 'style="background-color:#f5f5f5;"';
                    //$bg_hi_re = 'style="background-color:#fce4ec;"';
                  }

              $reserve_date = date_create($reserve_date);
              $reserve_date = date_format($reserve_date,"d/m/Y");

              echo '
                    <div class="row justify-content-center px-4">
                      <div class="col border-s py-1" '.$bg_hi_re.'>
                        <div class="txt13">
                          '.$reserve_date.'
                        </div>
                      </div>
                      <div class="col border-y py-1 " '.$bg_hi_re.'>
                        <div class="txt13">
                          '.$reserve_time.'
                        </div>
                      </div>
                      <div class="col border-y py-1 d-none d-xl-block d-lg-block d-md-block d-sm-block" '.$bg_hi_re.'>
                        <div class="txt13">
                          '.$reserve_stm.'
                        </div>
                      </div>
                      <div class="col border-y py-1 d-none d-xl-block d-lg-none d-md-none d-sm-none" '.$bg_hi_re.'>
                        <div class="txt13">
                          '.$reserve_vaccine_covid_19.' น.
                        </div>
                      </div>
                      <div class="col border-e py-1 d-block d-xl-block d-lg-block d-md-block d-sm-block" '.$bg_hi_re.'>
                        <div class="txt13">
                          '.$reserve_statusshow.'
                        </div>
                      </div>

                    </div>
              ';
              $cnt_color++;
          }
        }else {
          echo '<div class="row justify-content-center px-4">
                  <div class="col-12 text-center py-5 border border-1 bg-white">
                    <div class="txt13 text-secondary">ไม่พบข้อมูลประวัติรายการจองคิวรักษา เลือกทำรายการจอง <br /> คลิกเลย  <a class="text-decoration-none shadow-none btn bg02 text-white mt-2 p-1 zoom txt12" href="Index.php?action=Reserve"><i class="fas fa-clipboard-list"></i> จองคิวรักษา</a></div>
                  </div>
                </div>
                ';
        }
      }else {
        // echo 'error';
      }

       ?>
       </div>
     </div>
   </div>
  </div>
</div>
