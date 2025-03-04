<?php

$qry_db_dtr="SELECT * FROM doctor WHERE doctor_allow = 'อนุญาต' ORDER BY doctor_sort ASC";
$result_db_dtr = mysqli_query($dbcon,$qry_db_dtr);
$row_db_dtr = mysqli_num_rows($result_db_dtr);

if ($row_db_dtr > 0) {
  echo '
  <div class="container-fluid">
    <div class="row justify-content-center pt-xl-5 pt-lg-5 pt-md-5 pt-sm-5 pt-0">
      <div class="col-xl-7 col-12 pt-3 text-center">
          <!-- <img class="img-fluid shadow rounded"src="Img/ImgWeb/datadoctor.png." width="auto"/> -->
          <!--<img class="img-fluid rounded"src="Img/ImgWeb/3636111.png." width="auto"/> -->
              <img class="img-fluid rounded col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8"src="Img/ImgWeb/5032987.png"/>
              <div class="fw-bold txt18 txt01 my-3">
                ข้อมูลเเพทย์แผนไทย
              </div>
      </div>
    </div>
    <div class="row justify-content-center pb-xl-5 pb-lg-5 pb-md-5 pb-sm-5 pb-0">
      <div class="col-xl-8 col-12 pt-3">
        <div class="row justify-content-start">
  ';
  while ($row_db_dtr = mysqli_fetch_array($result_db_dtr,MYSQLI_ASSOC)) {
    $doctor_id = $row_db_dtr['doctor_id'];
    $doctor_img = $row_db_dtr['doctor_img'];
    $doctor_prefix_name = $row_db_dtr['doctor_prefix_name'];
    $doctor_fname = $row_db_dtr['doctor_fname'];
    $doctor_lname = $row_db_dtr['doctor_lname'];
    $doctor_rank = $row_db_dtr['doctor_rank'];
    $doctor_professional_license = $row_db_dtr['doctor_professional_license'];
    $doctor_transcript = $row_db_dtr['doctor_transcript'];

    if ($doctor_img =='') {
      $doctor_img ='doctor01-03-2565.jpg';
    }

    $fullnamedoctor = $doctor_prefix_name.$doctor_fname.' '.$doctor_lname;
    echo '

    <div class="col-xl-2 col-lg-3 col-sm-3 col-6 mb-3 d-flex align-items-stretch">
      <div class="card shadow border-0 zoom1 col-12">
        <div class="rounded-top"style="height:150px;background-image: url(\'Img/ImgDoctor/'.$doctor_img.'\');background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
        <div class="card-body">
          <span class="txt12 txt01 fw-bold text-truncate1L">'.$fullnamedoctor.'</span>
          <span class="text-secondary txt12 text-truncate1L">'.$doctor_rank.'</span>
          <div class="text-center mt-2">
            <button type="button" class="btn btn-light btn-hover border shadow-none txt12 py-1 col-12" data-bs-toggle="modal" data-bs-target="#DataDoctor'.$doctor_id.'">รายละเอียด</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="DataDoctor'.$doctor_id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content bg-transparent border-0">
          <div class="card shadow border-0 col-12">
            <div class="card-body">
              <div class="row justify-content-center pt-3">
                <div class="col-12 text-center">
                  <img src="Img/ImgDoctor/'.$doctor_img.'" class="img-fluid col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 rounded-3 border">
                </div>
                <div class="col-8 text-center mt-2">
                  <div class="col-12">
                    <span class="txt01 txt16 fw-bold pt-xl-0 pt-lg-0 pt-md-0 pt-sm-0 pt-2">'.$fullnamedoctor.'</span><br />
                    <span class="txt12 text-secondary fw-bold">ตำแหน่ง</span>
                    <span class="txt12 text-secondary">'.$doctor_rank.'</span><br />
                    <span class="txt12 text-secondary fw-bold">ใบประกอบวิชาชีพเลขที่</span>
                    <span class="txt12 text-secondary">'.$doctor_professional_license.'</span><br />
                    <span class="txt12 text-secondary fw-bold">วุฒิการศึกษา</span>
                    <span class="txt12 text-secondary">'.$doctor_transcript.'</span><br />
                  </div>
                </div>
                <div class="col-12 text-end">
                  <a href="#" class="btn btn-hover shadow-none txt13" data-bs-toggle="modal" data-bs-dismiss="modal">ปิด</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    ';
  }
  echo '
      </div>
    </div>
  </div>
</div>
  ';
}else {
  echo '
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 text-center py-3 mt-3">
          <div class="h6 txt01 mt-3 fw-bold">ไม่พบข้อมูลแพทย์</div>
          <div class="txt13 text-secondary mb-4">
            ขออภัยในความไม่สะดวก สามารถพบข้อมูลแพทย์ได้ในเร็ว ๆ นี้
          </div>
          <img src="Img/ImgWeb/2808164.png" class="col-xl-4 col-lg-5 col-sm-10 col-11"/>
        </div>
      </div>
    </div>
  ';
}
 ?>
