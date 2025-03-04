$('.activemenumanual').click(function() {
  $('#show_manual').html('');
  let cmmanual = $(this).attr('id');
  if (cmmanual=='activemenumanual1') {
    $('.activemenumanual').removeClass('text-white bg02').addClass('hover_border_red_txt_red_bg_white');
    $('#activemenumanual1').removeClass('hover_border_red_txt_red_bg_white').addClass('text-white bg02');
    $('#show_manual').append(
      '<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 mt-2">'+
        '<img src="Img/ImgManual/Main/0001.png" class="img-fluid shadow"/>'+
      '</div>'
    );
  }else if (cmmanual=='activemenumanual2') {
    $('.activemenumanual').removeClass('text-white bg02').addClass('hover_border_red_txt_red_bg_white');
    $('#activemenumanual2').removeClass('hover_border_red_txt_red_bg_white').addClass('text-white bg02');
    $('#show_manual').append(
      '<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 mt-2">'+
        '<img src="Img/ImgManual/Reserve/0001.png" class="img-fluid shadow"/>'+
        '<img src="Img/ImgManual/Reserve/0002.png" class="img-fluid shadow mt-2"/>'+
      '</div>'
    );
  }else if (cmmanual=='activemenumanual3') {
    $('.activemenumanual').removeClass('text-white bg02').addClass('hover_border_red_txt_red_bg_white');
    $('#activemenumanual3').removeClass('hover_border_red_txt_red_bg_white').addClass('text-white bg02');
    $('#show_manual').append(
      '<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 mt-2">'+
        '<img src="Img/ImgManual/User/0001.png" class="img-fluid shadow"/>'+
        '<img src="Img/ImgManual/User/0002.png" class="img-fluid shadow mt-2"/>'+
      '</div>'
    );
  }else if (cmmanual=='activemenumanual4') {
    $('.activemenumanual').removeClass('text-white bg02').addClass('hover_border_red_txt_red_bg_white');
    $('#activemenumanual4').removeClass('hover_border_red_txt_red_bg_white').addClass('text-white bg02');
    $('#show_manual').append(
      '<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 mt-2">'+
        '<img src="Img/ImgManual/Doctor/0001.png" class="img-fluid shadow"/>'+
        '<img src="Img/ImgManual/Doctor/0002.png" class="img-fluid shadow mt-2"/>'+
      '</div>'
    );
  }else if (cmmanual=='activemenumanual5') {
    $('.activemenumanual').removeClass('text-white bg02').addClass('hover_border_red_txt_red_bg_white');
    $('#activemenumanual5').removeClass('hover_border_red_txt_red_bg_white').addClass('text-white bg02');
    $('#show_manual').append(
      '<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 mt-2">'+
        '<img src="Img/ImgManual/Date/0001.png" class="img-fluid shadow"/>'+
        '<img src="Img/ImgManual/Date/0002.png" class="img-fluid shadow mt-2"/>'+
      '</div>'
    );
  }else if (cmmanual=='activemenumanual6') {
    $('.activemenumanual').removeClass('text-white bg02').addClass('hover_border_red_txt_red_bg_white');
    $('#activemenumanual6').removeClass('hover_border_red_txt_red_bg_white').addClass('text-white bg02');
    $('#show_manual').append(
      '<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 mt-2">'+
        '<img src="Img/ImgManual/News/0001.png" class="img-fluid shadow"/>'+
        '<img src="Img/ImgManual/News/0002.png" class="img-fluid shadow mt-2"/>'+
      '</div>'
    );
  }else if (cmmanual=='activemenumanual7') {
    $('.activemenumanual').removeClass('text-white bg02').addClass('hover_border_red_txt_red_bg_white');
    $('#activemenumanual7').removeClass('hover_border_red_txt_red_bg_white').addClass('text-white bg02');
    $('#show_manual').append(
      '<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 mt-2">'+
        '<img src="Img/ImgManual/Report/0001.png" class="img-fluid shadow"/>'+
        '<img src="Img/ImgManual/Report/0002.png" class="img-fluid shadow mt-2"/>'+
      '</div>'
    );
  }else if (cmmanual=='activemenumanual8') {  
    $('.activemenumanual').removeClass('text-white bg02').addClass('hover_border_red_txt_red_bg_white');
    $('#activemenumanual8').removeClass('hover_border_red_txt_red_bg_white').addClass('text-white bg02');
    $('#show_manual').append(
      '<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 mt-2">'+
        '<img src="Img/ImgManual/Banner/00001.png" class="img-fluid shadow"/>'+
        '<img src="Img/ImgManual/Banner/00002.png" class="img-fluid shadow mt-2"/>'+
      '</div>'
    );
  }else if (cmmanual=='activemenumanual9') {
    $('.activemenumanual').removeClass('text-white bg02').addClass('hover_border_red_txt_red_bg_white');
    $('#activemenumanual9').removeClass('hover_border_red_txt_red_bg_white').addClass('text-white bg02');
    $('#show_manual').append(
      '<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 mt-2">'+
        '<img src="Img/ImgManual/Video/0001.png" class="img-fluid shadow"/>'+
        '<img src="Img/ImgManual/Video/0002.png" class="img-fluid shadow mt-2"/>'+
      '</div>'
    );
  }else if (cmmanual=='activemenumanual10') {
    $('.activemenumanual').removeClass('text-white bg02').addClass('hover_border_red_txt_red_bg_white');
    $('#activemenumanual10').removeClass('hover_border_red_txt_red_bg_white').addClass('text-white bg02');
    $('#show_manual').append(
      '<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 mt-2">'+
        '<img src="Img/ImgManual/Clinic/0001.png" class="img-fluid shadow"/>'+
        '<img src="Img/ImgManual/Clinic/0002.png" class="img-fluid shadow mt-2"/>'+
        '<img src="Img/ImgManual/Clinic/0003.png" class="img-fluid shadow mt-2"/>'+
        '<img src="Img/ImgManual/Clinic/0004.png" class="img-fluid shadow mt-2"/>'+
      '</div>'
    );
  }
});
