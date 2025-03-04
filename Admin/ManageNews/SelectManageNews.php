<?php

if (isset($_POST['search'])) {
  require '../../Connect.php';
  $search = $_POST['search'];
  if ($search !=='') {
    $search = mysqli_real_escape_string($dbcon, $search);
    $qry_news = "SELECT * FROM news WHERE CONCAT_WS('', news_date, news_time, news_content, news_allow)
    LIKE '%".$search."%' ORDER BY news_id DESC LIMIT 10";
  }else {
    $qry_news = "SELECT * FROM news ORDER BY news_id DESC LIMIT 10";
  }
}else {
    require 'Connect.php';
    $qry_news = "SELECT * FROM news ORDER BY news_id DESC LIMIT 10";
}

$result_news = mysqli_query($dbcon,$qry_news);
$row_cnt_news = mysqli_num_rows($result_news);
if ($row_cnt_news > 0) {
  echo '<div class="row justify-content-center">
          <div class="col-12">
            <div class="row justify-content-start">';
  while ($row_news = mysqli_fetch_array($result_news,MYSQLI_ASSOC)) {
    $news_id = $row_news['news_id'];
    $news_date = $row_news['news_date'];
    $date = date_create($news_date);
    $d = date_format($date,"d");
    $m = date_format($date,"m");
    $Y = date_format($date,"Y")+543;
    $news_datethai = $d.'/'.$m.'/'.$Y;
    $news_time = $row_news['news_time'];
    $news_content = $row_news['news_content'];
    $news_img = $row_news['news_img'];
    $news_imgs = explode(',' ,$news_img);
    $news_imgs=array_filter($news_imgs);
    $cnt_img_array = count($news_imgs);
    $news_allow = $row_news['news_allow'];

    if ($news_allow == 'อนุญาต') {
       $news_allow_show = '<span class="rounded-pill px-2 text-white bg-success txt10">อนุญาต</span>';
    }elseif ($news_allow == 'ไม่อนุญาต') {
        $news_allow_show = '<span class="rounded-pill px-2 text-white bg-danger txt10">ไม่อนุญาต</span>';
    }

    echo '
      <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-2 px-1 d-flex align-items-stretch">
        <div class="card shadow col-12 border-0">
          <div class="card-body pb-2">
            <div class="row justify-content-start">
              <div class="col-auto pe-0">
                <div class="rounded-circle border" style="background-image:url(\'Img/ImgWeb/logoadmin.png\');height:52px;width:52px;background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
              </div>
              <div class="col-auto me-auto">
                <div class="col-12 text-start txt13 fw-bold">
                  Admin
                </div>
                <div class="col-12 text-start text-secondary txt10">
                  '.$news_datethai.'
                </div>
                <div class="col-12">
                  '.$news_allow_show.'
                </div>
              </div>
              <div class="col-auto px-0">
                <button type="button" class="btn btn-danger border shadow-none txt11 p-1" onclick="deletenews('.$news_id.')"><i class="far fa-trash-alt"></i> ลบ</button>
              </div>
              <div class="col-auto ps-1">
                <button type="button" class="btn btn-light border shadow-none txt11 p-1" onclick="openmodaleditnews('.$news_id.')"><i class="fas fa-edit"></i> แก้ไข</button>
              </div>
              <div class="row justify-content-start mt-1 mb-3">
                <div class="col-12 ps-3 mt-2 txt13 text-truncate1L">
                  '.$news_content.'
                </div>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-11 px-0">
                <div class="row justify-content-start">';
                $i=0;
                $d_none ='';
                $zoomimgnews='';
                $total_array_img_more = $cnt_img_array - 3;
                $imgnummore ='';
                $col='';
                $h_admin='';
                  foreach ($news_imgs as $valueimg) {
                      if (sizeof($news_imgs) == 1) {
                        echo '
                        <div class="col-12 p-0 containerhoverimg p-1">
                          <div class="rounded-3 imagehoverimg" onclick="openmodalCarouselimgnews('.$news_id.','.$i.')" style="background-image:url(\'Img/ImgNews/'.trim($valueimg).'\');
                          height:240px;width:100%;background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
                          <div class="middlehoverimg">
                             <div class="txt20"><i class="fas fa-search-plus text-dark" onclick="openmodalCarouselimgnews('.$news_id.','.$i.')"></i></div>
                           </div>
                        </div>
                        ';

                      }else if (sizeof($news_imgs) == 2) {
                          $col='col-6';
                        echo '
                        <div class="'.$col.' p-0 containerhoverimg p-1">
                          <div class="rounded-3 imagehoverimg" onclick="openmodalCarouselimgnews('.$news_id.','.$i.')"style="background-image:url(\'Img/ImgNews/'.trim($valueimg).'\');
                          height:240px;width:100%;background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
                          <div class="middlehoverimg">
                             <div class="txt20"><i class="fas fa-search-plus text-dark" onclick="openmodalCarouselimgnews('.$news_id.','.$i.')"></i></div>
                           </div>
                        </div>
                        ';
                      }elseif (sizeof($news_imgs) == 3) {
                        if ($i==0) {
                          $col='col-12';
                        }elseif ($i == 1) {
                          $col='col-6';
                        }elseif ($i == 2) {
                          $col='col-6';
                        }
                          echo '
                          <div class="'.$col.' p-0 containerhoverimg p-1">
                            <div class="rounded-3 imagehoverimg" onclick="openmodalCarouselimgnews('.$news_id.','.$i.')"style="background-image:url(\'Img/ImgNews/'.trim($valueimg).'\');
                            height:115px;width:100%;background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
                            <div class="middlehoverimg">
                               <div class="txt20"><i class="fas fa-search-plus text-dark" onclick="openmodalCarouselimgnews('.$news_id.','.$i.')"></i></div>
                             </div>
                          </div>
                          ';
                      }elseif (sizeof($news_imgs) >3) {
                        if ($i == 3) {
                          $total_array_img_more = $cnt_img_array - 3;
                          $col='col-4';
                          $h_admin='80';
                          $imgnummore='<span class="overlay_img_news_more d-flex align-items-center justify-content-center txt16 p-0" onclick="openmodalCarouselimgnews('.$news_id.','.$i.')">+'.$total_array_img_more.'</span>';
                          $zoomimgnews='';
                        }elseif ($i == 2) {
                           $col='col-4';
                           $h_admin='80';
                           $imgnummore ='';
                           $zoomimgnews='
                           <div class="middlehoverimg">
                              <div class="txt20"><i class="fas fa-search-plus text-dark" onclick="openmodalCarouselimgnews('.$news_id.','.$i.')"></i></div>
                            </div>
                           ';
                         }elseif ($i == 1) {
                           $col='col-4';
                           $h_admin='80';
                           $imgnummore ='';
                           $zoomimgnews='
                           <div class="middlehoverimg">
                              <div class="txt20"><i class="fas fa-search-plus text-dark" onclick="openmodalCarouselimgnews('.$news_id.','.$i.')"></i></div>
                            </div>
                           ';
                         }elseif ($i == 0) {
                           $col='col-12';
                           $h_admin='150';
                           $imgnummore ='';
                           $zoomimgnews='
                           <div class="middlehoverimg">
                              <div class="txt20"><i class="fas fa-search-plus text-dark" onclick="openmodalCarouselimgnews('.$news_id.','.$i.')"></i></div>
                            </div>
                           ';
                         }elseif ($i > 3) {
                           $col='col-6';
                           $d_none ='d-none';
                           $imgnummore='<span class="overlay_img_news_more d-flex align-items-center justify-content-center txt16 p-0" onclick="openmodalCarouselimgnews('.$news_id.','.$i.')">+'.$total_array_img_more.'</span>';
                           $zoomimgnews='';
                         }
                       echo '
                       <div class="'.$col.' '.$d_none.' containerhoverimg p-1">
                         <div class="rounded-3 imagehoverimg" onclick="openmodalCarouselimgnews('.$news_id.','.$i.')" style="background-image:url(\'Img/ImgNews/'.trim($valueimg).'\');
                         height:'.$h_admin.'px;width:100%;background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
                         '.$zoomimgnews.' '.$imgnummore.'
                       </div>
                       ';
                      }
                    $i++;
                  }
                    echo'
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

<!-- ..............................................................modal editnews...................................................... -->

      <div class="modal fade" id="openmodaleditnews'.$news_id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
          <div class="modal-content border-0">
            <div class="bg-warning py-1">
              <h5 class="fw-bold text-white text-center txt16"><i class="fas fa-edit"></i> แก้ไขข้อมูลข่าว</h5>
            </div>
            <div class="modal-body">
              <form class="needs-validation" novalidate id="formeditnewsmodal'.$news_id.'" enctype="multipart/form-data">
                <input type="hidden" name="idnews" value="" id="idnews'.$news_id.'">
                <input type="hidden" name="imgname_array" value="" id="imgname_array'.$news_id.'">
                <input type="hidden" name="datapacknameimg" value="" id="datapacknameimg'.$news_id.'">
                <div class="row justify-content-center">
                  <div class="col-12">
                    <textarea class="form-control border-0 shadow-none txt14 border" name="news_content" placeholder="มีอะไรใหม่" id="edit_news_content'.$news_id.'"style="height: 120px" required>'.$news_content.'</textarea>
                    <div class="invalid-feedback txt13">
                      โปรดระบุเนื้อหาข่าว
                    </div>
                  </div>
                  <div class="col-auto me-auto py-2">
                    <div class="btn bg-light border text-dark txt12" onclick="addimage('.$news_id.')"><i class="fas fa-images"></i> เพิ่มรูปภาพ</div>
                  </div>
                  <div class="col-xl-4 col-5 py-2">
                    <input type="hidden" value="'.$news_allow.'" id="get_news_allow'.$news_id.'"/>
                    <select class="form-select btn-light border txt12 shadow-none" name="news_allow" id="ed_news_allow'.$news_id.'" aria-label="Floating label select example" required>
                      <option class="txt13" value="อนุญาต">อนุญาต</option>
                      <option class="txt13" value="ไม่อนุญาต">ไม่อนุญาต</option>
                    </select>
                  </div>
                </div>
                <div class="row justify-content-start px-3 my-3" id="image_preview2'.$news_id.'">
                  <div id="inputimage'.$news_id.'"></div>';
                  $iedit=0;
                  foreach ($news_imgs as $value_img_news_edit) {
                    echo '
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-3 ps-0 pe-2 pt-2 mb-2 position-relative shownoneimg" id="show_img_news'.$news_id.''.$iedit.'">
                      <div class="rounded-3" style="background-image:url(\'Img/ImgNews/'.trim($value_img_news_edit).'\');height:60;width:100%;background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
                      <button type="button" class="btn-close bg08 mtme_0 rounded-circle shadow-none txt10" onclick="deleteimgnews('.$news_id.',\''.$value_img_news_edit.'\','.$iedit.')"></button>
                    </div>
                    ';
                    $iedit++;
                  }
                echo '
                </div>

                <div class="modal-footer mt-2">
                  <!--<button type="reset"class="btn btn-primary text-white txt13 shadow-none" onclick="reseteditimgnews('.$news_id.')">รีเซ็ต</button>-->
                  <button type="button"class="btn btn-success text-white txt13 shadow-none" onclick="confirmeditimgnews('.$news_id.')">ยืนยัน</button>
                  <button type="button" class="btn btn-light border border-2 txt13 shadow-none" onclick="closemodaleditimgnews('.$news_id.')">ยกเลิก</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    ';
  }
  echo '</div>
      </div>
    </div>';
}else {
  echo '
      <div class="row justify-content-center">
        <div class="col-12 text-center py-3">
          <div class="txt13 text-danger mt-3">ไม่พบข้อมูลข่าว</div>
          <div class="txt10 text-secondary mb-4">
            ดูเหมือนว่าคุณจะไม่พบข้อมูลข่าว ลองใช้ข้อมูลวันที่ หรือ เวลา<br>สำหรับในการค้นหาครั้งต่อไป " โปรดลองอีกครั้ง "
          </div>
          <img src="Img/ImgWeb/2808164.png" class="col-xl-4 col-lg-5 col-sm-10 col-11"/>
        </div>
      </div>
  ';
}

 ?>


