<?php require 'Connect.php'; ?>
<div class="container-fluid">
  <div class="row justify-content-center mt-3">
    <div class="col-12 d-flex align-items-stretch">
      <div class="card col-12 border bg02 shadow py-0">
        <div class="card-body py-0">
          <div class="row justify-content-start">
            <div class="col-xl-auto col-lg-auto col-md-auto col-sm-auto col-auto my-auto pe-2 d-none d-xl-block d-lg-block d-md-none d-sm-none">
              <i class="fas fa-search text-white"></i>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-sm-auto col-6 px-1 my-1">
              <select class="form-select shadow-none txt13 changesearchreport" id="sexsearchreport">
                <option hidden>เลือกเพศ</option>
                <option value="reserve_sex ='ชาย'">ชาย</option>
                <option value="reserve_sex ='หญิง'">หญิง</option>
                <option value="reserve_sex = reserve_sex">เพศทั้งหมด</option>
              </select>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-sm-auto col-6 px-1 my-1">
              <select class="form-select shadow-none txt13 changesearchreport" id="agesearchreport">
                <option hidden>เลือกอายุ</option>
                <option value="reserve_age < '20'">ต่ำกว่า 20 ปี</option>
                <option value="reserve_age >= '20' AND reserve_age <= '30'">20-30 ปี</option>
                <option value="reserve_age >= '31' AND reserve_age <= '40'">31-40 ปี</option>
                <option value="reserve_age >= '41' AND reserve_age <= '50'">41-50 ปี</option>
                <option value="reserve_age > '50'">มากกว่า 50 ปี</option>
                <option value="reserve_age = reserve_age">อายุทั้งหมด</option>
              </select>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-sm-auto col-6 px-1 my-1">
              <select class="form-select shadow-none txt13 changesearchreport" id="stmsearchreport">
                <option hidden>เลือกอาการ</option>
                <option value="reserve_stm LIKE'%ปวดคอ บ่า ไหล%'">ปวดคอ บ่า ไหล่</option>
                <option value="reserve_stm LIKE'%ปวดหลัง%'">ปวดหลัง</option>
                <option value="reserve_stm LIKE'%ปวดแขน%'">ปวดแขน</option>
                <option value="reserve_stm LIKE'%ปวดสะโพก%'">ปวดสะโพก</option>
                <option value="reserve_stm LIKE'%ไหล่ติด%'">ไหล่ติด</option>
                <option value="reserve_stm LIKE'%ปวดขา%'">ปวดขา</option>
                <option value="reserve_stm LIKE'%ปวดเข่า%'">ปวดเข่า</option>
                <option value="reserve_stm LIKE'%ปวดเท้า/รองช้ำ%'">ปวดเท้า/รองช้ำ</option>
                <option value="reserve_stm LIKE'%อัมพฤกษ์ อัมพาต%'">อัมพฤกษ์ อัมพาต</option>
                <option value="reserve_stm LIKE'%ปวดเข่า%'">ปวดเข่า</option>
                <option value="reserve_stm_other !=''">อาการอื่น ๆ</option>
                <option value="reserve_stm = reserve_stm">อาการทั้งหมด</option>
              </select>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-sm-auto col-6 px-1 my-1">
              <select class="form-select shadow-none txt13 changesearchreport" id="daysearchreport">
                <option hidden>เลือกวันที่</option>
                <?php
                $cnt_day = 1;
                while ($cnt_day <= 31) {
                  echo '<option value="DAY (reserve_date) = '.$cnt_day.'">วันที่ '.$cnt_day.'</option>';
                  $cnt_day++;
                }
                ?>
                <option value="reserve_date = reserve_date">วันที่ทั้งหมด</option>
              </select>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-sm-auto col-6 px-1 my-1">
              <select class="form-select shadow-none txt13 changesearchreport" id="monthsearchreport">
                <option hidden>เลือกเดือน</option>
                <?php
                $cnt_name_month = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
                $cnt_num_month = array('01','02','03','04','05','06','07','08','09','10','11','12');
                array_map(function($cnt_num_month,$cnt_name_month){
                  echo '<option value="MONTH(reserve_date)='.$cnt_num_month.'">'.$cnt_name_month.'</option>';
                },$cnt_num_month,$cnt_name_month);
                ?>
                <option value="reserve_date = reserve_date">เดือนทั้งหมด</option>
              </select>
            </div>
            <div class="col-xl-auto col-lg-auto col-md-auto col-sm-auto col-6 px-1 my-1">
              <select class="form-select shadow-none txt13 changesearchreport" id="yearsearchreport">
                <option hidden>เลือกปี</option>
                <?php
                $qry_get_date = "SELECT * FROM reserve";
                $result_get_date = mysqli_query($dbcon,$qry_get_date);
                $row_cnt_date = mysqli_num_rows($result_get_date);
                if ($row_cnt_date > 0) {
                  $datearray = array();
                  while ($row_date = mysqli_fetch_array($result_get_date,MYSQLI_ASSOC)) {
                    $date = date_create($row_date['reserve_date']);
                    $qrydate = date_format($date,"Y");
                    $datearray[] = $qrydate;
                  }
                  $unique = array_unique($datearray);
                  foreach($unique as $year){
                    echo '<option value="YEAR(reserve_date) = '.$year.'">'.$numyear = (int)$year+(543).'</option>';
                  }
                }
                ?>
                <option value="reserve_date = reserve_date">ปีทั้งหมด</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center mt-3">
    <div class="col-12 d-flex align-items-stretch">
      <div class="card col-12 border shadow">
        <div class="card-body">
          <?php
          $date_current = date('Y-m-d');

          $qry_reerve_all = "SELECT * FROM reserve";
          $result_reerve_all = mysqli_query($dbcon,$qry_reerve_all);
          $row_reerve_all = mysqli_num_rows($result_reerve_all);
          $cnt_row_reerve_all = $row_reerve_all;

          $qry_reerve_status1 = "SELECT * FROM reserve WHERE reserve_status ='รอการอนุมัติ'";
          $result_reerve_status1 = mysqli_query($dbcon,$qry_reerve_status1);
          $row_reerve_status1 = mysqli_num_rows($result_reerve_status1);
          $cnt_row_reerve_status1 = $row_reerve_status1;

          $qry_reerve_status2 = "SELECT * FROM reserve WHERE reserve_status ='อนุมัติแล้ว' AND reserve_date >= '$date_current'";
          $result_reerve_status2 = mysqli_query($dbcon,$qry_reerve_status2);
          $row_reerve_status2 = mysqli_num_rows($result_reerve_status2);
          $cnt_row_reerve_status2 = $row_reerve_status2;

          $qry_reerve_status2_1 = "SELECT * FROM reserve WHERE reserve_status ='อนุมัติแล้ว' AND reserve_date < '$date_current'";
          $result_reerve_status2_1 = mysqli_query($dbcon,$qry_reerve_status2_1);
          $row_reerve_status2_1 = mysqli_num_rows($result_reerve_status2_1);
          $cnt_row_reerve_status2_1 = $row_reerve_status2_1;

          $qry_reerve_status3 = "SELECT * FROM reserve WHERE reserve_status ='ไม่ได้รับบริการ'";
          $result_reerve_status3 = mysqli_query($dbcon,$qry_reerve_status3);
          $row_reerve_status3 = mysqli_num_rows($result_reerve_status3);
          $cnt_row_reerve_status3 = $row_reerve_status3;

           ?>
          <div class="row justify-content-start">
            <div class="col-auto me-auto">
              <span class="text-secondary txt13 fw-bold">รายละเอียด</span><br />
              <span class="text-secondary txt13">รายการจองคิวทั้งหมด <span id="cnt_row_reerve_all"><?php echo $cnt_row_reerve_all;?></span> ครั้ง</span><br />
              <span class="text-secondary txt13">รายการรอการอนุมัติ <span id="cnt_row_reerve_status1"><?php echo $cnt_row_reerve_status1;?></span> ครั้ง</span><br />
              <span class="text-secondary txt13">รายการอนุมัติเเล้ว <span id="cnt_row_reerve_status2"><?php echo $cnt_row_reerve_status2;?></span> ครั้ง</span><br />
              <span class="text-secondary txt13">รายการรับบริการเเล้ว <span id="cnt_row_reerve_status2_1"><?php echo $cnt_row_reerve_status2_1;?></span> ครั้ง</span><br />
              <span class="text-secondary txt13">รายการไม่ได้รับบริการ <span id="cnt_row_reerve_status3"><?php echo $cnt_row_reerve_status3;?></span> ครั้ง</span><br />
            </div>
            <div class="col-auto my-auto">
              <button type="button" class="btn btn-danger shadow-none py-1 px-2 txt13 " onclick="downloadrepostPDFall()"><i class="fas fa-file-pdf"></i> ดาวน์โหลด PDF</button>
              <div class="txt11 mt-1 pe-4">
                ดาวน์โหลด PDF ทั้งหมด
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center mt-3" id="apexchartsearchallshow">
    <div class="col-xl-6 col-12 d-flex align-items-stretch">
      <div class="card col-12 border shadow">
        <div class="card-body">
          <div id="apexchartsearchall"></div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 col-12 d-flex align-items-stretch">
      <div class="card col-12 border shadow">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <span class="text-dark fw-bold txt13">รายละเอียดข้อมูล</span><br />
              <span class="text-secondary txt13">ค้นหาจาก</span><span class="text-secondary txt13" id="dtreportall"></span><br />
              <span class="text-secondary txt13">- ข้อมูลที่พบ <span class="txt13"id="dt_report_cnt_success"></span> ครั้ง</span><br />
              <span class="text-secondary txt13">- ข้อมูลส่วนต่าง <span class="txt13"id="dt_report_cnt_unsuccess"></span> ครั้ง</span><br />
            </div>
            <div class="col-12 text-center mt-4">
              <div class="card col-12 py-4">
                <div class="card-body">
                  <button type="button" class="btn btn-danger shadow-none py-1 px-2 txt13 " onclick="downloadrepostPDFsearch()"><i class="fas fa-file-pdf"></i> ดาวน์โหลด PDF</button>
                  <div class="txt11 mt-1">
                    ดาวน์โหลด PDF ที่ค้นหา
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center mt-3">
    <div class="col-xl-6 col-12 d-flex align-items-stretch">
      <div class="card col-12 border shadow">
        <div class="card-body">
          <div id="apexchartsex"></div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 col-12 d-flex align-items-stretch">
      <div class="card col-12 border shadow">
        <div class="card-body">
          <div class="row justify-contnet-center">
            <span class="fw-bold txt13 mb-2">ข้อมูลเพศ</span><br />
            <div class="col-6">
              <span class="txt12 text-secondary">ชาย <span id="chartsex_male"></span> ครั้ง</span><br />
            </div>
            <div class="col-6">
              <span class="txt12 text-secondary">หญิง <span id="chartsex_female"></span> ครั้ง</span><br />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center my-3">
    <div class="col-xl-6 col-12 d-flex align-items-stretch">
      <div class="card border shadow col-12">
        <div class="card-body">
          <div id="apexchartage"></div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 col-12 d-flex align-items-stretch">
      <div class="card border shadow col-12">
        <div class="card-body">
          <div class="row justify-contnet-center">
            <span class="fw-bold txt13 mb-2">ข้อมูลอายุ</span><br />
            <div class="col-6">
              <span class="txt12 text-secondary">ต่ำกว่า 20 ปี <span id="chart_age1"></span> ครั้ง</span><br />
              <span class="txt12 text-secondary">20-30 ปี <span id="chart_age2"></span> ครั้ง</span><br />
              <span class="txt12 text-secondary">31-40 ปี <span id="chart_age3"></span> ครั้ง</span><br />
            </div>
            <div class="col-6">
              <span class="txt12 text-secondary">41-50 ปี <span id="chart_age4"></span> ครั้ง</span><br />
              <span class="txt12 text-secondary">มากกว่า 50 ปี <span id="chart_age5"></span> ครั้ง</span><br />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center mt-3">
    <div class="col-xl-6 col-12 d-flex align-items-stretch">
      <div class="card border shadow col-12">
        <div class="card-body">
          <div id="apexchartstm"></div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 col-12 d-flex align-items-stretch">
      <div class="card border shadow col-12">
        <div class="card-body">
          <div class="row justify-content-center">
            <span class="fw-bold txt13 mb-2 col-6">ข้อมูลอาการ</span>
            <span class="fw-bold txt13 mb-2 col-6">อาการอื่น ๆ</span>
            <div class="col-6">
              <span class="txt12 text-secondary">ปวดคอ บ่า ไหล่ <span id="chart_stm1"></span> ครั้ง</span><br />
              <span class="txt12 text-secondary">ปวดหลัง <span id="chart_stm2"></span> ครั้ง</span><br />
              <span class="txt12 text-secondary">ปวดแขน <span id="chart_stm3"></span> ครั้ง</span><br />
              <span class="txt12 text-secondary">ปวดสะโพก <span id="chart_stm4"></span> ครั้ง</span><br />
              <span class="txt12 text-secondary">ไหล่ติด <span id="chart_stm5"></span> ครั้ง</span><br />
              <span class="txt12 text-secondary">ปวดขา <span id="chart_stm6"></span> ครั้ง</span><br />
              <span class="txt12 text-secondary">ปวดเข่า <span id="chart_stm7"></span> ครั้ง</span><br />
              <span class="txt12 text-secondary">ปวดเท้า/รองช้ำ <span id="chart_stm8"></span> ครั้ง</span><br />
              <span class="txt12 text-secondary">อัมพฤกษ์ อัมพาต <span id="chart_stm9"></span> ครั้ง</span><br />
            </div>
            <div class="col-6">
              <span class="txt13 text-secondary">อาการอื่น ๆ <span id="chart_stm10"></span> ครั้ง</span><br />
              <span id="chart_stm10detailsshow" class="txt13 text-secondary">รายละเอียดอาการอื่น ๆ : <span id="chart_stm10details">
                <?php
                $stm_array_other = array();
                $stm_arrays_other = '' ;
                $qry_report_stm_other = "SELECT * FROM reserve WHERE reserve_stm_other !='' ";
                $result_report_stm_other = mysqli_query($dbcon,$qry_report_stm_other);
                $row_report_stm_other = mysqli_num_rows($result_report_stm_other);
                if ($row_report_stm_other > 0) {
                  while ($row_stm_other = mysqli_fetch_array($result_report_stm_other,MYSQLI_ASSOC)) {
                    $stm_array_other[] = $row_stm_other['reserve_stm_other'];
                  }
                  $unique = array_unique($stm_array_other);
                  $stmtarray = array();
                  foreach($unique as $shstmt){
                    $stmtarray[] = $shstmt;
                  }
                  echo $stm_arrays_other =  implode(", ", $stmtarray);
                }else {
                  $stm_arrays_other = '' ;
                }
                  ?>
                </span>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- ..................................................................................................... -->
<div class="container-fluid">
  <div class="row justify-content-center pb-4">
    <div class="col-12 hiddenchartPDF" id="apexchartsearchallshowPDF">
      <div id="apexchartsearchallPDF" style="Width:100%"></div>
      <div id="apexchartsexPDF" style="Width:100%"></div>
      <div id="apexchartstmPDF" style="Width:100%"></div>
      <div id="apexchartagePDF" style="Width:100%"></div>
    </div>
  </div>
</div>



<script src="Admin/ManageReport/Imgjs.js"></script>
<script src="Admin/ManageReport/ManageReportjs.js"></script>
<script src="Admin/ManageReport/ManageReportjsPDF.js"></script>
