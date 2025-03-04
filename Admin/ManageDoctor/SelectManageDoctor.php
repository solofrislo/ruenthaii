<?php
if (isset($_POST['search'])) {
  require '../../Connect.php';
  $search = $_POST['search'];
  if ($search !=='') { //มีค่าไม่เท่ากับค่าว่าง
    $search = mysqli_real_escape_string($dbcon, $search);
    $qry_datadoctor = "SELECT * FROM doctor WHERE CONCAT_WS('',doctor_prefix_name, doctor_fname, doctor_lname,
       doctor_rank, doctor_professional_license, doctor_transcript, doctor_sort)
    LIKE '%".$search."%' ORDER BY doctor_id DESC LIMIT 10";
  }else { //มีค่าเท่ากับค่าว่าง
    $qry_datadoctor = "SELECT * FROM doctor ORDER BY doctor_sort ASC";
  }
}else {
    require 'Connect.php';
    $qry_datadoctor = "SELECT * FROM doctor ORDER BY doctor_sort ASC";
}

$result_datadoctor = mysqli_query($dbcon,$qry_datadoctor);
$row_datadoctor = mysqli_num_rows($result_datadoctor);
if ($row_datadoctor > 0) {
  echo '
          <div class="col-12">
            <div class="row justify-content-start pt-2">';
  $i=1;
  while ($row_doctor = mysqli_fetch_array($result_datadoctor,MYSQLI_ASSOC)) {
    $doctor_id = $row_doctor['doctor_id'];
    $doctor_img = $row_doctor['doctor_img'];
    $doctor_prefix_name = $row_doctor['doctor_prefix_name'];
    $doctor_fname = $row_doctor['doctor_fname'];
    $doctor_lname = $row_doctor['doctor_lname'];
    $doctor_rank = $row_doctor['doctor_rank'];
    $doctor_professional_license = $row_doctor['doctor_professional_license'];
    $doctor_transcript = $row_doctor['doctor_transcript'];
    $doctor_sort = $row_doctor['doctor_sort'];
    $doctor_allow = $row_doctor['doctor_allow'];

    $doctor_sort_update = $i ;

    if ($doctor_img =='') {
      $doctor_img ='doctor01-03-2565.jpg';
    }

    if ($doctor_allow == 'ไม่อนุญาต') {
      $doctor_allow_show ='<span class="rounded-pill px-2 text-white bg-danger txt12">ไม่อนุญาต</span>';
    }elseif ($doctor_allow == 'อนุญาต') {
      $doctor_allow_show ='<span class="rounded-pill px-2 text-white bg-success txt12">อนุญาต</span>';
    }

    $fullnamedoctor = $doctor_prefix_name.$doctor_fname.' '.$doctor_lname;
echo '
        <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 col-12 mb-2 d-flex align-items-stretch ps-0 pe-xl-2 pe-lg-2 pe-md-0 pe-sm-0 pe-0">
          <div class="card border col-12">
            <div class="card-body pt-1 pe-1">
              <div class="row justify-content-end py-0">
                <div class="col-auto px-1">
                  <button type="button" class="btn btn-primary p-1 shadow-none" data-bs-toggle="modal" data-bs-target="#openmodalshowdoctor'.$doctor_id.'">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                  </button>
                </div>
                <div class="col-auto ps-0">
                  <button type="button" class="btn btn-warning text-white p-1 shadow-none" onclick="editdoctor('.$doctor_id.')">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </button>
                </div>
              </div>
              <div class="row justify-content-start">
                <div class="col-auto">
                  <div class="rounded-top d-flex align-items-end border-0"style="height:100px;background-image: url(\'Img/ImgDoctor/'.$doctor_img.'\');background-repeat: no-repeat;background-size: cover;background-position: center;">
                  </div>
                  <input name="imgdtr'.$doctor_id.'" type="file" class="d-none" id="openuploadimgdtr'.$doctor_id.'" onchange="changeimgdtr('.$doctor_id.')" accept="image/png, image/gif, image/jpeg">
                  <label class="col-12" for="openuploadimgdtr'.$doctor_id.'">
                    <div class="col-12 bg02 text-white rounded-bottom txt12 text-center py-1 px-3">
                      <i class="fas fa-image"></i> เปลี่ยนรูป
                    </div>
                  </label>
                </div>
                <div class="col-auto ps-0 me-auto">
                  <div class="row justify-content-center">
                    <div class="col-12">
                      <span class="txt01 card-title fw-bold txt12 text-truncate1L">'.$fullnamedoctor.'</span>
                      <span class="txt12">ตำแหน่ง</span><br />
                      <span class="text-truncate1L text-secondary txt12">'.$doctor_rank.'</span>
                      '.$doctor_allow_show.'
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
';
    echo '
    <div class="modal fade" id="openmodalshowdoctor'.$doctor_id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
          <div class="bg-primary py-1">
            <h5 class="fw-bold text-white text-center " id="staticBackdropLabel">ข้อมูลแพทย์</h5>
          </div>
          <div class="modal-body">
            <div class="row justify-content-center">
              <div class="col-6 ps-5 pe-1 text-center">
                <div class="rounded-top d-flex align-items-end border-0"style="height:200px;width:180px;background-image: url(\'Img/ImgDoctor/'.$doctor_img.'\');background-repeat: no-repeat;background-size: cover;background-position: center;">
                </div>
              </div>
              <div class="col-6 ps-1 pe-5">
                <span class="fw-bold txt13 text-dark mb-1">'.$fullnamedoctor.'</span><br />
                <span class="txt13">ตำแหน่ง</span><br />
                <span class="txt13 text-secondary mb-1">'.$doctor_rank.'</span><br />
                <span class="txt13">ใบประกอบวิชาชีพเลขที่</span><br />
                <span class="txt13 text-secondary mb-1">'.$doctor_professional_license.'</span><br />
                <span class="txt13">วุฒิการศึกษา</span><br />
                <span class="txt13 text-secondary mb-1">'.$doctor_transcript.'</span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-light border border-2 txt13 shadow-none" data-bs-toggle="modal" data-bs-dismiss="modal">ปิด</button>
          </div>
        </div>
      </div>
    </div>
    ';
    echo '
    <div class="modal fade" id="editdoctor'.$doctor_id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0">
          <div class="bg-warning py-1">
            <h5 class="fw-bold text-white text-center">แก้ไขข้อมูลเเพทย์</h5>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate id="formedittdoctormodal'.$doctor_id.'">
              <div class="row">
                <div class="col-md">
                  <div class="form-floating mb-3">
                    <input class="form-control txt13 shadow-none" id="ed_doctor_prefix_name'.$doctor_id.'" value="'.$doctor_prefix_name.'" placeholder="คำนำหน้า (ภาษาไทย)" required></input>
                    <label class="text-secondary txt13"for="floatingTextarea">คำนำหน้า</label>
                    <div class="invalid-feedback">
                      โปรดระบุคำนำหน้า
                    </div>
                  </div>
                  <div class="form-floating mb-3">
                    <input class="form-control txt13 shadow-none" id="ed_doctor_fname'.$doctor_id.'" value="'.$doctor_fname.'" placeholder="ชื่อ (ภาษาไทย)" required></input>
                    <label class="text-secondary txt13"for="floatingTextarea">ชื่อ</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุชื่อ
                    </div>
                  </div>
                  <div class="form-floating mb-3">
                    <input class="form-control txt13 shadow-none" id="ed_doctor_lname'.$doctor_id.'" value="'.$doctor_lname.'" placeholder="นามสกุล (ภาษาไทย)" required></input>
                    <label class="text-secondary txt13"for="floatingTextarea">นามสกุล</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุนามสกุล
                    </div>
                  </div>
                  <div class="form-floating mb-3">
                    <input class="form-control txt13 shadow-none" id="ed_doctor_rank'.$doctor_id.'" value="'.$doctor_rank.'" placeholder="ตำแหน่ง" required></input>
                    <label class="text-secondary txt13"for="floatingTextarea">ตำแหน่ง</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุตำแหน่ง
                    </div>
                  </div>
                  <div class="form-floating mb-3">
                    <input class="form-control txt13 shadow-none" id="ed_doctor_professional_license'.$doctor_id.'" value="'.$doctor_professional_license.'" placeholder="ใบประกอบวิชาชีพ" required></input>
                    <label class="text-secondary txt13"for="floatingTextarea">ใบประกอบวิชาชีพ</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุใบประกอบวิชาชีพ
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-floating mb-3">
                    <textarea class="form-control txt13 shadow-none" id="ed_doctor_transcript'.$doctor_id.'" placeholder="วุฒิการศึกษา" style="height:195px;"required>'.$doctor_transcript.'</textarea>
                    <label class="text-secondary txt13"for="floatingTextarea">วุฒิการศึกษา</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุวุฒิการศึกษา
                    </div>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="hidden" id="getiddtrallow'.$doctor_id.'"value="'.$doctor_allow.'"/>
                    <select class="form-select txt13 shadow-none" id="ed_doctor_allow'.$doctor_id.'" aria-label="Floating label select example" required>
                      <option disabled hidden class="text-secondary txt13" value="">โปรดระบุการอนุญาต</option>
                      <option class=" txt13" value="อนุญาต">อนุญาต</option>
                      <option class=" txt13" value="ไม่อนุญาต">ไม่อนุญาต</option>
                    </select>
                    <label for="floatingSelect">การอนุญาต</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input class="form-control txt13 shadow-none" id="ed_doctor_sort'.$doctor_id.'" value="'.$doctor_sort.'" placeholder="ลำดับการเรียง"required></input>
                    <label class="text-secondary txt13"for="floatingTextarea">ลำดับการเรียง</label>
                    <div class="invalid-feedback txt13">
                      โปรดระบุลำดับการเรียง
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button onclick="confirm_edit_doctor('.$doctor_id.')" type="button"class="btn btn-success text-white txt13 shadow-none">ยืนยัน</button>
                <a href="#" class="btn btn-light border border-2 txt13 shadow-none" data-bs-toggle="modal" data-bs-dismiss="modal">ยกเลิก</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    ';
    $i++;
  }

}else {
  echo '
      <div class="row justify-content-center">
        <div class="col-12 text-center py-3">
          <div class="h6 text-danger mt-3">ไม่พบข้อมูลแพทย์</div>
          <div class="txt12 text-secondary mb-4">
            ดูเหมือนว่าคุณจะไม่พบข้อมูลแพทย์ ลองใช้ข้อมูลส่วนตัวของแพทย์<br>สำหรับในการค้นหาครั้งต่อไป " โปรดลองอีกครั้ง "
          </div>
          <img src="Img/ImgWeb/2808164.png" class="col-xl-4 col-lg-5 col-sm-10 col-11"/>
        </div>
      </div>
  ';
}
echo '</div>
    </div>
  </div>';
 ?>


 <!-- Modal insertdoctor-->
 <div class="modal fade" id="insertdoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-md">
     <div class="modal-content border-0">
       <div class="bg-success py-1">
         <h5 class="fw-bold text-white text-center">เพิ่มข้อมูลเเพทย์</h5>
       </div>
       <div class="modal-body">
         <form class="needs-validation" novalidate id="forminsertdoctormodal">
           <div class="row">
             <div class="col-md">
               <div class="form-floating mb-3">
                 <input class="form-control txt13" id="insert_doctor_prefix_name" placeholder="คำนำหน้า (ภาษาไทย)" required></input>
                 <label class="text-secondary txt13"for="floatingTextarea">คำนำหน้า</label>
                 <div class="invalid-feedback txt13">
                   โปรดระบุคำนำหน้า
                 </div>
               </div>

               <div class="form-floating mb-3">
                 <input class="form-control txt13" id="insert_doctor_fname" placeholder="ชื่อ (ภาษาไทย)" required></input>
                 <label class="text-secondary txt13"for="floatingTextarea">ชื่อ</label>
                 <div class="invalid-feedback txt13">
                   โปรดระบุชื่อ
                 </div>
               </div>

               <div class="form-floating mb-3">
                 <input class="form-control txt13" id="insert_doctor_lname" placeholder="นามสกุล (ภาษาไทย)" required></input>
                 <label class="text-secondary txt13"for="floatingTextarea">นามสกุล</label>
                 <div class="invalid-feedback txt13">
                   โปรดระบุนามสกุล
                 </div>
               </div>
             </div>
             <div class="col-md">
               <div class="form-floating mb-3">
                 <input class="form-control txt13" id="insert_doctor_rank" placeholder="ตำแหน่ง" required></input>
                 <label class="text-secondary txt13"for="floatingTextarea">ตำแหน่ง</label>
                 <div class="invalid-feedback txt13">
                   โปรดระบุตำแหน่ง
                 </div>
               </div>
               <div class="form-floating mb-3">
                 <textarea class="form-control txt13" id="insert_doctor_professional_license" placeholder="ใบประกอบวิชาชีพ"required></textarea>
                 <label class="text-secondary txt13"for="floatingTextarea">ใบประกอบวิชาชีพ</label>
                 <div class="invalid-feedback txt13">
                   โปรดระบุใบประกอบวิชาชีพ
                 </div>
               </div>
               <div class="form-floating mb-3">
                 <textarea class="form-control txt13" id="insert_doctor_transcript" placeholder="วุฒิการศึกษา"required></textarea>
                 <label class="text-secondary txt13"for="floatingTextarea">วุฒิการศึกษา</label>
                 <div class="invalid-feedback txt13">
                   โปรดระบุวุฒิการศึกษา
                 </div>
               </div>
             </div>
           </div>
           <div class="modal-footer">
             <button type="reset"class="btn btn-primary text-white txt13 shadow-none">รีเซ็ต</button>
             <button onclick="confirm_insert_doctor()" type="button"class="btn btn-success text-white txt13 shadow-none">ยืนยัน</button>
             <a href="#" class="btn btn-light border border-2 txt13 shadow-none" data-bs-toggle="modal" data-bs-dismiss="modal">ยกเลิก</a>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>
