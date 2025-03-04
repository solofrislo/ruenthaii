<div class="container-fluid">
  <div class="row justify-content-center mt-xl-5 mt-lg-5 mt-sm-5 mt-3">
    <div class="col-12 pb-5">
      <div class="h5 txt01 fw-bold text-center">
        จัดการข้อมูลข่าว
      </div>
      <div class="row justify-content-center py-0 mt-3">
        <div class="col-12 text-center">
          <div class="row justify-content-center">
            <div class="col-12 text-center">
              <div class="card border-0">
                <div class="card-body">
                  <div class="row justify-content-center">
                  <div class="col-xl-6 col-lg-6 col-sm-8 col-10 pe-0 mb-3">
                  <input type="text"class="form-control py-1 shadow" id="search_news" placeholder="ค้นหาข่าว">
                  </div>
                    <div class="col-auto px-1">
                      <button type="button" class="btn btn-success rounded-3 py-2 shadow" data-bs-toggle="modal" data-bs-target="#insertnews"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-auto ps-0 pe-1">
                      <a  href="Admin.php?action=ManageNews" class="btn btn-primary rounded-3 py-2 shadow"><i class="far fa-newspaper"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="show_news">
        <?php require 'Admin/ManageNews/SelectManageNews.php'; ?>
      </div>
    </div>
  </div>
</div>





<script src="Admin/ManageNews/Newsjs.js"></script>

