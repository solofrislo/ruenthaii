<!-- Footer -->
<footer class="shadow-sm">
  <div class="bg-white">
    <!-- Section: Social media -->
    <div class=" gradient3" style="height:2px;"></div>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="mb-4">
      <div class="container mt-5 ms-xl-4 ms-lg-4 ms-md-4 ms-sm-5 ms-0 ps-xl-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-12 col-sm-9 col-md-8 col-lg-5 col-xl-4 mb-4">
            <!-- Content -->
            <div class="text-uppercase fw-bold mb-4 txt01 txt15">
              <img class="pe-1"src="Img/ImgWeb/logo002.png" height="30"/>คลินิกการแพทย์แผนไทย โรงพยาบาลมหาราชนครราชสีมา
            </div>
            <li class="txt13">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; คลินิกการแพทย์แผนไทย โรงพยาบาลมหาราชนครราชสีมา มีการดูแลด้วยศาสตร์การแพทย์แผนไทยคือวิถีการดูแลสุขภาพของคนไทยโดยการใช้ยาสมุนไพร การนวดรักษา
              การประคบสมุนไพร การอบสมุนไพร การฟื้นฟูสุขภาพมารดาหลังคลอด การอยู่ไฟหลังคลอด การนวดเท้าเพื่อสุขภาพ เพื่อทดแทนหรือร่วมกับการแพทย์แผนปัจจุบัน
              มีการวินิจฉัยโรคโดยแพทย์แผนไทยประยุกต์ ซึ่งสามารถใช้สิทธิ์การรักษาได้ตามสิทธิ์การรักษา.
            </li>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-5 col-sm-3 col-md-3 col-lg-3 col-xl-2 mb-4">
            <!-- Links -->
            <div class="text-uppercase fw-bold mb-4 txt01 txt15">
              รายการ
            </div>
            <p>
              <a class="text-reset text-decoration-none txt13" type="button" href="Index.php"><i class="fa fa-home" aria-hidden="true"></i> หน้าหลัก</a>
            </p>
            <p>
              <div class="dropdown">
                <a class="text-reset dropdown-toggle text-decoration-none txt13" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-hospital"></i>
                  ข่าวสารเเละกิจกรรม
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item txt13" href="Index.php?action=action=News"><i class="fa-regular fa-newspaper"></i> ข่าวสาร</a></li>
                  <li><a class="dropdown-item txt13" href="Index.php?action=Video"><i class="fa-solid fa-video" aria-hidden="true"></i> วิดีโอ</a></li>
                </ul>
              </div>
            </p>
            <p>
              <div class="dropdown">
                <a class="text-reset dropdown-toggle  text-decoration-none txt13" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-house-chimney-medical"></i>
                  คลินิกเฉพาะโรค
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                <?php
                    require 'Connect.php';
                    $Query_Clinic = "SELECT * FROM clinic";
                    $result = mysqli_query($dbcon, $Query_Clinic);

                    if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                    echo '<li class="dropdown-item txt13">';
                    echo '<a class="text-reset text-decoration-none txt13" href="#" onclick="submitForm(' . $row['clinic_id'] . ')">' . $row['clinic_name'] . '</a>';
                    echo '</li>';
                    }
                    } else {
                    echo '<li class="text-center py-2"><span>ไม่มีข้อมูล</span></li>';
                    }
                    ?>
                    <form id="clinicForm" method="POST" action="Index.php?action=Clinic">
                      <input type="hidden" name="id" id="clinicId">
                    </form>
                </ul>
              </div>
            </p>
            <p>
              <div class="dropdown">
                <a class="text-reset dropdown-toggle text-decoration-none txt13" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-hospital"></i>
                  บริการทางการแพทย์
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item txt13" href="Index.php?action=herbal_medicine">การใช้ยาสมุนไพร</a></li>
                  <li><a class="dropdown-item txt13" href="Index.php?action=Royal_massgae"> การนวดรักษาแบบราชสำนัก</a></li>
                  <li><a class="dropdown-item txt13" href="Index.php?action=Health_massage"> การนวดส่งเสริมสุขภาพ</a></li>
                  <li><a class="dropdown-item txt13" href="Index.php?action=Balancing_massage"> การนวดปรับสมดุลโครงสร้างร่างกาย</a></li>
                  <li><a class="dropdown-item txt13" href="Index.php?action=foot_massage"> การนวดเท้าเพื่อสุขภาพ</a></li>
                  <li><a class="dropdown-item txt13" href="Index.php?action=Mother_massage"> การฟื้นฟูสุขภาพมารดาหลังคลอด</a></li>
                  <li><a class="dropdown-item txt13" href="Index.php?action=Spa_services"> สปา</a></li>
                  <li><a class="dropdown-item txt13" href="Index.php?action=Herbal_steaming"> การอบสมุนไพร</a></li>
                </ul>
              </div>
            </p>
            <p>
              <a class="text-reset text-decoration-none txt13" type="button" href="Index.php?action=Reserve"><i class="fas fa-clipboard-list"></i> จองคิวรักษา</a>
            </p>
            <p>
              <div class="dropdown">
                <a class="text-reset dropdown-toggle text-decoration-none txt13" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-hospital"></i>
                  เกี่ยวกับเรา
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item txt13" href="Index.php?action=DataDoctor"><i class="fa fa-user-md" aria-hidden="true"></i> ข้อมูลแพทย์</a></li>
                  <li><a class="dropdown-item txt13" href="Index.php?action=Contact"><i class="fas fa-phone-alt"></i> ติดต่อเรา</a></li>
                  <li><a class="dropdown-item txt13" href="Index.php?action=Service"><i class="fa fa-bed" aria-hidden="true"></i> การให้บริการ</a></li>
                </ul>
              </div>
            </p>
            <p>
              <div class="dropdown">
                <a class="text-reset dropdown-toggle  text-decoration-none txt13" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user-circle"></i>
                  บัญชีผู้ใช้งาน
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <?php
                    if (isset($_SESSION["user_id"])) {
                      echo '<li><a type="button" class="dropdown-item txt13" data-bs-toggle="modal" data-bs-target="#"><i class="fa fa-id-card-o" aria-hidden="true"></i> ข้อมูลผู้ใช้งาน</a></li>';
                      echo '<li><a type="button" class="dropdown-item txt13" data-bs-toggle="modal" data-bs-target="#modallogout"><i class="fa fa-sign-out" aria-hidden="true"></i> ออกจากระบบ</a></li>';
                    }elseif (!isset($_SESSION["user_id"])) {
                      echo '<li><a type="button" class="dropdown-item txt13" data-bs-toggle="modal" data-bs-target="#modallogin"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a></li>';
                      echo '<li><a type="button" class="dropdown-item txt13" data-bs-toggle="modal" data-bs-target="#modalregister"><i class="fas fa-user-plus"></i> สมัครสมาชิก</a></li>';
                    }
                  ?>
                </ul>
              </div>
            </p>
            <!-- <p>
              <a class="text-reset text-decoration-none zoom" type="button" href="#"><i class="fas fa-question-circle"></i> ช่วยเหลือ</a>
            </p> -->
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-6 col-sm-5 col-md-5 col-lg-4 col-xl-3 mb-md-0 mb-4">
            <!-- Links -->
            <div class="text-uppercase fw-bold mb-4 txt01 txt15">
              ติดต่อ
            </div>

            <p class="txt13"><i class="fa fa-h-square" aria-hidden="true"></i> โรงพยาบาลมหาราชนครราชสีมา <br />เลขที่ 49 ถนน ช้างเผือก ตำบลในเมือง <br />อำเภอเมืองนครราชสีมา จังหวัดนครราชสีมา <br />รหัสไปรษณีย์ 30000</p>
              <a href = "mailto:Phanthai4mhr%40gmail.com" target="_blank" class="text-decoration-none">
                <p class="txt13 txt-a-dark"><i class="fas fa-envelope"></i> Phanthai4mhr@gmail.com</p>
              </a>
            <span class="txt13"><i class="fas fa-phone-alt"></i><a href="tel:044235971"class="text-decoration-none txt-a-dark" type="button">&nbsp044-235971</a><span> หรือ</span>
            <a href="tel:044235972"class="text-decoration-none txt13 txt-a-dark" type="button">044-235972</a>
            <span class="txt13">(เรือนไทย)</span><a href="tel:044232240"class="text-decoration-none txt-a-dark" type="button">044-232240</a> <span class="">(ตึกผู้ป่วยนอกชั้น 4)</span></span>
          </div>
          <!-- computer -->
          <div class="col-12 col-sm-6 col-md-5 col-lg-3 col-xl-3 mb-4  d-none d-xl-block d-lg-block d-md-block d-sm-block">
            <div class="text-uppercase fw-bold mb-4 txt01 txt15">
              แผนที่
            </div>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1020.8293851122806!2d102.10440837506029!3d14.985010024262452!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31194c9d2085e70f%3A0xcce053c08a15fa70!2zMjEg4LiW4LiZ4LiZIOC4iuC5ieC4suC4h-C5gOC4nOC4t-C4reC4gSDguJXguLPguJrguKXguYPguJnguYDguKHguLfguK3guIcg4Lit4Liz4LmA4Lig4Lit4LmA4Lih4Li34Lit4LiH4LiZ4LiE4Lij4Lij4Liy4LiK4Liq4Li14Lih4LiyIOC4meC4hOC4o-C4o-C4suC4iuC4quC4teC4oeC4siAzMDAwMA!5e0!3m2!1sth!2sth!4v1640052639047!5m2!1sth!2sth" class="border border-3" width="380" height="200" allowfullscreen="" loading="lazy"></iframe>
          </div>
          <!-- mobole -->
          <div class="col-12 col-sm-6 col-lg-3 col-xl-3 mb-4  d-block d-sm-none d-md-none d-lg-none d-xl-none">
            <div class="text-uppercase fw-bold mb-4 txt01 txt15">
              แผนที่
            </div>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1020.8293851122806!2d102.10440837506029!3d14.985010024262452!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31194c9d2085e70f%3A0xcce053c08a15fa70!2zMjEg4LiW4LiZ4LiZIOC4iuC5ieC4suC4h-C5gOC4nOC4t-C4reC4gSDguJXguLPguJrguKXguYPguJnguYDguKHguLfguK3guIcg4Lit4Liz4LmA4Lig4Lit4LmA4Lih4Li34Lit4LiH4LiZ4LiE4Lij4Lij4Liy4LiK4Liq4Li14Lih4LiyIOC4meC4hOC4o-C4o-C4suC4iuC4quC4teC4oeC4siAzMDAwMA!5e0!3m2!1sth!2sth!4v1640052639047!5m2!1sth!2sth" class="border border-3" width="100%" height="300" allowfullscreen="" loading="lazy"></iframe>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center gradient text-white txt13 py-1">
      © 2022 Copyright:
      <a class="text-white text-decoration-none txt13" type="botton"href="https://web.facebook.com/gunkasit/" target="_blank">Kasidit Katcharoen</a>
    </div>
    <!-- Copyright -->


  </div>
</footer>
