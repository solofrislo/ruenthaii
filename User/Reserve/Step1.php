<?php
if (isset($_SESSION["user_id"])) {
$user_id=$_SESSION["user_id"];

  $qry_data_user="SELECT * FROM user WHERE user_id ='$user_id'";
  $result_data_user = mysqli_query($dbcon,$qry_data_user);
  $row_data_user= mysqli_num_rows($result_data_user);
  if ($row_data_user > 0) {
  $row_user = mysqli_fetch_array($result_data_user,MYSQLI_ASSOC);
  $user_name_prefix= $row_user['user_name_prefix'];
  $user_fname= $row_user['user_fname'];
  $user_lname= $row_user['user_lname'];
  $user_type= $row_user['user_type'];
  $user_sex= $row_user['user_sex'];
  $user_age= $row_user['user_age'];
  $user_tel= $row_user['user_tel'];
  $user_address= $row_user['user_address'];
  $user_card_id= $row_user['user_card_id'];
  $user_congenital_disease= $row_user['user_congenital_disease'];
  $user_drug_allergy= $row_user['user_drug_allergy'];
  $user_vaccine_covid_19= $row_user['user_vaccine_covid_19'];
  $fullnameuser = $user_name_prefix.$user_fname.' '.$user_lname;
  }
}else {
  $user_name_prefix='';
  $user_fname='';
  $user_lname='';
  $user_type='';
  $user_sex='';
  $user_age='';
  $user_tel='';
  $user_address='';
  $user_card_id='';
  $user_congenital_disease='';
  $user_drug_allergy='';
  $fullnameuser ='';
  $user_vaccine_covid_19 ='';
}
 ?>

<div class="row justify-content-center pt-4">
  <div class="col-12 text-center">
    <div class="txt01 txt18 fw-bold">ข้อมูลผู้จอง</div>
  </div>
</div>
<div class="col-12 pt-4">
  <form class="needs-validation py-0" novalidate id="formstep1">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-6 col-sm-12 col-12">
        <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
          <input class="form-control txt13" id="re_prefixname" value="<?php echo $user_name_prefix; ?>" placeholder="คำนำหน้าชื่อ (ภาษาไทย)" required></input>
          <label class="text-secondary txt13"for="floatingTextarea">คำนำหน้า</label>
          <div class="invalid-feedback txt13">
            โปรดระบุคำนำหน้า
          </div>
        </div>
        <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
          <input class="form-control txt13" id="re_fname" value="<?php echo $user_fname; ?>" placeholder="ชื่อ (ภาษาไทย)" required></input>
          <label class="text-secondary txt13"for="floatingTextarea">ชื่อ</label>
          <div class="invalid-feedback txt13">
            โปรดระบุชื่อ
          </div>
        </div>
        <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
          <input class="form-control txt13" id="re_lname" value="<?php echo $user_lname; ?>" placeholder="นามสกุล (ภาษาไทย)" required></input>
          <label class="text-secondary txt13"for="floatingTextarea">นามสกุล</label>
          <div class="invalid-feedback txt13">
            โปรดระบุนามสกุล
          </div>
        </div>
        <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
          <input type="hidden" id="reidsex"value="<?php echo $user_sex; ?>"/>
          <select class="form-select txt13" id="re_usersex" aria-label="Floating label select example" required>
            <option disabled hidden class="text-secondary" value="">โปรดระบุเพศ</option>
            <option class="" value="ชาย">ชาย</option>
            <option class="" value="หญิง">หญิง</option>
          </select>
          <label for="re_usersex">เพศ</label>
          <div class="invalid-feedback txt13">
            โปรดระบุเพศ
          </div>
        </div>
        <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
          <input class="form-control txt13" id="re_userage" value="<?php echo $user_age; ?>" placeholder="อายุ (ตัวเลข 0-9)" minlength="1" maxlength="2" onkeypress="javascript:return isNumber(event)"required></input>
          <label class="text-secondary txt13"for="floatingTextarea">อายุ</label>
          <div class="invalid-feedback txt13">
            โปรดระบุอายุ
          </div>
        </div>
        <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
          <input class="form-control txt13" id="re_card_id" value="<?php echo $user_card_id; ?>" placeholder="เลขบัตรประชาชน (ตัวเลข 13 หลัก)" maxlength="13" minlength="13" required onkeypress="javascript:return isNumber(event)"></input>
          <label class="text-secondary txt13"for="floatingTextarea">เลขบัตรประชาชน</label>
          <div class="invalid-feedback txt13">
            โปรดระบุเลขบัตรประชาชน 13 หลัก
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-sm-12 col-12">
        <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
          <input class="form-control txt13" id="re_tel" value="<?php echo $user_tel; ?>" placeholder="เบอร์โทรศัพท์ (ตัวเลข 0-9)" maxlength="10" minlength="10" required onkeypress="javascript:return isNumber(event)"></input>
          <label class="text-secondary txt13"for="floatingTextarea">เบอร์โทรศัพท์</label>
          <div class="invalid-feedback txt13">
            โปรดระบุเบอร์โทรศัพท์ 10 หลัก
          </div>
        </div>
        <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
          <input type="hidden" id="recv_19"value="<?php echo $user_vaccine_covid_19; ?>"/>
          <select class="form-select txt13" id="re_usercv_19" aria-label="Floating label select example" required>
            <option disabled hidden class="text-secondary" value="">โปรดระบุประวัติการรับวัคฉีน</option>
            <option class="" value="ยังไม่ฉีด">ยังไม่ฉีด</option>
            <option class="" value="ฉีด 1 เข็ม">ฉีด 1 เข็ม</option>
            <option class="" value="ฉีด 2 เข็ม">ฉีด 2 เข็ม</option>
            <option class="" value="ฉีดมากกว่า 2 เข็ม">ฉีดมากกว่า 2 เข็ม</option>
          </select>
          <label for="re_usersex">ประวัติการรับวัคฉีน</label>
          <div class="invalid-feedback txt13">
            โปรดระบุประวัติการรับวัคฉีน
          </div>
        </div>
        <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
          <input class="form-control txt13" id="re_user_cd" value="<?php echo $user_congenital_disease; ?>" placeholder="โรคประจำตัว"></input>
          <label class="text-secondary txt13"for="floatingTextarea">โรคประจำตัว (ถ้ามี)</label>
          <div class="invalid-feedback txt13">
            โปรดระบุโรคประจำตัว
          </div>
        </div>
        <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
          <input class="form-control txt13" id="re_user_da" value="<?php echo $user_drug_allergy; ?>" placeholder="ประวัติการเเพ้ยา"></input>
          <label class="text-secondary txt13"for="floatingTextarea">ประวัติการเเพ้ยา (ถ้ามี)</label>
          <div class="invalid-feedback txt13">
            โปรดระบุประวัติการเเพ้
          </div>
        </div>
        <div class="form-floating col-xl-12 col-lg-12 col-sm-12 col-12">
          <textarea class="form-control txt13" id="re_useraddress"  placeholder="ที่อยู่ (ภาษาไทย)" style="height: 132px" required><?php echo $user_address; ?></textarea>
          <label class="text-secondary txt13"for="floatingTextarea">ที่อยู่</label>
          <div class="invalid-feedback txt13">
            โปรดระบุที่อยู่
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