<!-- Modal insertnews-->
<div class="modal fade" id="insertnews" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content border-0">
      <div class="bg-success py-1">
        <h5 class="fw-bold text-white text-center txt16"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มข่าวสาร</h5>
      </div>
      <div class="modal-body">
        <form class="needs-validation" novalidate id="forminsertnewsmodal" enctype="multipart/form-data" action="Admin/ManageNews/InsertNews.php" method="POST">
          <div class="row">
            <div class="col-12">
              <textarea class="form-control border-0 shadow-none txt13" name="contentnews" placeholder="มีอะไรใหม่" id="insert_news_content" style="min-height:150px" required></textarea>
              <div class="invalid-feedback txt13">
                โปรดระบุเนื้อหาข่าว
              </div>
            </div>
            <div class="col-12">
              <input type="file" class="form-control d-none" id="insert_news_img" name="insertfileUpload[]" accept="image/png, image/gif, image/jpeg" multiple required/>
              <label class="my-2" for="insert_news_img"><div class="btn btn-light border txt12"><i class="fas fa-images"></i> เพิ่มรูปภาพ</div></label>
              <div class="invalid-feedback txt13">
                โปรดระบุรูปภาพสำหรับข่าวนี้
              </div>
            </div>
            <div class="col-12 text-center">
              <div class="row justify-content-start px-3" id="image_preview">

              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit"class="btn btn-success text-white txt13 shadow-none">ยืนยัน</button>
            <a href="#" class="btn btn-light border border-2 txt13 shadow-none" data-bs-toggle="modal" data-bs-dismiss="modal">ยกเลิก</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="openmodalimgnews" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content bg-carousel-news border-0">
      <div class="row justify-content-center">
        <div class="col-12 text-end pt-4 pe-4 position-absolute" style="z-index:999;">
            <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide border-0" data-bs-ride="carousel">
          <div class="carousel-indicators" id="img_news_carousel_bar"></div>
          <div class="carousel-inner" id="img_news_carousel"></div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
