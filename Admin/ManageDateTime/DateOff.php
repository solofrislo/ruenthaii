<div id="dateoff">
  <div class="text-center txt01 txt18 fw-bold">จัดการวัน - เวลา</div>
  <div class="text-start txt01 h6 fw-bold mt-3">รายการวันหยุด</div>
  <?php
  $month_arr=array(
        "1"=>"ม.ค.",
        "2"=>"ก.พ.",
        "3"=>"มี.ค.",
        "4"=>"เม.ย.",
        "5"=>"พ.ค.",
        "6"=>"มิ.ย.",
        "7"=>"ก.ค.",
        "8"=>"ส.ค.",
        "9"=>"ก.ย.",
        "10"=>"ต.ค.",
        "11"=>"พ.ย.",
        "12"=>"ธ.ค."
    );
$DDay = array(
          '1'=>'จันทร์',
          '2'=>'อังคาร',
          '3'=>'พุธ',
          '4'=>'พฤหัสบดี',
          '5'=>'ศุกร์',
          '6'=>'เสาร์',
          '7'=>'อาทิตย์'
      );
$datechdateoff = date("Y-m-d");
    $qry_show_dateoff="SELECT * FROM dateoff WHERE dateoff_date > '$datechdateoff' ORDER BY dateoff_date ASC";
    $result_show_dateoff = mysqli_query($dbcon,$qry_show_dateoff);
    $row_show_dateoff = mysqli_num_rows($result_show_dateoff);
    if ($row_show_dateoff > 0) {
      while ($row_dateoff = mysqli_fetch_array($result_show_dateoff,MYSQLI_ASSOC)) {
        $dateoff_id = $row_dateoff['dateoff_id'];
        $dateoff_date = $row_dateoff['dateoff_date'];
        $dateoff_comment = $row_dateoff['dateoff_comment'];

          $date = date_create($dateoff_date);
          $dateM = date_format($date,"n");
          $dateY = date_format($date,"Y")+543;
          $dateD = date_format($date,"d");
          $dateDD = date_format($date,"N");
          $dates = $DDay[$dateDD].', '.$dateD.' '.$month_arr[$dateM].' '.$dateY;
        echo '
        <input type="hidden" value="'.$dates.'" id="dateoffshowcancel'.$dateoff_id.'"/>
        <div class="card my-1">
            <div class="card-body py-2">
              <div class="row ">
                <div class="col-auto my-auto me-auto text-secondary">
                '.$dates.'
                </div>
                <div class="col-auto text-secondary">
                  <button type="button" class="btn btn-light border shadow-none py-1 px-2" data-bs-toggle="tooltip" data-bs-placement="top"
                  title="'.$dateoff_comment.'">หมายเหตุ</button>
                  <button type="button" class="btn btn-danger shadow-none py-1 px-2" onclick="btndeletedateoff('.$dateoff_id.')">ยกเลิก</button>
                </div>
              </div>
            </div>
          </div>
          ';
      }
    }else {
      echo '
      <div class="col-12">
        <div class="row justify-content-center mt-4">
          <div class="col-12 text-center">
          <div class="card">
            <div class="card-body" style="margin-top:9%; margin-bottom:9%;">
              <div class="txt01 txt14">
              ไม่พบรายการวันหยุด
              </div>
              <div class="txt12 text-secondary">
              คุณสามารถกำหนดวันหยุดเองได้ เช่น วันหยุดนักขัตฤกษ์ <br>วันจัดอบรม เป็นตัน
              </div>
            </div>
            </div>
          </div>
          <div class="col-xl-12 col-lg-11 col-sm-11 col-12 mt-4">
            <img src="Img/ImgWeb/2660490.png" class="col-12"/>
          </div>
        </div>
      </div>
      ';
    }

   ?>
</div>
