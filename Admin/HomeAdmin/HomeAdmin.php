<?php
$qry_num_user= "SELECT * FROM user";
$result_num_user = mysqli_query($dbcon,$qry_num_user);
$row_num_user = mysqli_num_rows($result_num_user);
$total_num_row_user = $row_num_user;
 ?>

<?php
$date_current = date('Y-m-d');
$qry_statusreserve = "SELECT * FROM reserve WHERE reserve_status = 'อนุมัติแล้ว' AND reserve_date > '$date_current'";
$result_num_statusreserve = mysqli_query($dbcon,$qry_statusreserve);
$row_num_statusreserve= mysqli_num_rows($result_num_statusreserve);
$total_num_row_statusreserve = $row_num_statusreserve;
 ?>
<div class="container-fluid">
  <div class="row justify-content-center mb-1 mt-3">
    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-10 col-12">
      <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-12 col-sm-10 col-12">
          <center>
            <img class="mb-3 imgrota"src="Img/ImgWeb/logo002.png" height="50" width="auto"/>
            <div class="text-dark h5">ยินดีต้อนรับ</div>
            <div class="text-dark h5">เข้าสู่ระบบจัดการของ " <span class="txt01">คลินิกการแพทย์แผนไทย</span> "</div>
          </center>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-10 col-12">
          <div class="py-1 ">
            <center>
              <div class="txt01 txt14">ระบบจัดการหลังบ้านเว็บไซต์ คลินิกการแพทย์แผนไทย</div>
              <div class="txt01 txt14">จัดการข้อมูลข่าวสาร ข้อมูลการประชาสัมพันธ์ ข้อมูลการจองคิวรักษา และการจัดการข้อมูลผู้ใช้งานต่าง ๆ</div>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center mb-4">
    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-4 col-sm-4 col-12 mt-3 d-flex align-items-stretch">
          <div class="card border-0 shadow">
            <div class="card-header text-white gradient3 PY-1 txt13">
              ผู้ใช้งาน
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <img src="Img/ImgWeb/5234.png" width="100%"/>
                </div>
                <div class="col-6 text-end txt01">
                  <span class="h2"><?php echo $total_num_row_user;?></span><br />
                  <span class="txt13">รายการ</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-sm-4 col-12 mt-3 d-flex align-items-stretch">
          <div class="card border-0 shadow">
            <div class="card-header text-white gradient3 PY-1 txt13">
              คำขอจองคิวใหม่
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <img src="Img/ImgWeb/212365798987452.png" width="75%"/>
                </div>
                <div class="col-6 text-end txt01">
                  <span class="h2"><?php require 'Admin/ManageReserve/SelectStReMg.php'; ?></span><br />
                  <span class="txt13">รายการ</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-sm-4 col-12 mt-3 d-flex align-items-stretch">
          <div class="card border-0 shadow">
            <div class="card-header text-white gradient3 PY-1 txt13">
              รอเข้ารับบริการ
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <img src="Img/ImgWeb/4122437.png" class="col-8"width="100%"/>
                </div>
                <div class="col-6 text-end txt01">
                  <span class="h2"><?php echo $total_num_row_statusreserve;?></span><br />
                  <span class="txt13">รายการ</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center mb-2">
    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-10 col-12">
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-7 col-sm-7 col-12">
          <div class="py-1">
            <center>
            <img src="Img/ImgWeb/3568983.png" width="100%"/>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row justify-content-center ">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-10 col-12">
      <div class="row">
        <div class="col">
          <center>
            <img src="Img/ImgWeb/logo002.png" height="30" width="auto"/> <span class="txt01 txt16">คลินิกการเเพทย์แผนไทย</span><br />
            <span class="txt13">คลินิกการเเพทย์แผนไทย สายด่วน </span><a href="tel:044235972"class="text-decoration-none txt13 txt-a-dark" type="button">044-235972</a> <span class="txt13">(เรือนไทย)</span><br />
            <span class="txt13">หรือ </span><a href="tel:044232240"class="text-decoration-none txt13 txt-a-dark" type="button">044-232240</a> <span class="txt13">(ตึกผู้ป่วยนอกชั้น 4)</span><br />
            <span class="txt13">© 2022 Copyright by Kasidit Katcharoen</span>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>
