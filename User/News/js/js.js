$("#search_news_menu").keyup(function(){
  console.log($(this).val());
  $("#show_news_menu").load("User/News/SelectManageNews.php",{search: $("#search_news_menu").val()});
});

let cntbtnmore = 0;
function click_show_content_menu(id) {
let idnews = id;
  if (cntbtnmore == 0) {
    cntbtnmore = 1;
    $('#btn_swhd_ctn_news'+idnews).html('<i class="fas fa-angle-up my-auto"></i> ย่อเนื้อหา');
    $('#click_show_content_menu'+idnews).removeClass('text-truncate1L');
  }else if (cntbtnmore == 1) {
    cntbtnmore = 0;
    $('#btn_swhd_ctn_news'+idnews).html('<i class="fas fa-angle-down my-auto"></i> อ่านเพิ่มเติม');
    $('#click_show_content_menu'+idnews).addClass('text-truncate1L');
  }
}

function openmodalCarouselimgnews_menu(id, i) {
  let li = i;
  let newsid = id;
  $('#img_news_carousel_menu').html('');
  $('#img_news_carousel_bar_menu').html('');
  $.ajax({
    url: "User/News/Selectimgnews.php",
    type: "POST",
    data: {'newsid':newsid},
    datatype: 'html',
    cache: false,
    success: function(data){
      img_carousel_array = data.split(',');
      for (var i = 0; i < img_carousel_array.length; i++) {
        let active ='';
        let d_none = '';
        if (i == li) {
          active = 'active';
        }else{
          active = '';
        }
        $('#img_news_carousel_bar_menu').append(
          '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'+i+'" class="clearactive '+active+'" aria-current="true" aria-label="Slide'+i+'"></button>'
        );
        $('#img_news_carousel_menu').append(
        '<div class="clearactive carousel-item text-center position-relative '+active+'" style="height:100vh;">'+
          '<img src="Img/ImgNews/'+img_carousel_array[i]+'" class="img_news_carousel d-block middle" />'+
        '</div>'
        );
      }
    }
  })
  $('#openmodalimgnews_menu').modal('show');
}
