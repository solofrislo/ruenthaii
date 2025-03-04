
  <div class="container-fluid py-xl-5 py-0 ">
    <div class="row justify-content-center">
      <div class="col-xl-7 col-12">
        <img class="img-fluid col-12"src="Img\ImgWeb\AdobeStock_173926593.png"  width="auto"/>
      </div>
    </div>
    <div class="row justify-content-center mt-2">
      <div class="col-xl-7 col-12">
        <div class="card border-0 shadow pb-2">
          <div class="card-body text-center">
            <h5 class="txt01 py-1 fw-bold txt20">ข่าวสารและกิจกรรม</h5>
            <div class="txt01 py-1 txt20">"คลินิกเเพทย์เเผนไทย"</div>
            <div class="row justify-content-center">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8  px-0">
                <input type="text"class="form-control py-1 shadow-none mt-2" id="search_news_menu" placeholder="ค้นหาข่าว">
              </div>
              <div class="col-auto px-0">
                <button type="button" class="btn btn-danger rounded-3 py-2 mt-2 ms-2 shadow-none"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-2 px-xl-3 px-2" id="show_news_menu">
      <?php require 'User/News/SelectManageNews.php'; ?>
    </div>
  </div>


  <div class="modal" id="openmodalimgnews_menu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content bg-carousel-news border-0">
        <div class="row justify-content-center">
          <div class="col-12 text-end pt-4 pe-4 position-absolute" style="z-index:999;">
              <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div id="carouselExampleIndicators_menu" class="carousel slide border-0" data-bs-ride="carousel">
            <div class="carousel-indicators" id="img_news_carousel_bar_menu"></div>
            <div class="carousel-inner" id="img_news_carousel_menu"></div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators_menu" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators_menu" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>

            
            
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="User/News/js/js.js"></script>



