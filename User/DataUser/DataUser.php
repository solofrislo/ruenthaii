<?php

$user_id=$_SESSION["user_id"];

$qry_data_user="SELECT * FROM user WHERE user_id ='$user_id'";
$result_data_user = mysqli_query($dbcon,$qry_data_user);
$row_data_user = mysqli_num_rows($result_data_user);
if ($row_data_user > 0) {
$row_user = mysqli_fetch_array($result_data_user,MYSQLI_ASSOC);
$eddbus_userid= $row_user['user_id'];
$eddbus_prefixname= $row_user['user_name_prefix'];
$eddbus_fname= $row_user['user_fname'];
$eddbus_lname= $row_user['user_lname'];
$eddbus_userage= $row_user['user_age'];
$eddbus_usersex= $row_user['user_sex'];
$eddbus_card_id= $row_user['user_card_id'];
$eddbus_tel= $row_user['user_tel'];
$eddbus_useraddress= $row_user['user_address'];
$user_congenital_disease= $row_user['user_congenital_disease'];
$user_drug_allergy= $row_user['user_drug_allergy'];
$user_vaccine_covid_19= $row_user['user_vaccine_covid_19'];
if ($user_congenital_disease =='') {
  $user_congenital_disease='-';
}
if ($user_drug_allergy =='') {
  $user_drug_allergy='-';
}
}
 ?>

