<?php
if (isset($_POST['search'])) {
  require '../../Connect.php';
$search = $_POST['search'];
$search = mysqli_real_escape_string($dbcon, $search);
  $qry_user = "SELECT * FROM user WHERE CONCAT_WS('', user_name_prefix, user_fname, user_lname, user_sex, user_age, user_card_id,
  user_tel, user_address, user_type, user_allow, user_congenital_disease, user_drug_allergy, user_vaccine_covid_19) LIKE '%".$search."%' ORDER BY user_id DESC LIMIT 10";
}else{
  require 'Connect.php';
  $qry_user = "SELECT * FROM user ORDER BY user_id DESC LIMIT 20";
};
  $result_user = mysqli_query($dbcon,$qry_user);
  $row_user = mysqli_num_rows($result_user);
  if ($row_user > 0) {

    $cnt_color = 0;
      while ($row_user = mysqli_fetch_array($result_user,MYSQLI_ASSOC)) {
        $user_id = $row_user['user_id'];
        $user_fname = $row_user['user_fname'];
        $user_lname = $row_user['user_lname'];
        $user_sex = $row_user['user_sex'];
        $user_age = $row_user['user_age'];
        $user_tel = $row_user['user_tel'];
        $user_name_prefix = $row_user['user_name_prefix'];
        $user_card_id = $row_user['user_card_id'];
        $user_type = $row_user['user_type'];
        $user_address = $row_user['user_address'];
        $user_allow = $row_user['user_allow'];
        $user_congenital_disease= $row_user['user_congenital_disease'];
        $user_drug_allergy= $row_user['user_drug_allergy'];
        $user_vaccine_covid_19= $row_user['user_vaccine_covid_19'];
        $fullname = $user_name_prefix.$user_fname.' '.$user_lname;

        if (fmod($cnt_color,2) == 0 || fmod($cnt_color,2) == NAN) {
              $bguser = 'background-color:#ffffff;';
            }else {
              $bguser = 'background-color:#eeeeee;';
            }

        if ($user_age =='') {
            $user_age='-';
        }

        if ($user_address=='') {
            $user_address='-';
        }

        if ($user_congenital_disease =='') {
          $user_congenital_disease='-';
        }
        if ($user_drug_allergy =='') {
          $user_drug_allergy ='-';
        }

        if ($user_allow == 'ไม่อนุญาต') {
          $user_allowshow = '<span class="text-danger"><i class="fa fa-lock" aria-hidden="true"></i> ไม่อนุญาต</span>';
        } elseif ($user_allow == 'อนุญาต') {
          $user_allowshow = '<span class="text-success"><i class="fa fa-unlock" aria-hidden="true"></i> อนุญาต</span>';
        }

        echo '

            <div class="row justify-content-center">
              <div class="col py-1 border-s d-none d-xl-block d-lg-block d-md-block d-sm-block" style="'.$bguser.'">
                <div class="txt13 text-dark">'.$user_card_id.'</div>
              </div>
              <div class="col py-1 border-y" style="'.$bguser.'">
                <div class="txt13 text-dark">'.$fullname.'</div>
              </div>
              <div class="col py-1 border-y d-none d-xl-block d-lg-block d-md-block d-sm-none" style="'.$bguser.'">
                <div class="txt13 text-dark">'.$user_tel.'</div>
              </div>
              <div class="col py-1 border-y d-none d-xl-block d-lg-block d-md-none d-sm-none" style="'.$bguser.'">
                <div class="txt13 text-dark">'.$user_type.'</div>
              </div>
              <div class="col py-1 border-y text-center" style="'.$bguser.'">
                <div class="txt13 text-dark">'.$user_allowshow.'</div>
              </div>
              <div class="col-xl-2 col-lg-2 col-sm-3 col-4 py-1 border-e text-center" style="'.$bguser.'">
                <button class="btn btn-primary p-1 shadow-none" data-bs-toggle="modal" data-bs-target="#showuser'.$user_id.'"><i class="fa fa-eye" aria-hidden="true"></i></button>
                <button class="btn bg-warning text-white p-1 shadow-none" onclick="showmodaledituser('.$user_id.')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
              </div>
            </div>
        ';

        echo '
        <div class="modal fade" id="showuser'.$user_id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
            <div class="bg-primary py-1">
              <h5 class="fw-bold text-white text-center " id="staticBackdropLabel">ข้อมูลผู้ใช้งาน</h5>
            </div>
                <div class="card-body">
                  <div class="row mb-3">
                    <div class="col-6">
                      <span class=" txt13">ชื่อ - นามสกุล :</span>
                      <p class="card-text txt13 text-secondary">'.$user_name_prefix.$fullname.'</p>
                      <span class=" txt13">อายุ :</span>
                      <p class="card-text txt13 text-secondary">'.$user_age.' ปี</p>
                      <span class=" txt13">เพศ :</span>
                      <p class="card-text txt13 text-secondary">'.$user_sex.'</p>
                      <span class=" txt13">เลขบัตรประชาชน :</span>
                      <p class="card-text txt13 text-secondary">'.$user_card_id.'</p>
                      <span class=" txt13">เบอร์โทรศัพท์ :</span>
                      <p class="card-text txt13 text-secondary"><a href="tel:'.$user_tel.'"class="text-decoration-none"><i class="fa fa-phone" aria-hidden="true"></i> '.$user_tel.'</a></p>
                      <span class=" txt13">ประวัติการรับวัคซีน :</span>
                      <p class="card-text txt13 text-secondary">'.$user_vaccine_covid_19.'</p>
                    </div>
                    <div class="col-6">
                      <span class=" txt13">โรคประจำตัว :</span>
                      <p class="card-text txt13 text-secondary">'.$user_congenital_disease.'</p>
                      <span class=" txt13">ประวัติการเเพ้ยา :</span>
                      <p class="card-text txt13 text-secondary">'.$user_drug_allergy.'</p>
                      <span class=" txt13">ที่อยู่ :</span>
                      <p class="card-text txt13 text-secondary">'.$user_address.'</p>
                      <span class=" txt13">ประเภทผู้ใช้งาน :</span>
                      <p class="card-text txt13 text-secondary">'.$user_type.'</p>
                      <span class=" txt13">การอนุญาตการใช้งาน :</span>
                      <p class="card-text txt13 text-secondary">'.$user_allow.'</p>
                    </div>
                  </div>
                  <div class="text-end modal-footer">
                    <a href="#" class="btn btn-light border border-2 txt13 shadow-none" data-bs-toggle="modal" data-bs-dismiss="modal">ปิด</a>
                  </div>
            </div>
            </div>
          </div>
        </div>
        ';
      echo '
      <div class="modal fade" id="edituser'.$user_id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content border-0">
          <div class="bg-warning py-1">
            <h5 class="modal-title fw-bold text-white text-center mb-3" id="staticBackdropLabel">แก้ไขข้อมูลผู้ใช้งาน</h5>
          </div>
            <div class="modal-body">
            <form class="needs-validation" novalidate id="formEditusermodal'.$user_id.'">
              <div class="row">
                <div class="col-md">
                  <div class="form-floating mb-3">
                    <input class="form-control txt13 shadow-none" id="ed_prefixname'.$user_id.'" value="'.$user_name_prefix.'" placeholder="คำนำหน้า (ภาษาไทย)" required></input>
                    <label class="text-secondary txt13"for="floatingTextarea">คำนำหน้า</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุคำนำหน้า
                    </div>
                  </div>

                  <div class="form-floating mb-3">
                    <input class="form-control txt13 shadow-none" id="ed_fname'.$user_id.'" value="'.$user_fname.'" placeholder="ชื่อ (ภาษาไทย)" required></input>
                    <label class="text-secondary txt13"for="floatingTextarea">ชื่อ</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุชื่อ
                    </div>
                  </div>

                  <div class="form-floating mb-3">
                    <input class="form-control txt13 shadow-none" id="ed_lname'.$user_id.'" value="'.$user_lname.'" placeholder="นามสกุล (ภาษาไทย)" required></input>
                    <label class="text-secondary txt13"for="floatingTextarea">นามสกุล</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุนามสกุล
                    </div>
                  </div>

                  <div class="form-floating mb-3">
                    <input class="form-control txt13 shadow-none" id="ed_card_id'.$user_id.'" value="'.$user_card_id.'" placeholder="เลขบัตรประชาชน (ตัวเลข 13 หลัก)" maxlength="13" minlength="13" required onkeypress="javascript:return isNumber(event)"required></input>
                    <label class="text-secondary txt13"for="floatingTextarea">เลขบัตรประชาชน</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบเลขบัตรประชาชน
                    </div>
                  </div>

                  <div class="form-floating mb-3">
                    <input class="form-control txt13 shadow-none" id="ed_tel'.$user_id.'" value="'.$user_tel.'" placeholder="เบอร์โทรศัพท์ (ตัวเลข 0-9)" maxlength="10" minlength="10" required onkeypress="javascript:return isNumber(event)"required></input>
                    <label class="text-secondary txt13"for="floatingTextarea">เบอร์โทรศัพท์</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุเเบอร์โทรศัพท์
                    </div>
                  </div>

                  <div class="form-floating mb-3">
                    <input class="form-control txt13 shadow-none" id="ed_userage'.$user_id.'" value="'.$user_age.'" placeholder="อายุ (ตัวเลข 0-9)" minlength="1" maxlength="2" onkeypress="javascript:return isNumber(event)" required></input>
                    <label class="text-secondary txt13"for="floatingTextarea">อายุ</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุอายุ
                    </div>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="hidden" id="getidsex'.$user_id.'"value="'.$user_sex.'"/>
                    <select class="form-select txt13 shadow-none" id="ed_usersex'.$user_id.'" aria-label="Floating label select example" required>
                      <option disabled hidden class="text-secondary txt13" value="">โปรดระบุเพศ</option>
                      <option class=" txt13" value="ชาย">ชาย</option>
                      <option class=" txt13" value="หญิง">หญิง</option>
                    </select>
                    <label for="floatingSelect txt13">เพศ</label>
                  </div>

                </div>
                <div class="col-md">

                  <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
                    <input type="hidden" id="getidvaccine'.$user_id.'"value="'.$user_vaccine_covid_19.'"/>
                    <select class="form-select txt13 shadow-none" id="ed_vaccine'.$user_id.'" aria-label="Floating label select example" required>
                      <option disabled hidden class="text-secondary txt13" value="">โปรดระบุประวัติการรับวัคซีน Covid-19</option>
                      <option class=" txt13" value="ยังไม่ฉีด">ยังไม่ฉีด</option>
                      <option class=" txt13" value="ฉีด 1 เข็ม">ฉีด 1 เข็ม</option>
                      <option class=" txt13" value="ฉีด 2 เข็ม">ฉีด 2 เข็ม</option>
                      <option class=" txt13" value="ฉีดมากกว่า 2 เข็ม">ฉีดมากกว่า 2 เข็ม</option>
                    </select>
                    <label class="txt13" for="floatingSelect">ประวัติการรับวัคซีน Covid-19</label>
                  </div>

                  <div class="form-floating mb-3">
                    <input  class="form-control txt13 shadow-none" id="ed_user_cd'.$user_id.'" value="'.$user_congenital_disease.'" placeholder="โรคประจำตัว (ภาษาไทย)">
                    <label class="text-secondary txt13"for="floatingTextarea">โรคประจำตัว</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุโรคประจำตัว
                    </div>
                  </div>

                  <div class="form-floating mb-3">
                    <input  class="form-control txt13 shadow-none" id="ed_user_da'.$user_id.'" value="'.$user_drug_allergy.'" placeholder="ประวัติการเเพ้ยา (ภาษาไทย)">
                    <label class="text-secondary txt13"for="floatingTextarea">ประวัติการเเพ้ยา</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุประวัติการเเพ้ยา
                    </div>
                  </div>

                  <div class="form-floating mb-3">
                    <textarea class="form-control txt13 shadow-none" id="ed_useraddress'.$user_id.'" placeholder="ที่อยู่ (ภาษาไทย)" style="height:125px;"required>'.$user_address.'</textarea>
                    <label class="text-secondary txt13"for="floatingTextarea">ที่อยู่</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุที่อยู่
                    </div>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="hidden" id="getidtype'.$user_id.'"value="'.$user_type.'"/>
                    <select class="form-select txt13 shadow-none" id="ed_typeuser'.$user_id.'" aria-label="Floating label select example" required>
                      <option disabled hidden class="text-secondary txt13" value="">โปรดระบุประเภทผู้ใช้งาน</option>
                      <option class=" txt13" value="ผู้ใช้งานทั่วไป">ผู้ใช้งานทั่วไป</option>
                      <option class=" txt13" value="ผู้ดูแลระบบ">ผู้ดูแลระบบ</option>
                    </select>
                    <label class="txt13" for="floatingSelect">ประเภทผู้ใช้งาน</label>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="hidden" id="getidallow'.$user_id.'"value="'.$user_allow.'"/>
                    <select class="form-select txt13 shadow-none" id="ed_allow'.$user_id.'" aria-label="Floating label select example" required>
                      <option disabled hidden class="text-secondary txt13" value="">โปรดระบุการอนุญาตการใช้งาน</option>
                      <option class=" txt13" value="ไม่อนุญาต">ไม่อนุญาต</option>
                      <option class=" txt13" value="อนุญาต">อนุญาต</option>
                    </select>
                    <label class="txt13" for="floatingSelect">การอนุญาตการใช้งาน</label>
                  </div>

                </div>
                </div>
                <div class="modal-footer">
                  <button onclick="formEditusermodal('.$user_id.')" type="button"class="btn btn-success text-white txt13 shadow-none">ยืนยัน</button>
                  <a href="#" class="btn btn-light border border-2 txt13 shadow-none" data-bs-toggle="modal" data-bs-dismiss="modal">ยกเลิก</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      ';
      $cnt_color++;
  }
}else{
  echo '
        <div class="row justify-content-center">
          <div class="col-12 text-center py-3">
            <div class="h6 text-danger mt-3">ไม่พบข้อมูลผู้ใช้งาน</div>
            <div class="txt12 text-secondary mb-4">
              ดูเหมือนว่าคุณจะไม่พบข้อมูลผู้ใช้งาน ลองใช้ข้อมูลส่วนตัวของผู้ใช้งาน<br>สำหรับในการค้นหาครั้งต่อไป " โปรดลองอีกครั้ง "
            </div>
            <img src="Img/ImgWeb/2808164.png" class="col-xl-4 col-lg-5 col-sm-10 col-11"/>
          </div>
        </div>
  ';
};
?>
<div class="modal fade" id="insertuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0">
      <div class="bg-success py-1">
        <h5 class="fw-bold text-white text-center" >เพิ่มบัญชีผู้ใช้งาน</h5>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate id="forminsertusermodal">
          <div class="row">
            <div class="col-md">
              <div class="form-floating mb-3">
                <input class="form-control txt13" id="prefixname" placeholder="คำนำหน้า (ภาษาไทย)" required></input>
                <label class="text-secondary txt13"for="floatingTextarea">คำนำหน้า</label>
                <div class="invalid-feedback txt13">
                  โปรดระบุคำนำหน้า
                </div>
              </div>

              <div class="form-floating mb-3">
                <input class="form-control txt13" id="fname" placeholder="ชื่อ (ภาษาไทย)" required></input>
                <label class="text-secondary txt13"for="floatingTextarea">ชื่อ</label>
                <div class="invalid-feedback txt13">
                  โปรดระบุชื่อ
                </div>
              </div>

              <div class="form-floating mb-3">
                <input class="form-control txt13" id="lname" placeholder="นามสกุล (ภาษาไทย)" required></input>
                <label class="text-secondary txt13"for="floatingTextarea">นามสกุล</label>
                <div class="invalid-feedback txt13">
                  โปรดระบุนามสกุล
                </div>
              </div>

              <div class="form-floating mb-3">
                <input class="form-control txt13" id="userage" placeholder="อายุ (ตัวเลข 0-9)" minlength="1" maxlength="2" onkeypress="javascript:return isNumber(event)"required></input>
                <label class="text-secondary txt13"for="floatingTextarea">อายุ</label>
                <div class="invalid-feedback txt13">
                  โปรดระบุอายุ
                </div>
              </div>

              <div class="form-floating mb-3">
                <select class="form-select txt13" id="usersex" aria-label="Floating label select example" required>
                  <option selected disabled hidden class="text-secondary txt13" value="">เลือกเพศ</option>
                  <option class=" txt13" value="ชาย">ชาย</option>
                  <option class=" txt13" value="หญิง">หญิง</option>
                </select>
                <label class="txt13" for="floatingSelect">เพศ</label>
                <div class="invalid-feedback">
                  โปรดระบุเพศ
                </div>
              </div>

              <div class="form-floating mb-3">
                <input class="form-control txt13" id="card_id" placeholder="เลขบัตรประชาชน (ตัวเลข 13 หลัก)" maxlength="13" minlength="13" required onkeypress="javascript:return isNumber(event)"></input>
                <label class="text-secondary txt13"for="floatingTextarea">เลขบัตรประชาชน</label>
                <div class="invalid-feedback txt13">
                  โปรดระบุเลขบัตรประชาชน 13 หลัก
                </div>
              </div>

            </div>

            <div class="col-md">

              <div class="form-floating mb-3">
                <input class="form-control txt13" id="tel" placeholder="เบอร์โทรศัพท์ (ตัวเลข 0-9)" maxlength="10" minlength="10" required onkeypress="javascript:return isNumber(event)"></input>
                <label class="text-secondary txt13"for="floatingTextarea">เบอร์โทรศัพท์</label>
                <div class="invalid-feedback txt13">
                  โปรดระบุเบอร์โทรศัพท์ 10 หลัก
                </div>
              </div>

              <div class="form-floating mb-3 col-xl-12 col-lg-12 col-sm-12 col-12">
                <select class="form-select txt13" id="vaccine" aria-label="Floating label select example" required>
                  <option selected disabled hidden class="text-secondary txt13" value="">เลือกประวัติการรับวัคซีน Covid-19</option>
                  <option class=" txt13" value="ยังไม่ฉีด">ยังไม่ฉีด</option>
                  <option class=" txt13" value="ฉีด 1 เข็ม">ฉีด 1 เข็ม</option>
                  <option class=" txt13" value="ฉีด 2 เข็ม">ฉีด 2 เข็ม</option>
                  <option class=" txt13" value="ฉีดมากกว่า 2 เข็ม">ฉีดมากกว่า 2 เข็ม</option>
                </select>
                <label class="txt13" for="floatingSelect">ประวัติการรับวัคซีน Covid-19</label>
              </div>

              <div class="form-floating mb-3">
                <input class="form-control txt13" id="user_cd" placeholder="โรคประจำตัว (ภาษาไทย)"></input>
                <label class="text-secondary txt13"for="floatingTextarea">โรคประจำตัว</label>
                <div class="invalid-feedback txt13">
                  โปรดระบโรคประจำตัว
                </div>
              </div>

              <div class="form-floating mb-3">
                <input class="form-control txt13" id="user_da" placeholder="ประวัติการแพ้ยา (ภาษาไทย)"></input>
                <label class="text-secondary txt13"for="floatingTextarea">ประวัติการแพ้ยา</label>
                <div class="invalid-feedback txt13">
                  โปรดระบุประวัติการแพ้ยา
                </div>
              </div>

              <div class="form-floating mb-3">
                <textarea class="form-control txt13" id="useraddress" placeholder="ที่อยู่ (ภาษาไทย)" required></textarea>
                <label class="text-secondary txt13"for="floatingTextarea">ที่อยู่</label>
                <div class="invalid-feedback txt13">
                  โปรดระบุที่อยู่
                </div>
              </div>

              <div class="form-floating mb-3">
                <select class="form-select txt13" id="typeuser" aria-label="Floating label select example" required>
                  <option selected disabled hidden class="text-secondary txt13" value="">เลือกประเภทผู้ใช้งาน</option>
                  <option class=" txt13"value="ผู้ใช้งานทั่วไป">ผู้ใช้งานทั่วไป</option>
                  <option class=" txt13"value="ผู้ดูแลระบบ">ผู้ดูแลระบบ</option>
                </select>
                <label class="txt13" for="floatingSelect">ประเภทผู้ใช้งาน</label>
                <div class="invalid-feedback txt13">
                  โปรดระบุประเภทผู้ใช้งาน
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="reset"class="btn btn-primary text-white txt13">รีเซ็ต</button>
            <button onclick="insertuser11()" type="button"class="btn btn-success text-white txt13">ยืนยัน</button>
            <a href="#" class="btn btn-light border border-2 txt13" data-bs-toggle="modal" data-bs-dismiss="modal">ยกเลิก</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// input เฉพาะ ตัวเลข.
function isNumber(evt) {
  var iKeyCode = (evt.which) ? evt.which : evt.keyCode
  if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
      return false;
  return true;
}
</script>
