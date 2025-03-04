    <?php 

    echo '<div class="background-1">';

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) { 
        require 'Connect.php';

        $id = intval($_POST['id']); 
        $Qurey_Clinic ="SELECT * FROM clinic WHERE clinic_id = ?";
        
        $stmt = mysqli_prepare($dbcon, $Qurey_Clinic);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result_Clinic = mysqli_stmt_get_result($stmt);

            if ($row_clinic = mysqli_fetch_assoc($result_Clinic))  {
                echo '
                <div class="container-fluid py-xl-5 py-lg-5 py-md-5 py-sm-5 py-3">
                    <div class="row justify-content-center px-0">
                        <div class="col-xl-8 col-12 px-2">
                            <div class="card rounded-3 shadow border-0">
                                <div class="card-body">
                                    <div class="row- justify-content-center">
                                        <div class="text-center mb-3">
                                            <img src="Img/ImgClinic/' . htmlspecialchars($row_clinic['head_img']) . '" class="img-fluid rounded-3" alt="Clinic Image">
                                        </div>';
                                        for ($i = 1; $i <= 5; $i++) {
                                            if (!empty($row_clinic["section_$i"]) || !empty($row_clinic["subhead_$i"])) {
                                                echo '<div class="col-12 mt-2 mb-2">
                                                        <div class="txt16 text-secondary px-4 mt-2" style="line-height:1.9;">
                                                            <strong class="txt18 txt01 fw-bold">' . htmlspecialchars($row_clinic["section_$i"]) . '</strong> ' . nl2br(htmlspecialchars_decode($row_clinic["subhead_$i"])) . '
                                                        </div>
                                                    </div>';
                                            }
                                        }
                                        echo'   
                                        <div class="container d-flex justify-content-center align-items-center">
                                            <div class="row justify-content-center">';

                                        $images = [
                                            ['src' => $row_clinic['image_1'], 'content' => $row_clinic['image_content_1']],
                                            ['src' => $row_clinic['image_2'], 'content' => $row_clinic['image_content_2']],
                                            ['src' => $row_clinic['image_3'], 'content' => $row_clinic['image_content_3']]
                                        ];

                                        $valid_images = array_filter($images, function ($img) {
                                            return !empty($img['src']); 
                                        });

                                        $count = count($valid_images);

                                        if ($count == 1) {
                                            $col_class = "col-md-12 col-sm-12 col-12 text-center"; 
                                        } elseif ($count == 2) {
                                            $col_class = "col-md-6 col-12 text-center"; 
                                        } else {
                                            $col_class = "col-md-4 col-12 text-center"; 
                                        }

                                        foreach ($valid_images as $image) {
                                            echo '<div class="' . $col_class . ' pt-2 text-center zoom-in">
                                                    <div class="p-2">
                                                        <img src="Img/ImgClinic/' . htmlspecialchars($image['src']) . '" 
                                                        class="img-fluid image-card rounded-3"
                                                        style="cursor: pointer; "
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#imageModal" 
                                                        onclick="openModalImage(this.src, \''.htmlspecialchars($image['content']) . '\')">
                                                        <div class="txt16 txt01 fw-bold pt-2">' . htmlspecialchars($image['content']) . '</div>
                                                        <div class="zoom-icon"><i class="fa fa-magnifying-glass""></i></div>
                                                    </div>
                                                </div>';
                                        }
                                        echo '
                                    </div>
                                        </div>
                                            <div class="col-12 mt-3 mb-3">
                                                <div class="txt18 txt01 fw-bold px-2 mt-2"> '.htmlspecialchars($row_clinic['Trast_1']).' </div>
                                            <div class="txt16 text-secondary px-4 mt-2 " style="line-height: 1.9;"> '.nl2br(htmlspecialchars_decode($row_clinic['subtrast_1'])).'</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid py-xl-5 py-lg-5 py-md-5 py-sm-5 py-3">
                    <div class="row justify-content-center px-0">
                        <div class="col-xl-8 col-12 px-2">
                            <div class="card rounded-3 shadow border-0">
                                <div class="card-body">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 text-center">
                                            <div class="p-2">
                                                <img src="Img/ImgClinic/'.htmlspecialchars($row_clinic['location_img']).'" class="Image rounded-3 w-100"/>
                                            </div>
                                        </div>
                                        <div class="col-xl-7 col-lg-6 col-md-6 col-sm-12 text-center text-lg-start">
                                            <div class="txt16 txt01 fw-bold text-center mt-3">สถานที่ให้บริการ ' . htmlspecialchars($row_clinic['clinic_name']) . '</div>
                                            <div class="txt16 txt01 fw-bold text-center mt-3"> '. htmlspecialchars($row_clinic['location_clinic']).' <i class="fa-solid fa-location-dot"></i></div>
                                            <div class="txt16 txt01 fw-bold mt-3">เปิดให้บริการ  (ในเวลาราชการ)</div>
                                            <p class="txt16 text-secondary mt-3">'.nl2br(htmlspecialchars_decode($row_clinic['opening_days'])) .'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>'; //Close Container
                
            } else {
                echo '
                <div class="txt18 fw-bold text-center ">ไม่พบข้อมูลคลินิก!</div>';
            }
        } else {
            echo '<div class="txt18 txt01 fw-bold text-center"> ไม่สามารถเชื่อมต่อฐานข้อมูลได้! </div>';
        }

    echo '</div>'; //Close Background
    // <-- Modal-Image -->
    ?>
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" class="img-fluid rounded modal-img">
                    <p id="modalImageContent" class="mt-2 txt20 fw-bold txt01"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Css -->
    <link rel="stylesheet" href="User/Clinic/css/Style.css">
    <!-- Javascirpt-Modal -->
    <script>
    function openModalImage(imageSrc, imageContent) {
        document.getElementById("modalImage").src = imageSrc;
        document.getElementById("modalImageContent").innerText = imageContent || '';
    }
    </script>

