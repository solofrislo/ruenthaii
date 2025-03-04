<?php
require __DIR__ . '/../../Connect.php';

$search = isset($_POST['search']) ? mysqli_real_escape_string($dbcon, $_POST['search']) : '';

if ($search) {
    $qry_Video = "SELECT * FROM video 
                  WHERE CONCAT_WS('', video_date, video_time, video_content, video_link, video_file, video_image) 
                  LIKE '%$search%' 
                  ORDER BY video_id DESC";
} else {
    $qry_Video = "SELECT * FROM video ORDER BY video_id DESC";
}

$result_video = mysqli_query($dbcon, $qry_Video);

if (mysqli_num_rows($result_video) > 0) {
    echo '<div class="container py-5">
            <div class="row row-cols-1 row-cols-md-2 g-4">';
    while ($row_video = mysqli_fetch_array($result_video, MYSQLI_ASSOC)) {
        $video_id = $row_video['video_id'];
        $video_content = $row_video['video_content'];
        $video_link = $row_video['video_link'];
        $video_file = $row_video['video_file'];
        $video_image = $row_video['video_image'];

        echo '<div class="col-xl-6 col-md-6 col-sm-12 d-flex align-items-stretch">
                <div class="card card-effect shadow border-0 h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="text-center mb-3">';

        if (!empty($video_image)) {
            echo '<div class="video-wrapper" id="videoWrapper_' . $video_id . '" onclick="showVideo(\'videoWrapper_' . $video_id . '\', \'videoPlayer_' . $video_id . '\')">
                    <img class="w-100 rounded-3 video-thumbnail" style="aspect-ratio: 16/9; max-width: 100%;" src="Video/Video_image/' . $video_image . '" alt="ปกวิดีโอ">
                    <div class="video-play-button">
                        <i class="fas fa-play"></i>
                    </div>
                  </div>';
        }

        echo '<div id="videoPlayer_' . $video_id . '" ' . (!empty($video_image) ? 'style="display:none;"' : '') . '>';

        if (!empty($video_link)) {
            echo '<iframe class="w-100 rounded-3" height="200" src="' . $video_link . '" frameborder="0" allowfullscreen></iframe>';
        } elseif (!empty($video_file)) {
            echo '<video class="w-100 rounded-3" height="200" controls>
                    <source src="Video/Video_upload/' . $video_file . '" type="video/mp4">
                    เบราว์เซอร์ของคุณไม่รองรับวิดีโอนี้
                  </video>';
        }

        echo '</div>
                </div>
                <h5 class="txt13 txt01 text-center">' . $video_content . '</h5>
            </div>
        </div>
    </div>';
    }
    echo '</div>
          </div>';
} else {
    echo '<div class="row justify-content-center">
            <div class="col-12 text-center py-3">
              <div class="txt13 text-danger mt-3">ไม่พบข้อมูลวิดีโอ</div>
              <div class="txt10 text-secondary mb-4">
                ดูเหมือนว่าคุณจะไม่พบข้อมูลวิดีโอ ลองใช้ข้อมูลหัวข้อของวิดีโอ <br>สำหรับในการค้นหาครั้งต่อไป "โปรดลองอีกครั้ง"
              </div>
              <img src="Img/ImgWeb/2808164.png" class="col-xl-4 col-lg-5 col-sm-10 col-11"/>
            </div>
          </div>';
}
?>

