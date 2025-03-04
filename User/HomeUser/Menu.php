<div class="container-fluid d-xl-block d-lg-none d-md-none d-sm-none d-none py-4" >
  <div class="row justify-content-center py-5 px-1">
    <div class="col-xl-3 col-lg-3 d-flex align-items-center text-end ps-3 pe-4">
      <div class="row justify-content-center py-3">
        <div class="col-xl-6 col-lg-6 text-center m-0 p-0">
          <div class="card border-0 ms-0 me-1 mt-1 mb-0 darker box">
            <div class="card-body pb-1">
              <a href="#News"class="btn text-decoration-none txt14 fw-bold zoom shadow-none">
                <button type="button" class="btn bg02 mb-1 shadow px-4 py-3 text-white txt24"><i class="fas fa-globe"></i></button><br />
                <span class="txt14 txt01">ข่าวสาร</span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 text-center m-0 p-0">
          <div class="card border-0 ms-0 me-1 mt-1 mb-0 darker box">
            <div class="card-body pb-1">
              <a href="#Knowledge" class="btn text-decoration-none txt14 fw-bold zoom shadow-none">
                <button type="button" class="btn bg02 mb-1 shadow px-4 py-3 text-white txt24"><i class="fas fa-briefcase-medical"></i></button><br />
                <span class="txt14 txt01">การรักษา</span>
             </a>
           </div>
         </div>
        </div>
        <div class="col-xl-6 col-lg-6 text-center m-0 p-0">
          <div class="card border-0 ms-0 me-1 mt-1 mb-0 darker box">
            <div class="card-body pb-1">
              <a href="#advice" class="btn text-decoration-none txt14 fw-bold zoom shadow-none">
                <button type="button" class="btn bg02 mb-1 shadow px-4 py-3 text-white txt24"><i class="fas fa-book-medical"></i></button><br />
                <span class="txt14 txt01">คำแนะนำ</span>
             </a>
           </div>
         </div>
        </div>
        <div class="col-xl-6 col-lg-6 text-center m-0 p-0">
          <div class="card border-0 ms-0 me-1 mt-1 mb-0 darker box">
            <div class="card-body pb-1">
              <a href="#taboo" class=" btn text-decoration-none txt14 fw-bold zoom shadow-none">
                <button type="button" class="btn bg02 mb-1 shadow px-4 py-3 text-white txt24"><i class="fas fa-hand-paper"></i></button><br />
                <span class="txt14 txt01">ข้อห้าม</span>
             </a>
           </div>
         </div>
        </div>
        <?php
        if (isset($_SESSION["user_id"])) {
          echo '
          <div class="col-12 px-0 text-center">
            <div class="card bg02 border-0 shadow ms-0 me-1 mt-1 mb-0 py-0 darker box">
              <div class="card-body py-1">
                <div class="row justify-content-center">
                  <div class="col-5 zoom my-auto">
                    <a href="Index.php?action=DataUser" class="text-decoration-none"><span class="text-white txt12"><i class="fas fa-user"></i> '.$_SESSION["fullname"].'</span></a>
                  </div>
                  <div class="col">
                    <span class="text-white txt20">|</span>
                  </div>
                  <div class="col-5 zoom my-auto">
                    <a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#modallogout"><span class="text-white txt12"><i class="fas fa-power-off"></i> ออกจากระบบ</span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          ';
        }elseif (!isset($_SESSION["user_id"])) {
          echo '
          <div class="col-12 px-0 text-center">
            <div class="card bg02 border-0 shadow ms-0 me-1 mt-1 mb-0 py-0 darker box">
              <div class="card-body py-1">
                <div class="row justify-content-center">
                  <div class="col-5 zoom my-auto">
                    <a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#modallogin"><span class="text-white txt12"><i class="fas fa-user"></i> เข้าสู่ระบบ</span></a>
                  </div>
                  <div class="col">
                    <span class="text-white txt20">|</span>
                  </div>
                  <div class="col-5 zoom my-auto">
                    <a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalregister"><span class="text-white txt12"><i class="fas fa-user-plus"></i> สมัครสมาชิก</span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          ';
        }
         ?>
      </div>
    </div>
    <div class="col-xl-7 col-lg-7">
      <div id="carouselExampleFade1" class="carousel slide carousel-fade " data-bs-ride="carousel">
        <div class="carousel-inner col-auto rounded-3">
          <?php 
          require __DIR__ .'/../../Connect.php';

          $qry_banner = "SELECT * FROM banner ORDER BY banner_sort ASC";
          $result_banner = mysqli_query($dbcon,$qry_banner);

          $banners = [];
          while ($row_banner = mysqli_fetch_array($result_banner, MYSQLI_ASSOC)) {
            $banners[] = $row_banner;
          }
          $isActive = true;
          foreach ($banners as $banner) {
              $imagePath = file_exists(__DIR__ .'/../../Img/ImgBanner/' . $banner['banner_img'])
              ? 'Img/ImgBanner/' . $banner['banner_img']
              : 'Img/ImgBanner/default.jpg';

            echo '<div class="carousel-item ' . ($isActive ? 'active' : '') . '">';
            echo '<img src="' . htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') . '" class="w-100" alt="Banner Image">';
            echo '</div>';

            $isActive = false;
          }
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade1" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade1" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>
</div>



