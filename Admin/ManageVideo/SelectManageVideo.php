    <?php
    require __DIR__ . '/../../Connect.php';

    if (isset($_POST['search']) && !empty($_POST['search'])) {
        $search = $_POST['search'];
        $search = mysqli_real_escape_string($dbcon, $search);
        $qry_video = "SELECT * FROM video 
                    WHERE CONCAT_WS('', video_date, video_time, video_content, video_link, video_status,video_file ,video_image) 
                    LIKE '%" . $search . "%' 
                    ORDER BY video_id DESC";
    } else {
        $qry_video = "SELECT * FROM video ORDER BY video_id DESC ";
    }

    $result_video = mysqli_query($dbcon, $qry_video);

    if (mysqli_num_rows($result_video) > 0) {
        echo '<div class="container-fluid mt-4 px-0">
            <div class="row justify-content-center">
                <div class="col-xl-11 col-lg-12 col-md-12 col-sm-12 col-12 pb-3">
                    <div class="card border-0 darker box">
                        <div class="card-body darker box">
                            <span class="fw-bold txt01" style="font-size:20px;">รายการคลิปวิดีโอ</span>
                            <div class="gradient-red mt-3 mb-3" style="height:3px;"></div>
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 g-3">'; 
                    $modal_edit = "";
                    while ($row_video = mysqli_fetch_array($result_video, MYSQLI_ASSOC)) {
                        $video_id = $row_video['video_id'];
                        $video_date = $row_video['video_date'];
                        $date = date_create($video_date);
                        $video_datethai = date_format($date, "d/m/") . (date_format($date, "Y") + 543);
                        $video_time = $row_video['video_time'];
                        $video_content = $row_video['video_content'];
                        $video_link = $row_video['video_link'];
                        $video_file = $row_video['video_file'];
                        $video_image = $row_video['video_image'];
            

                        echo '
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-2 px-1 d-flex align-items-stretch">
                            <div class="card shadow col-12 border-0">
                                <div class="card-body pb-2">
                                    <div class="row justify-content-start">
                                        <div class="col-auto pe-0">
                                            <div class="rounded-circle border" 
                                                style="background-image:url(\'Img/ImgWeb/logoadmin.png\');
                                                height:52px;width:52px;background-repeat:no-repeat;background-size:cover;background-position:center;"></div>
                                        </div>
                                        <div class="col-auto me-auto">
                                            <div class="col-12 text-start txt13 fw-bold">Admin</div>
                                            <div class="col-12 text-start text-secondary txt10">' . $video_datethai . '</div>
                                        </div>
                                        <div class="col-auto px-0">
                                            <button type="button" class="btn btn-danger border shadow-none txt11 p-1" onclick="deletevideo(' . $video_id . ')">
                                                <i class="far fa-trash-alt"></i> ลบ
                                            </button>
                                        </div>
                                        <div class="col-auto ps-1">
                                            <button type="button" class="btn btn-warning text-white border shadow-none txt11 p-1" data-bs-toggle="modal" data-bs-target="#editModal' . $video_id . '">
                                                <i class="fas fa-edit"></i> แก้ไข
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row justify-content-start mt-1 mb-3">
                                        <div class="col-12 ps-3 mt-2 txt13 text-truncate1L">' . $video_content . '</div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-12 px-0">';

                                if (!empty($video_image)) {
                                    echo '<div class="video-wrapper" id="videoWrapper_' . $video_id . '" onclick="showVideo(\'videoWrapper_' . $video_id . '\', \'videoPlayer_' . $video_id . '\')">
                                            <img class="w-100 rounded-3 video-thumbnail" height="240" src="Video/Video_image/' . $video_image . '" alt="ปกวิดีโอ">
                                            <div class="video-play-button">
                                                <i class="fas fa-play"></i>
                                            </div>
                                        </div>';
                                } 

                            if (!empty($video_link) || !empty($video_file)) {
                                echo '<div id="videoPlayer_' . $video_id . '" ' . (!empty($video_image) ? 'style="display:none;"' : '') . '>';
                                
                                if (!empty($video_link)) {
                                    echo '<iframe class="w-100 rounded-3" height="240" src="' . $video_link . '" frameborder="0" allowfullscreen></iframe>';
                                } elseif (!empty($video_file)) {
                                    echo '<video class="w-100 rounded-3" height="240" controls>
                                            <source src="Video/Video_upload/' . $video_file . '" type="video/mp4">
                                            เบราว์เซอร์ของคุณไม่รองรับวิดีโอนี้
                                        </video>';
                                }
                                echo '</div>';
                            }

                            echo '      
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

            // <---------------------------------------------- Modal แก้ไขวิดีโอ ---------------------------------------------->
            $modal_edit .= '
            <div class="modal fade" id="editModal' . $video_id . '" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title text-white fw-bold" id="editModalLabel">
                                <i class="fas fa-edit"></i> แก้ไขวิดีโอ
                            </h5>
                        </div>
                        <div class="modal-body">
                            <form id="editVideoForm' . $video_id . '" enctype="multipart/form-data" onsubmit="saveEditedVideo(event, ' . $video_id . ')">
                                <input type="hidden" name="video_id" value="' . $video_id . '">
            
                                <div class="mb-3">
                                    <label for="editUploadType' . $video_id . '" class="form-label">เลือกวิธีอัปโหลดวิดีโอ</label>
                                    <select id="editUploadType' . $video_id . '" class="form-control" name="editUploadType" onchange="toggleEditVideoFields(' . $video_id . ')">
                                        <option value="">-- กรุณาเลือก --</option>
                                        <option value="url" ' . (!empty($video_link) ? 'selected' : '') . '>อัปโหลดผ่านลิงก์ YouTube/Vimeo</option>
                                        <option value="file" ' . (!empty($video_file) ? 'selected' : '') . '>อัปโหลดไฟล์วิดีโอ</option>
                                    </select>
                                </div>
            
                                <div class="mb-3" id="editVideoLinkGroup' . $video_id . '" style="display: ' . (!empty($video_link) ? 'block' : 'none') . ';">
                                    <label for="videoLink' . $video_id . '" class="form-label">ลิงก์วิดีโอ</label>
                                    <input type="text" class="form-control" id="videoLink' . $video_id . '" name="video_link" value="' . $video_link . '">
                                </div>
            
                                <div class="mb-3" id="editVideoFileGroup' . $video_id . '" style="display: ' . (!empty($video_file) ? 'block' : 'none') . ';">
                                    <label for="videoFile' . $video_id . '" class="form-label">อัปโหลดวิดีโอใหม่</label><p class="text-danger txt13">*ขนาดไฟล์วิดีโอไม่เกิน 150MB (ไม่เกิน 10 นาที)</p>
                                    <input type="file" name="video_file" class="form-control" id="videoFile' . $video_id . '" accept="video/*">
                                </div>
            
                                <div class="mb-3">
                                    <label for="editVideoImage' . $video_id . '" class="form-label">อัปโหลดไฟล์ปกวิดีโอ (ถ้ามี)</label><p class="text-danger txt13">*ขนาดรูปภาพที่เหมาะสม 900 x 450 พิกเซล</p>
                                    <input type="file" name="video_image" class="form-control" id="editVideoImage' . $video_id . '" accept="image/*">
                                </div>
            
                                <div class="mb-3 text-center position-relative d-inline-block">
                                    <img id="editVideoImagePreview' . $video_id . '" src="' . (!empty($video_image) ? 'Video/Video_image/' . $video_image : '') . '" 
                                        alt="ตัวอย่างปกวิดีโอ" class="rounded border shadow-sm"
                                        style="max-width: 100%; ' . (!empty($video_image) ? '' : 'display: none;') . '">
                                    
                                    <button type="button" class="btn btn-danger btn-sm position-absolute" id="removeVideoImageBtn' . $video_id . '" 
                                        onclick="removeVideoImage(' . $video_id . ')" 
                                        style="top: 5px; right: 5px; border-radius: 100px; ' . (!empty($video_image) ? '' : 'display: none;') . '">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="mb-3">
                                    <label for="videoContent' . $video_id . '" class="form-label">เนื้อหาวิดีโอ</label>
                                    <textarea class="form-control" id="videoContent' . $video_id . '" name="video_content" rows="3">' . $video_content . '</textarea>
                                </div>
            
                                <div class="modal-footer d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">บันทึก</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>';
            
        }
        echo '</div></div></div></div></div>';

        echo $modal_edit;
           
    } else {
        echo '<div class="text-center py-3">
                <p class="txt18 txt01 fw-bold">ไม่พบวิดีโอ!</p>
                <p class="txt14 text-secondary">ดูเหมือนว่าคุณจะไม่พบข้อมูลวิดีโอ</p>
                <p class="txt14 text-secondary">ลองใช้ชื่อหัวข้อของวิดีโอ "โปรดลองอีกครั้ง"</p>
                <img src="Img/ImgWeb/2808164.png" class="img-fluid" alt="No Data" style="max-width: 400px;">
            </div>';
    }
    ?>
    <!-- Modal เพิ่มวิดีโอ -->
    <div class="modal fade" id="insertVideoModal" tabindex="-1" aria-labelledby="insertVideoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="insertVideoModalLabel">
                        <i class="fa fa-plus"></i> เพิ่มวิดีโอ
                    </h5>
                </div>
                <div class="modal-body">
                    <form id="videoForm" action="InsertManageVideo.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="uploadType" class="form-label">เลือกวิธีอัปโหลดวิดีโอ</label>
                            <select id="uploadType" class="form-control" name="uploadType" required>
                                <option value="" >-- กรุณาเลือก --</option>
                                <option value="url">อัปโหลดผ่านลิงก์ YouTube</option>
                                <option value="file">อัปโหลดไฟล์วิดีโอ</option>
                            </select>
                        </div>
                        <div class="mb-3" id="videoLinkGroup" style="display: none;">
                            <label for="video_link" class="form-label">ลิงก์วิดีโอ (YouTube)</label>
                            <input type="url" name="video_link" class="form-control" id="video_link"
                                placeholder="ใส่ลิงก์ YouTube ">
                        </div>
                        <div class="mb-3" id="videoFileGroup" style="display: none;">
                            <label for="video_file" class="form-label">อัปโหลดวิดีโอ</label>
                            <p class="text-danger txt13">*ขนาดไฟล์วิดีโอไม่เกิน 150MB (ไม่เกิน 10 นาที)</p>
                            <input type="file" name="video_file" class="form-control" id="video_file" accept="video/*">
                        </div>
                        <div class="mb-3">
                            <label for="video_image_file" class="form-label">อัปโหลดไฟล์ปกวิดีโอ (ถ้ามี)</label>
                            <p class="text-danger txt13">*ขนาดรูปภาพที่เหมาะสม 900 x 450 พิกเซล</p>
                            <input type="file" name="video_image" class="form-control" id="video_image_file"
                                accept="image/*">
                        </div>
                        <div class="mb-3 text-center">
                            <img id="video_image_preview" src="" alt="ตัวอย่างปกวิดีโอ"
                                style="max-width: 100%; display: none;">
                        </div>
                        <div class="mb-3">
                            <label for="videoDescription" class="form-label">คำอธิบายวิดีโอ</label>
                            <textarea name="video_content" class="form-control" id="videoDescription" rows="3"
                                placeholder="วิดีโอนี้เกี่ยวกับอะไร" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">บันทึก</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
