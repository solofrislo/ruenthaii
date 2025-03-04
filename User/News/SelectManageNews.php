<?php
$cnt_check=0;
if (isset($_POST['search'])) {
  require '../../Connect.php';
  $search = $_POST['search'];
  if ($search !=='') {
      $cnt_check=1;
    $search = mysqli_real_escape_string($dbcon, $search);
    $qry_news_menu = "SELECT * FROM news WHERE news_allow ='อนุญาต' AND CONCAT_WS('', news_date, news_time, news_content, news_allow)
    LIKE '%".$search."%' ORDER BY news_id DESC LIMIT 10";
  }else {
      $cnt_check=2;
    $qry_news_menu = "SELECT * FROM news WHERE news_allow ='อนุญาต' ORDER BY news_id DESC LIMIT 10";
  }
}else {
    require 'Connect.php';
    $cnt_check=2;
    $qry_news_menu = "SELECT * FROM news WHERE news_allow ='อนุญาต' ORDER BY news_id DESC LIMIT 10";
}

$result_news_menu = mysqli_query($dbcon,$qry_news_menu);
$row_cnt_news_menu = mysqli_num_rows($result_news_menu);
$date_current = date('Y-m-d');
$date = date_create($date_current);
$d = date_format($date,"d");
$m = date_format($date,"m");
$Y = date_format($date,"Y")+543;
$datethai = $d.'/'.$m.'/'.$Y;
if ($row_cnt_news_menu > 0) {
  echo '<div class="row justify-content-center">
          <div class="col-xl-7 col-12">
            <div class="row justify-content-start">';
  $i_show = 1;
  $col='';
  while ($row_news_home = mysqli_fetch_array($result_news_menu,MYSQLI_ASSOC)) {
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

    if ($row_cnt_news_menu == 1) {
      if ($i_show == 1) {
        $col_news_show_home='col-6 col-lg-6 col-md-6 col-sm-6 col-12';
      }
    }elseif ($row_cnt_news_menu == 2) {
      if ($i_show == 1) {
        $col_news_show_home='col-6 col-lg-6 col-md-6 col-sm-6 col-12';
      }elseif ($i_show == 2) {
        $col_news_show_home='col-6 col-lg-6 col-md-6 col-sm-6 col-12';
      }
    }elseif ($row_cnt_news_menu == 3) {
      if ($i_show == 1) {
        $col_news_show_home='col-6 col-lg-6 col-md-6 col-sm-6 col-12';
      }elseif ($i_show == 2) {
        $col_news_show_home='col-6 col-lg-6 col-md-6 col-sm-6 col-12';
      }elseif ($i_show == 3) {
        $col_news_show_home='col-6 col-lg-6 col-md-6 col-sm-6 col-12';
      }
    }elseif ($row_cnt_news_menu > 3) {
      if ($i_show == 1) {
        $col_news_show_home='col-6 col-lg-6 col-md-6 col-sm-6 col-12';
      }elseif ($i_show == 2) {
        $col_news_show_home='col-6 col-lg-6 col-md-6 col-sm-6 col-12';
      }elseif ($i_show == 3) {
        $col_news_show_home='col-6 col-lg-6 col-md-6 col-sm-6 col-12';
      }elseif ($i_show == 4) {
        $col_news_show_home='col-6 col-lg-6 col-md-6 col-sm-6 col-12';
      }
    }



    echo '
    <div class="'.$col_news_show_home.' px-1  pt-2 d-flex align-items-stretch">
      <div class="card shadow col-12 border-0 pb-0">
        <div class="card-body pb-0">
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
            </div>
            <div class="col-auto btn txt13 text-end pe-3" id="btn_swhd_ctn_news'.$news_id.'" onclick="click_show_content_menu('.$news_id.')"><i class="fas fa-angle-down my-auto"></i> อ่านเพิ่มเติม</div>
            <div class="row justify-content-start my-0 text-break">
              <div class="col-auto ps-3 pe-0 txt13" id="click_show_content_menu'.$news_id.'" style=line-height:20px;>
                '.$news_content.'
              </div>
            </div>
          </div>

        <script>
            var el = document.getElementById(\'click_show_content_menu'.$news_id.'\');
            var divHeight = el.offsetHeight
            var lineHeight = parseInt(el.style.lineHeight);
            var lines = divHeight / lineHeight;
            if (lines > 2) {
                var element = document.getElementById("click_show_content_menu'.$news_id.'");
                element.classList.add("text-truncate1L");
                $(\'#btn_swhd_ctn_news'.$news_id.'\').show();
              }else {
                $(\'#btn_swhd_ctn_news'.$news_id.'\').hide();
              }
        </script>

          <div class="row justify-content-center">
            <div class="col-12 px-4 pt-1 pb-3">
              <div class="row justify-content-start">';
              $i=0;
                foreach ($news_imgs as $valueimg) {
                  $d_none ='d-none';
                  $total_array_img_more = $cnt_img_array - 3;
                  $col='';
                  $h_admin='';
                  $imgnummore='<span class="overlay_img_news_more d-flex align-items-center justify-content-center txt16 p-0" onclick="openmodalCarouselimgnews_menu('.$news_id.','.$i.')">+'.$total_array_img_more.'</span>';
                  $zoomimgnews='
                  <div class="middlehoverimg">
                     <div class="txt20"><i class="fas fa-search-plus text-dark" onclick="openmodalCarouselimgnews_menu('.$news_id.','.$i.')"></i></div>
                   </div>
                  ';
                    if (sizeof($news_imgs) == 1) {
                      if ($row_cnt_news_menu == 1) {
                        $h_admin='410';
                      }elseif ($row_cnt_news_menu==2) {
                        $h_admin='410';
                      }
                      elseif ($row_cnt_news_menu==3) {
                        $h_admin='410';
                      }elseif ($row_cnt_news_menu > 3) {
                        $h_admin='410';
                      }
                      echo '
                      <div class="col-12 p-0 containerhoverimg pt-1 pb-0">
                        <div class="rounded-3 imagehoverimg" onclick="openmodalCarouselimgnews_menu('.$news_id.','.$i.')" style="background-image:url(\'Img/ImgNews/'.trim($valueimg).'\');
                        height:'.$h_admin.'px;width:100%;background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
                        <div class="middlehoverimg">
                           <div class="txt20"><i class="fas fa-search-plus text-dark" onclick="openmodalCarouselimgnews_menu('.$news_id.','.$i.')"></i></div>
                         </div>
                        </div>
                      ';

                    }else if (sizeof($news_imgs) == 2) {
                      if ($row_cnt_news_menu==1) {
                        if ($i==0) {
                          $col='col-12';
                          $h_admin='200';
                        }elseif ($i == 1) {
                          $col='col-12';
                          $h_admin='200';
                        }
                      }elseif ($row_cnt_news_menu==2) {
                        if ($i==0) {
                          $col='col-12';
                          $h_admin='200';
                        }elseif ($i == 1) {
                          $col='col-12';
                          $h_admin='200';
                        }
                      }elseif ($row_cnt_news_menu==3) {
                        if ($i==0) {
                          $col='col-12';
                          $h_admin='200';
                        }elseif ($i == 1) {
                          $col='col-12';
                          $h_admin='200';
                        }
                      }elseif ($row_cnt_news_menu > 3) {
                        if ($i==0) {
                          $col='col-12';
                          $h_admin='200';
                        }elseif ($i == 1) {
                          $col='col-12';
                          $h_admin='200';
                        }
                      }
                      echo '
                      <div class="'.$col.' p-0 containerhoverimg p-1">
                        <div class="rounded-3 imagehoverimg" onclick="openmodalCarouselimgnews_menu('.$news_id.','.$i.')"style="background-image:url(\'Img/ImgNews/'.trim($valueimg).'\');
                        height:'.$h_admin.'px;width:100%;background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
                        <div class="middlehoverimg">
                           <div class="txt20"><i class="fas fa-search-plus text-dark" onclick="openmodalCarouselimgnews_menu('.$news_id.','.$i.')"></i></div>
                         </div>
                           <div class="text-center mt-2">
                      </div>
                      ';
                    }elseif (sizeof($news_imgs) == 3) {
                      if ($row_cnt_news_menu==1) {
                        if ($i==0) {
                          $col='col-12';
                          $h_admin='300';
                        }elseif ($i == 1) {
                          $col='col-6';
                          $h_admin='100';
                        }elseif ($i == 2) {
                          $col='col-6';
                          $h_admin='100';
                        }
                      }elseif ($row_cnt_news_menu==2) {
                        if ($i==0) {
                          $col='col-12';
                          $h_admin='300';
                        }elseif ($i == 1) {
                          $col='col-6';
                          $h_admin='100';
                        }elseif ($i == 2) {
                          $col='col-6';
                          $h_admin='100';
                        }
                      }elseif ($row_cnt_news_menu==3) {
                        if ($i==0) {
                          $col='col-12';
                          $h_admin='300';
                        }elseif ($i == 1) {
                          $col='col-6';
                          $h_admin='100';
                        }elseif ($i == 2) {
                          $col='col-6';
                          $h_admin='100';
                        }
                      }elseif ($row_cnt_news_menu > 3) {
                        if ($i==0) {
                          $col='col-12';
                          $h_admin='300';
                        }elseif ($i == 1) {
                          $col='col-6';
                          $h_admin='100';
                        }elseif ($i == 2) {
                          $col='col-6';
                          $h_admin='100';
                        }
                      }
                        echo '
                        <div class="'.$col.' p-0 containerhoverimg p-1">
                          <div class="rounded-3 imagehoverimg" onclick="openmodalCarouselimgnews_menu('.$news_id.','.$i.')"style="background-image:url(\'Img/ImgNews/'.trim($valueimg).'\');
                          height:'.$h_admin.'px;width:100%;background-repeat: no-repeat;background-size: cover;background-position: center;"></div>
                          <div class="middlehoverimg">
                             <div class="txt20"><i class="fas fa-search-plus text-dark" onclick="openmodalCarouselimgnews_menu('.$news_id.','.$i.')"></i></div>
                           </div>
                        </div>
                        ';
                    }elseif (sizeof($news_imgs) >3) {
                      if ($row_cnt_news_menu==1) {
                        if ($i==0) {
                          $col='col-12';
                          $h_admin='300';
                          $d_none='';
                          $imgnummore ='';
                        }elseif ($i == 1) {
                          $col='col-4';
                          $h_admin='130';
                          $d_none='';
                          $imgnummore ='';
                        }elseif ($i == 2) {
                          $col='col-4';
                          $h_admin='130';
                          $d_none='';
                          $imgnummore ='';
                        }elseif ($i == 3) {
                          $col='col-4';
                          $h_admin='130';
                          $zoomimgnews='';
                          $d_none='';
                        }
                      }elseif ($row_cnt_news_menu==2) {
                        if ($i==0) {
                          $col='col-12';
                          $h_admin='300';
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
                      }elseif ($row_cnt_news_menu==3) {
                        if ($i==0) {
                          $col='col-12';
                          $h_admin='300';
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
                      }elseif ($row_cnt_news_menu > 3) {
                        if ($i==0) {
                          $col='col-12';
                          $h_admin='300';
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
                      }
                     echo '
                     <div class="'.$col.' '.$d_none.' containerhoverimg p-1">
                       <div class="rounded-3 imagehoverimg" onclick="openmodalCarouselimgnews_menu('.$news_id.','.$i.')" style="background-image:url(\'Img/ImgNews/'.trim($valueimg).'\');
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

    $i_show ++;
  }
  echo '
      </div>
    </div>
  </div>
  ';
}else {
  if ($cnt_check==1) {
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
  }elseif ($cnt_check==2) {
    echo '
      <div class="row justify-content-center">
        <div class="col-xl-7 col-12">
          <div class="row justify-content-center">
            <div class="col-12 px-1 d-flex align-items-stretch">
              <div class="card shadow border-0 col-12 px-0">
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
                    <div class="col-auto px-1 mt-2 txt13 text-start">
                      <span class="text-secondary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คลินิกแพทย์แผนไทย โรงพยาบาลมหาราชนครราชสีมา ตั้งอยู่ที่ <i class="fa fa-map-marker txt01" aria-hidden="true"></i> เลขที่ 49 ถนน ช้างเผือก ตำบลในเมือง อำเภอเมืองนครราชสีมา จังหวัดนครราชสีมา รหัสไปรษณีย์ 30000</span>
                    </div>
                    <div class="col-12 px-1 text-center pb-2">
                      <img src="Img/ImgWeb/Screenshot 2022-01-05 155406.jpg" class="col-12 rounded-3"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    ';
  }
}
?>