<div class="container-fluid d-xl-none d-lg-block d-md-block d-sm-block d-block my-0 py-0">
  <div class="row justify-content-center">
    <div class="col-12 px-2">
      <div id="carouselExampleFade02" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner col-auto rounded-3">
        <?php 
          require __DIR__ .'/../../Connect.php';

          $qry_banner = "SELECT * FROM banner ORDER BY banner_sort ASC";
          $result_banner = mysqli_query($dbcon, $qry_banner);

          $isActive = true; // ใช้สำหรับกำหนด active class
          while ($row_banner = mysqli_fetch_array($result_banner, MYSQLI_ASSOC)) {
              $banner_img = trim($row_banner['banner_img']);
              $imagePath = file_exists(__DIR__ . '/../../Img/ImgBanner/' . $banner_img)
                  ? 'Img/ImgBanner/' . $banner_img
                  : 'Img/ImgBanner/default.jpg';

              echo '<div class="carousel-item ' . ($isActive ? 'active' : '') . '">';
              echo '<img src="' . htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8') . '" class="img-fluid col-12" width="100%" alt="Banner Image">';
              echo '</div>';
            $isActive = false;
          }
        ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade02" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade02" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-12 px-1">
        <div class="row justify-content-center">
          <div class="col-md-3 col-sm-6 col-6 text-center m-0 px-1">
            <div class="card border-0 px-1 darker box mt-2">
              <div class="card-body pb-2 pt-3">
                <a href="#News"class="btn text-decoration-none txt14 fw-bold zoom shadow-none">
                  <button type="button" class="btn bg02 mb-1 shadow px-3 py-2 text-white txt24"><i class="fas fa-globe"></i></button><br />
                  <span class="txt14 txt01">ข่าวสาร</span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6 text-center m-0 px-1">
            <div class="card border-0 px-1 darker box mt-2">
              <div class="card-body pb-2 pt-3">
                <a href="#Knowledge" class="btn text-decoration-none txt14 fw-bold zoom shadow-none">
                  <button type="button" class="btn bg02 mb-1 shadow px-3 py-2 text-white txt24"><i class="fas fa-briefcase-medical"></i></button><br />
                  <span class="txt14 txt01">การรักษา</span>
               </a>
             </div>
           </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6 text-center m-0 px-1">
            <div class="card border-0 px-1 darker box mt-2">
              <div class="card-body pb-2 pt-3">
                <a href="#advice" class="btn text-decoration-none txt14 fw-bold zoom shadow-none">
                  <button type="button" class="btn bg02 mb-1 shadow px-3 py-2 text-white txt24"><i class="fas fa-book-medical"></i></button><br />
                  <span class="txt14 txt01">คำแนะนำ</span>
               </a>
             </div>
           </div>
          </div>
          <div class="col-md-3 col-sm-6 col-6 text-center m-0 px-1">
            <div class="card border-0 px-1 darker box mt-2">
              <div class="card-body pb-2 pt-3">
                <a href="#taboo" class=" btn text-decoration-none txt14 fw-bold zoom shadow-none">
                  <button type="button" class="btn bg02 mb-1 shadow px-3 py-2 text-white txt24"><i class="fas fa-hand-paper"></i></button><br />
                  <span class="txt14 txt01">ข้อห้าม</span>
               </a>
             </div>
           </div>
          </div>
          <?php
          if (isset($_SESSION["user_id"])) {
            echo '
            <div class="col-12 px-0 text-center px-1">
              <div class="card bg02 border-0 shadow my-2 py-0 darker box">
                <div class="card-body py-1">
                  <div class="row justify-content-center">
                    <div class="col-5 zoom my-auto">
                      <a href="Index.php?action=DataUser" class="text-decoration-none"><span class="text-white txt12"><i class="fas fa-user"></i> '.$_SESSION["fullname"].'</span></a>
                    </div>
                    <div class="col">
                      <span class="text-white txt20">|</span>
                    </div>
                    <div class="col-5 zoom my-auto">
                      <a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#modallogout"><span class="text-white txt12"><i class="fas fa-power-off"></i> ออกจากระบบ</span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            ';
          }elseif (!isset($_SESSION["user_id"])) {
            echo '
            <div class="col-12 px-0 text-center px-1">
              <div class="card bg02 border-0 shadow my-2 py-0 darker box">
                <div class="card-body py-1">
                  <div class="row justify-content-center">
                    <div class="col-5 zoom my-auto">
                      <a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#modallogin"><span class="text-white txt12"><i class="fas fa-user"></i> เข้าสู่ระบบ</span></a>
                    </div>
                    <div class="col">
                      <span class="text-white txt20">|</span>
                    </div>
                    <div class="col-5 zoom my-auto">
                      <a href="" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalregister"><span class="text-white txt12"><i class="fas fa-user-plus"></i> สมัครสมาชิก</span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            ';
          }
           ?>
        </div>
      </div>
    </div>
  </div>
</div>
