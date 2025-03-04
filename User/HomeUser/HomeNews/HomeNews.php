
  <div class="container-fluid pb-xl-5 pb-lg-5 pb-md-5 pb-sm-5 py-3">
    <a id="News"></a>
    <div class="row justify-content-center" id="row_news_home">
      <div class="col-xl-8 col-12 px-2">
        <div class="card rounded-3 shadow border-0">
          <div class="card-body pt-0">
            <div class="row justify-content-center mt-2">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <?php
                $qry_news_home = "SELECT * FROM news WHERE news_allow ='อนุญาต' ORDER BY news_id DESC LIMIT 1";
                $result_news_home = mysqli_query($dbcon,$qry_news_home);
                $row_cnt_news_home = mysqli_num_rows($result_news_home);
                $date_current = date('Y-m-d');
                $date = date_create($date_current);
                $d = date_format($date,"d");
                $m = date_format($date,"m");
                $Y = date_format($date,"Y")+543;
                $datethai = $d.'/'.$m.'/'.$Y;
                if ($row_cnt_news_home > 0) {
                  while ($row_news_home = mysqli_fetch_array($result_news_home,MYSQLI_ASSOC)) {
                    $news_id = $row_news_home['news_id'];
                    $news_date = $row_news_home['news_date'];
                    $date = date_create($news_date);
                    $d = date_format($date,"d");
                    $m = date_format($date,"m");
                    $Y = date_format($date,"Y")+543;
                    $news_datethai = $d.'/'.$m.'/'.$Y;
                    $news_time = $row_news_home['news_time'];
                    $news_content = $row_news_home['news_content'];
                    $news_img = $row_news_home['news_img'];
                    $news_imgs = explode(',' ,$news_img);
                    $news_imgs=array_filter($news_imgs);
                    $cnt_img_array = count($news_imgs);
                    $news_allow = $row_news_home['news_allow'];
                    if ($news_allow == 'อนุญาต') {
                      $news_allow_show = '<span class="rounded-pill px-2 text-white bg-success txt10">อนุญาต</span>';
                    }elseif ($news_allow == 'ไม่อนุญาต') {
                        $news_allow_show = '<span class="rounded-pill px-2 text-white bg-danger txt10">ไม่อนุญาต</span>';
                    }
                    echo '
                    <div class="col-12 pt-2 d-flex align-items-stretch">
                      <div class="card shadow-none border-0 col-12 px-0">
                        <div class="card-body pb-0 px-1 py-1">
                          <div class="row justify-content-start">
                            <div class="col-auto pe-0">
                              <div class="rounded-circle border" style="background-image:url(\'Img/ImgWeb/logoadmin.png\');height:52px;width:52px;background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
                            </div>
                            <div class="col-auto me-auto">
                              <div class="col-12 text-start txt13 fw-bold txt01">
                                คลินิกแพทย์แผนไทย
                              </div>
                              <div class="col-12 text-start text-secondary txt10">
                                '.$news_datethai.'
                              </div>
                            </div>
                            <div class="col-auto btn txt13 text-end pe-3" id="btn_swhd_ctn_news'.$news_id.'" onclick="click_show_content('.$news_id.')"><i class="fas fa-angle-down my-auto"></i> อ่านเพิ่มเติม</div>
                            <div class="row justify-content-start my-0 text-break">
                              <div class="col-auto ps-3 col-12  mt-2 txt12" id="click_show_content'.$news_id.'" style="line-height: 1.6; text-align: justify;">
                                '.$news_content.'
                              </div>
                            </div>
                          </div>

                          <script>
                              var el = document.getElementById(\'click_show_content'.$news_id.'\');
                              var divHeight = el.offsetHeight
                              var lineHeight = parseInt(el.style.lineHeight);
                              var lines = divHeight / lineHeight;
                              if (lines > 2) {
                                  var element = document.getElementById("click_show_content'.$news_id.'");
                                  element.classList.add("text-truncate1L");
                                  $(\'#btn_swhd_ctn_news'.$news_id.'\').show();
                                }else {
                                  $(\'#btn_swhd_ctn_news'.$news_id.'\').hide();
                                }
                          </script>

                          <div class="row justify-content-center">
                            <div class="col-12 px-4 py-1">
                              <div class="row justify-content-start">';
                              $i=0;
                                foreach ($news_imgs as $valueimg) {
                                  $d_none ='d-none';
                                  $total_array_img_more = $cnt_img_array - 3;
                                  $col='';
                                  $h_admin='';
                                  $imgnummore='<span class="overlay_img_news_more d-flex align-items-center justify-content-center txt16 p-0" onclick="openmodalCarouselimgnewshome('.$news_id.','.$i.')">+'.$total_array_img_more.'</span>';
                                  $zoomimgnews='
                                  <div class="middlehoverimg">
                                    <div class="txt20"><i class="fas fa-search-plus text-dark" onclick="openmodalCarouselimgnewshome('.$news_id.','.$i.')"></i></div>
                                  </div>
                                  ';
                                    if (sizeof($news_imgs) == 1) {
                                        $h_admin='350';
                                      echo '
                                      <div class="col-12 p-0 containerhoverimg pt-1 pb-0">
                                        <div class="rounded-3 imagehoverimg" onclick="openmodalCarouselimgnewshome('.$news_id.','.$i.')" style="background-image:url(\'Img/ImgNews/'.trim($valueimg).'\');
                                        height:'.$h_admin.'px;width:100%;background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
                                        '.$zoomimgnews.'
                                      </div>
                                      ';
                                    }else if (sizeof($news_imgs) == 2) {
                                        if ($i==0) {
                                          $col='col-12';
                                          $h_admin='175';
                                        }elseif ($i == 1) {
                                          $col='col-12';
                                          $h_admin='175';
                                        }
                                      echo '
                                      <div class="'.$col.' p-0 containerhoverimg p-1">
                                        <div class="rounded-3 imagehoverimg" onclick="openmodalCarouselimgnewshome('.$news_id.','.$i.')"style="background-image:url(\'Img/ImgNews/'.trim($valueimg).'\');
                                        height:'.$h_admin.'px;width:100%;background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
                                        '.$zoomimgnews.'
                                      </div>
                                      ';
                                    }elseif (sizeof($news_imgs) == 3) {
                                        if ($i==0) {
                                          $col='col-12';
                                          $h_admin='250';
                                        }elseif ($i == 1) {
                                          $col='col-6';
                                          $h_admin='100';
                                        }elseif ($i == 2) {
                                          $col='col-6';
                                          $h_admin='100';
                                        }
                                        echo '
                                        <div class="'.$col.' p-0 containerhoverimg p-1">
                                          <div class="rounded-3 imagehoverimg p-0" onclick="openmodalCarouselimgnewshome('.$news_id.','.$i.')"style="background-image:url(\'Img/ImgNews/'.trim($valueimg).'\');
                                          height:'.$h_admin.'px;width:100%;background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
                                          '.$zoomimgnews.'
                                        </div>
                                        ';
                                    }elseif (sizeof($news_imgs) >3) {
                                        if ($i==0) {
                                          $col='col-12';
                                          $h_admin='250';
                                          $d_none='';
                                          $imgnummore ='';
                                        }elseif ($i == 1) {
                                          $col='col-4';
                                          $h_admin='100';
                                          $d_none='';
                                          $imgnummore ='';
                                        }elseif ($i == 2) {
                                          $col='col-4';
                                          $h_admin='100';
                                          $d_none='';
                                          $imgnummore ='';
                                        }elseif ($i == 3) {
                                          $col='col-4';
                                          $h_admin='100';
                                          $zoomimgnews='';
                                          $d_none='';
                                        }
                                    echo '
                                    <div class="'.$col.' '.$d_none.' containerhoverimg p-1">
                                      <div class="rounded-3 imagehoverimg p-0" onclick="openmodalCarouselimgnewshome('.$news_id.','.$i.')" style="background-image:url(\'Img/ImgNews/'.trim($valueimg).'\');
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
                    ';
                  }
                }else {
                  echo'
                  <div class="col-12 mb-2">
                    <div class="card shadow-none border-0 col-12 px-0">
                      <div class="card-body pb-0 px-1 py-1">
                        <div class="row justify-content-center">
                          <div class="col-auto pe-0">
                            <div class="rounded-circle border" style="background-image:url(\'Img/ImgWeb/logoadmin.png\');height:52px;width:52px;background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
                          </div>
                          <div class="col-auto me-auto">
                            <div class="col-12 text-start txt13 fw-bold txt01">
                              คลินิกแพทย์แผนไทย
                            </div>
                            <div class="col-12 text-start text-secondary txt10">
                              '.$datethai.'
                            </div>
                          </div>
                          <div class="row justify-content-center">
                            <div class="col-auto px-1 mt-2 txt13">
                              <span class="text-secondary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คลินิกแพทย์แผนไทย โรงพยาบาลมหาราชนครราชสีมา ตั้งอยู่ที่ <i class="fa fa-map-marker txt01" aria-hidden="true"></i> เลขที่ 49 ถนน ช้างเผือก ตำบลในเมือง อำเภอเมืองนครราชสีมา จังหวัดนครราชสีมา รหัสไปรษณีย์ 30000</span>
                            </div>
                            <div class="col-12 px-1 text-center">
                              <img src="Img/ImgWeb/Screenshot 2022-01-05 155406.jpg" class="col-12 rounded-3"/>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  ';
                }
                ?>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 text-center pt-2 d-xl-block d-lg-block d-md-block d-sm-none d-none">
                <span class="txt01 fw-bold text-center txt18 col-12"> ข่าวสารและกิจกรรม</span><br />
                <span class="text-secondary text-center txt13 col-12"> คลินิกแพทย์แผนไทย โรงพยาบาลมหาราชนครราชสีมา</span>
                <div class="py-5 col-12"style="background-image:url(Img/ImgWeb/2663445.png);background-repeat: no-repeat;background-size:90%;background-position: center;height:100%;"></div>
              </div>
            </div>
          </div>
          <div class="col-12 px-2">
            <div class="gradient-red" style="height:3px;"></div>
          </div>
          <div class="col-12 text-end px-1 my-2 zoom1">
            <a class="txt01 text-decoration-none pe-4 fw-bold a_hover_red txt13" href="Index.php?action=News">ข่าวสารและกิจกรรมอื่น ๆ <i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="openmodalimgnews_home" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content bg-carousel-news border-0">
        <div class="row justify-content-center">
          <div class="col-12 text-end pt-4 pe-5 position-absolute" style="z-index:999;">
              <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div id="carouselExampleIndicators_home" class="carousel slide border-0" data-bs-ride="carousel">
            <div class="carousel-indicators" id="img_news_carousel_bar_home"></div>
            <div class="carousel-inner" id="img_news_carousel_home"></div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators_home" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators_home" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="User/HomeUser/HomeNews/js/js.js"></script>
