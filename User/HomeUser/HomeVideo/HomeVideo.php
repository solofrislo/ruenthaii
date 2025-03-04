<div class="container-fluid pb-xl-5 pb-lg-5 pb-md-5 pb-sm-5 py-3">
    <a id="VideoManagement"></a>
    <div class="row justify-content-center">
        <div class="col-xl-8 col-12 px-2">
            <div class="card rounded-3 shadow border-0">
                <div class="card-body pt-0">
                    <div class="row justify-content-center mt-2">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 w-100">
                            <div id="carouselVideo" class="carousel slide carousel-video" data-bs-ride="carousel">
                                <div class="carousel-inner w-100">
                                    <?php
                                    $qry_video = "SELECT video_id, video_file, video_image, video_link, video_date, video_content FROM video ORDER BY video_id DESC LIMIT 3";
                                    $result_video = mysqli_query($dbcon, $qry_video);
                                    $is_active = true;

                                    if (mysqli_num_rows($result_video) > 0) {
                                        while ($row_video = mysqli_fetch_array($result_video, MYSQLI_ASSOC)) {
                                            $video_id = $row_video['video_id'];
                                            $video_content = htmlspecialchars($row_video['video_content']);
                                            $video_link = htmlspecialchars($row_video['video_link']);
                                            $video_date = date_create($row_video['video_date']);
                                            $video_datethai = date_format($video_date, "d/m/") . (date_format($video_date, "Y") + 543);
                                            $video_file = htmlspecialchars($row_video['video_file']);
                                            $video_image = htmlspecialchars($row_video['video_image']);

                                            echo '
                                            <div class="carousel-item ' . ($is_active ? 'active' : '') . '">
                                                <div class="card shadow-sm" style="border: none;">
                                                    <div class="card-header bg-white d-flex align-items-center" style="border: none;">
                                                        <div class="rounded-circle border me-2" style="background-image:url(\'Img/ImgWeb/logoadmin.png\');
                                                            height:52px;width:52px;background-repeat:no-repeat;background-size:cover;background-position:center;">
                                                        </div>
                                                        <div>
                                                            <span class="txt01 txt13 fw-bold">คลินิกเเพทย์เเผนไทย</span><br>
                                                            <small class="text-secondary txt10"> ' . $video_datethai . '</small>
                                                        </div>
                                                    </div>
                                                    <div class="card-body text-center">';

                                            if (!empty($video_image)) {
                                                echo '
                                                <div class="video-wrapper" id="videoWrapper_' . $video_id . '" onclick="showVideo(\'videoWrapper_' . $video_id . '\', \'videoPlayer_' . $video_id . '\')">
                                                    <img class="w-100 rounded-3 video-thumbnail" style="aspect-ratio: 16/9;" max-width: 100%;" src="Video/Video_image/' . $video_image . '" alt="ปกวิดีโอ">
                                                    <div class="video-play-button">
                                                        <i class="fas fa-play"></i>
                                                    </div>
                                                </div>';
                                            }

                                            echo '<div id="videoPlayer_' . $video_id . '" ' . (!empty($video_image) ? 'style="display:none;"' : '') . '>';

                                            if (!empty($video_link)) {
                                                echo '<iframe class="w-100 rounded-3" style="aspect-ratio: 16/9;" max-width: 100%;" src="' . $video_link . '" frameborder="0" allowfullscreen></iframe>';
                                            } elseif (!empty($video_file)) {
                                                echo '<video class="w-100 rounded-3" style="aspect-ratio: 16/9;" max-width: 100%;" controls>
                                                        <source src="Video/Video_upload/' . $video_file . '" type="video/mp4">
                                                        เบราว์เซอร์ของคุณไม่รองรับวิดีโอนี้
                                                      </video>';
                                            }

                                            echo '</div>
                                                    </div>
                                                    <div class="card-body text-center">
                                                        <span class="txt01 fw-bold">' . htmlspecialchars_decode($video_content, ENT_QUOTES) . '</span>
                                                    </div>
                                                </div>
                                            </div>';
                                            $is_active = false;
                                        }
                                    } else {
                                        echo '
                                        <div class="carousel-item active">
                                            <div class="card shadow-sm text-center border-0">
                                                <div class="card-body d-flex flex-column align-items-center justify-content-center" style="height: 250px;">
                                                    <p class="text-secondary mb-0">ไม่มีวิดีโอในระบบ</p>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                    ?>
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselVideo"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">ย้อนกลับ</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselVideo"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">ถัดไป</span>
                                </button>

                            </div>
                        </div>
                        <div class="col-12 px-2">
                            <div class="gradient-red" style="height:3px;"></div>
                        </div>
                        <div class="col-12 text-end px-1 my-2 zoom1">
                            <a class="txt01 text-decoration-none  pe-4 fw-bold a_hover_red txt13"
                                href="Index.php?action=Video">วิดีโออื่นๆ <i class="fas fa-chevron-right"></i><i
                                    class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Style-Video -->
<link rel="stylesheet" href="User/HomeUser/HomeVideo/css/Style.css">
<!-- Javascirpt -->
<script src="User/HomeUser/HomeVideo/Js/show_video.js"></script>