<div class="container-fluid">
  <div class="row justify-content-center py-xl-5 py-lg-5 py-sm-5 py-3">
    <div class="col-xl-6 col-lg-8 col-12 text-center">
      <div class="card border-0 bg-transparent">
        <div class="card-body">
          <div class="col-12 text-center">
            <img src="Img/ImgWeb/user.png" class="img-fluid" style="height:80px;width:80px">
            <!-- <i class="fas fa-user"></i> -->
          </div>
          <div class="txt18 fw-bold txt01 text-center pb-3 pt-1">ข้อมูลผู้ใช้งาน</div>
          <form class="needs-validation" novalidate id="formdatauseredit">
            <div class="row justify-content-center">
              <div class="col-xl-6 col-lg-6 col-sm-6 col-12">
                <div class="row justify-content-center">
                  <input type="hidden" id="eddbus_userid" value="<?php echo $eddbus_userid; ?>"/>
                  <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <input class="form-control removedisabled txt13 shadow-none" id="eddbus_prefixname" value="<?php echo $eddbus_prefixname; ?>" placeholder="คำนำหน้าชื่อ (ภาษาไทย)" required disabled></input>
                    <label class="text-secondary ps-4"for="floatingTextarea">คำนำหน้า</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุคำนำหน้า
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <input class="form-control removedisabled txt13 shadow-none" id="eddbus_fname" value="<?php echo $eddbus_fname; ?>" placeholder="ชื่อ (ภาษาไทย)" required disabled></input>
                    <label class="text-secondary ps-4"for="floatingTextarea">ชื่อ</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุชื่อ
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <input class="form-control removedisabled txt13 shadow-none" id="eddbus_lname" value="<?php echo $eddbus_lname; ?>" placeholder="นามสกุล (ภาษาไทย)" required disabled></input>
                    <label class="text-secondary ps-4"for="floatingTextarea">นามสกุล</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุนามสกุล
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-6">
                    <input class="form-control removedisabled txt13 shadow-none" id="eddbus_userage" value="<?php echo $eddbus_userage; ?>" placeholder="อายุ (ตัวเลข 0-9)" minlength="1" maxlength="2" onkeypress="javascript:return isNumber(event)"required disabled></input>
                    <label class="text-secondary ps-4"for="floatingTextarea">อายุ</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุอายุ
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-6">
                    <input type="hidden" class="txt13" id="getidsex"value="<?php echo $eddbus_usersex; ?>"/>
                    <select class="form-select removedisabled txt13 shadow-none" id="eddbus_usersex" aria-label="Floating label select example" required disabled>
                      <option disabled class="text-secondary" id="sexstart"value="">โปรดระบุเพศ</option>
                      <option class="" value="ชาย">ชาย</option>
                      <option class="" value="หญิง">หญิง</option>
                    </select>
                    <label class="text-secondary ps-4" for="floatingSelect">เพศ</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุเพศ
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <input class="form-control removedisabled txt13 shadow-none" id="eddbus_card_id" value="<?php echo $eddbus_card_id; ?>" placeholder="เลขบัตรประชาชน (ตัวเลข 13 หลัก)" maxlength="13" minlength="13" required onkeypress="javascript:return isNumber(event)" disabled></input>
                    <label class="text-secondary ps-4"for="floatingTextarea">เลขบัตรประชาชน</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุเลขบัตรประชาชน 13 หลัก
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-sm-6 col-12">
                <div class="row justify-content-center">
                  <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <input type="hidden" id="geteddbuscv_19"value="<?php echo $user_vaccine_covid_19; ?>"/>
                    <select class="form-select removedisabled txt13 shadow-none" id="eddbuscv_19" aria-label="Floating label select example" required disabled>
                      <option disabled hidden class="text-secondary" value="">โปรดระบุประวัติการรับวัคฉีน</option>
                      <option class="" value="ยังไม่ฉีด">ยังไม่ฉีด</option>
                      <option class="" value="ฉีด 1 เข็ม">ฉีด 1 เข็ม</option>
                      <option class="" value="ฉีด 2 เข็ม">ฉีด 2 เข็ม</option>
                      <option class="" value="ฉีดมากกว่า 2 เข็ม">ฉีดมากกว่า 2 เข็ม</option>
                    </select>
                    <label class="text-secondary ps-4" for="re_usersex">ประวัติการรับวัคฉีน</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุประวัติการรับวัคฉีน
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <input class="form-control removedisabled txt13 shadow-none" id="eddbus_tel" value="<?php echo $eddbus_tel; ?>" placeholder="เบอร์โทรศัพท์ (ตัวเลข 0-9)" maxlength="10" minlength="10" required onkeypress="javascript:return isNumber(event)" disabled></input>
                    <label class="text-secondary ps-4"for="floatingTextarea">เบอร์โทรศัพท์</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุเบอร์โทรศัพท์ 10 หลัก
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <input class="form-control removedisabled txt13 shadow-none" id="eddbus_cd" value="<?php echo $user_congenital_disease; ?>" placeholder="." required disabled>
                    <label class="text-secondary ps-4"for="floatingTextarea">โรคประจำตัว</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุโรคประจำตัว
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <input class="form-control removedisabled txt13 shadow-none" id="eddbus_da" value="<?php echo $user_drug_allergy; ?>" placeholder="." required disabled>
                    <label class="text-secondary ps-4"for="floatingTextarea">ประวัติการแพ้ยา</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุประวัติการแพ้ยา
                    </div>
                  </div>
                  <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <textarea class="form-control removedisabled txt13 shadow-none" id="eddbus_useraddress" placeholder="ที่อยู่ (ภาษาไทย)" style="height:132px" required disabled><?php echo $eddbus_useraddress; ?></textarea>
                    <label class="text-secondary ps-4"for="floatingTextarea">ที่อยู่</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุที่อยู่
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 text-end">
                <button type="button" class="btn btn-danger col-auto shadow-none txt13" onclick="btncancleeduser()" id="cancleeduser">ยกเลิก</button>
                <button type="button" class="btn btn-warning col-auto shadow-none text-white txt13" onclick="btneddatausershow()" id="eddatausershow"><i class="fas fa-edit"></i> แก้ไข</button>
                <button type="button" class="btn btn-success col-auto shadow-none txt13" data-bs-toggle="modal" data-bs-target="#confirmedituser" id="eddatausershowsubmit" onclick="modalformdatauseredit()">บันทึก</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="User/DataUser/DataUserjs.js"></script>
