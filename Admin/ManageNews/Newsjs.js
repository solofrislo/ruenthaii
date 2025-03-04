let countinput = 0;
function addimage(idnew) {
	countinput=countinput+1;
	$('#inputimage'+idnew).append('<input type="file" name="addimage[]" class="removeaddimg arrayname checkempty" id="addimage'+idnew+''+countinput+'">');
	$('#addimage'+idnew+''+countinput).click();
	$('#addimage'+idnew+''+countinput).hide();
	// let cnt_name_add_img = $('.arrayname');
	// alert('เพิ่ม'+cnt_name_add_img.length);
	$('.checkempty').change(function () {
		$(this).removeClass('checkempty');
	})
	callbackcount(idnew,countinput);
}
function callbackcount(idnew,cnt) {
	$("#addimage"+idnew+""+cnt).change(function(){
		 var total_file=document.getElementById("addimage"+idnew+cnt).files.length;

		 for(var i=0;i<total_file;i++)
		 {
			var fileName = event.target.files[i].name;
			$('#image_preview2'+idnew).append(
        '<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-3 ps-0 pe-2 pt-2 mb-2 position-relative removeaddimg" id="imgmore'+idnew+''+cnt+'">'+
				'<div class="rounded-3" style="background-image:url('+URL.createObjectURL(event.target.files[i])+');height:60px;width:100%;background-repeat: no-repeat;background-size: cover;background-position: center;"><div>'+
          '<button type="button" class="btn-close bg08 mtme_0 rounded-circle shadow-none txt10" onclick="delectmore('+idnew+','+cnt+')"></button>'+
        '</div>'
      );
			console.log('files ',event.target.files[i]);
		 }
	});
}
function delectmore(idnew,cntmore) {
	$('#addimage'+idnew+''+cntmore).remove();
	$('#imgmore'+idnew+''+cntmore).remove();
}

// .............................................................................................

$("#search_news").keyup(function(){
  $("#show_news").load("Admin/ManageNews/SelectManageNews.php",{search: $("#search_news").val()});
});

function deletenews(id) {
  let idnews = id ;
  Swal.fire({
  title:'<span class="h5 text-dark fw-bold">คุณต้องการลบข้อมูลข่าวใช่หรือไม่</span>',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'ยืนยัน',
  cancelButtonText: 'ยกเลิก',
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
      url: "Admin/ManageNews/DeleteManageNews.php",
      type: "POST",
      data: {'idnews':idnews},
      datatype: 'html',
      cache: false,
      success: function(data){
        if (data == 1){
          Swal.fire({
          icon: 'success',
          title: '<span class="h5 text-dark fw-bold">ลบข่าวสำเร็จ</span>',
          confirmButtonColor: '#198754',
          showConfirmButton: true,
          confirmButtonText: 'ตกลง',
        }).then((result) => {
          location.reload();
        })
        }else if (data ==0){
          Swal.fire({
          icon: 'error',
          iconColor:'#d33',
          title: '<p class="h5 text-dark fw-bold">ลบข้อมูลข่าวไม่สำเร็จ</p>',
          confirmButtonColor: '#198754',
          showConfirmButton: true,
          confirmButtonText: 'ตกลง',
        }).then((result) => {
          location.reload();
        })
        }
      }
    })
  }else if (result.isDenied) {

  }
})
}


function confirmeditimgnews(id) {
  let idnews = id ;
	if ($('.checkempty').val()=='') {
		$('.checkempty').remove();
	}
	let cnt_name_add_img = $('.arrayname');
	// alert('คงเหลือ'+datapacknameimg.length);
	// alert('เพิ่ม'+cnt_name_add_img.length);
	// alert('ลบ'+imgname_array.length);
	if (datapacknameimg.length==0 && cnt_name_add_img.length==0) {
		Swal.fire({
		title:'<span class="h5 text-dark fw-bold">โปรดระบุรูปสำหรับข่าวนี้</span>',
		icon: 'warning',
		showConfirmButton: true,
		confirmButtonText: 'ตกลง',
	}).then((result) => {
		$.ajax({
			url: "Admin/ManageNews/Selectimgnews.php",
			type: "POST",
			data: {'newsid':idnews},
			datatype: 'html',
			cache: false,
			success: function(data){
				let packnameimg =[];
				let name_img_news = data.split(',');
				for (var i = 0; i < name_img_news.length; i++) {
						packnameimg.push(name_img_news[i].trim());
				}
				callbackpacknameimg(packnameimg);
			}
		})
		imgname_array =[];
		$('.removeaddimg').remove();
		$('.shownoneimg').removeClass('d-none');
	})
}else {
	var form = $("#formeditnewsmodal"+idnews)
	if (form[0].checkValidity() === false) {
		event.preventDefault()
		event.stopPropagation()
		form.addClass('was-validated');
	}else {
		Swal.fire({
		title:'<span class="h5 text-dark fw-bold">ยืนยันการแก้ไขข้อมูลข่าวใช่หรือไม่</span>',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'ยืนยัน',
		cancelButtonText: 'ยกเลิก',
	}).then((result) => {
		if (result.isConfirmed) {
			$('#idnews'+idnews).val(idnews);

			let array_delete_img_news = imgname_array.join(',');
			$('#imgname_array'+idnews).val(array_delete_img_news);

			let array_dataname_img_news = datapacknameimg.join(',');
			$('#datapacknameimg'+idnews).val(array_dataname_img_news);
			let myform = document.getElementById("formeditnewsmodal"+idnews);
			let fd = new FormData(myform);
			$.ajax({
						url: "Admin/ManageNews/EditManageNews.php",
						data: fd,
						cache: false,
						processData: false,
						contentType: false,
						type: 'POST',
						success: function (data) {
					if (data == 1){
						Swal.fire({
						icon: 'success',
						title: '<span class="h5 text-dark fw-bold">แก้ไขข้อมูลข่าวสำเร็จ</span>',
						confirmButtonColor: '#198754',
						showConfirmButton: true,
						confirmButtonText: 'ตกลง',
					}).then((result) => {
						location.reload();
					})
					}else if (data ==0){
						Swal.fire({
						icon: 'error',
						iconColor:'#d33',
						title: '<p class="h5 text-dark fw-bold">แก้ไขข้อมูลข่าวสำเร็จไม่สำเร็จ</p>',
						confirmButtonColor: '#198754',
						showConfirmButton: true,
						confirmButtonText: 'ตกลง',
					})
					}
				}
			})

		}else if (result.isDenied) {

		}
	})
}
form.addClass('was-validated');
}
}

// function reseteditimgnews(idnews) {
//   $('.shownoneimg').removeClass('d-none');
// 	$('.removeaddimg').remove();
//   openmodaleditnews(idnews);
// }

let imgname_array = [];
let datapacknameimg = [];

function deleteimgnews(id,name_img_news,iedit) {
  let idnews = id;
  let nameimg = name_img_news;
  let iedarray = iedit;
	// console.log(nameimg);
  imgname_array.push(nameimg);
    $('#show_img_news'+idnews+iedarray).addClass('d-none');
  datapacknameimg = jQuery.grep(datapacknameimg, function(value) {
    return value != nameimg;
  });
	// alert('ลบ'+imgname_array.length);
	// alert('คงเหลือ'+datapacknameimg.length);
}

function openmodaleditnews(id) {
let data_allow = $('#get_news_allow'+id).val();
if (data_allow =='อนุญาต') {
	$('#ed_news_allow'+id).val('อนุญาต');
}else if (data_allow =='ไม่อนุญาต') {
	$('#ed_news_allow'+id).val('ไม่อนุญาต');
}
  let idnews = id ;
  $.ajax({
    url: "Admin/ManageNews/Selectimgnews.php",
    type: "POST",
    data: {'newsid':idnews},
    datatype: 'html',
    cache: false,
    success: function(data){
      let packnameimg =[];
      let name_img_news = data.split(',');
      for (var i = 0; i < name_img_news.length; i++) {
          packnameimg.push(name_img_news[i].trim());
      }
      callbackpacknameimg(packnameimg);
    }
  })
  imgname_array =[];
	$('.removeaddimg').remove();
  $('.shownoneimg').removeClass('d-none');
  $('#openmodaleditnews'+idnews).modal('show');
}
function closemodaleditimgnews(idnews) {
	$('#openmodaleditnews'+idnews).modal('hide');
	$('.removeaddimg').remove(1000);
}

function callbackpacknameimg(packnameimg) {
   datapacknameimg = packnameimg;
}


function openmodalCarouselimgnews(id,loop_i) {
  let li =loop_i
  let newsid = id;
  $('#img_news_carousel').html('');
  $('#img_news_carousel_bar').html('');
  $.ajax({
    url: "Admin/ManageNews/Selectimgnews.php",
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
        $('#img_news_carousel_bar').append(
          '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'+i+'" class="clearactive '+active+'" aria-current="true" aria-label="Slide'+i+'"></button>'
        );
        $('#img_news_carousel').append(
        '<div class="clearactive carousel-item text-center position-relative '+active+'" style="height:100vh;">'+
          '<img src="Img/ImgNews/'+img_carousel_array[i]+'" class="img_news_carousel d-block middle" />'+
        '</div>'
        );
      }
    }
  })
  $('#openmodalimgnews').modal('show');
}

function clearactive() {
  $('.clearactive').removeClass('active');
}

$("#insert_news_img").change(function(){
	 $('#image_preview').html("");
	 var total_file = document.getElementById("insert_news_img").files.length;

	 for(var i=0;i<total_file;i++)
	 {
		var fileName = event.target.files[i].name;
		$('#image_preview').append(
		'<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-3 ps-0 pe-2 pt-2 mb-2">'+
			'<div class="rounded-3" style="background-image:url('+URL.createObjectURL(event.target.files[i])+');height:60px;width:100%;background-repeat: no-repeat;background-size: cover;background-position: center;"><div>'+
		'</div>'
		);
		console.log('files ',event.target.files[i]);
	 }
});


// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()


let suceessinser = localStorage.getItem('getinsertnews');
if (suceessinser == 1) {
    Swal.fire({
    icon: 'success',
    title: '<span class="h5 text-dark fw-bold">เพิ่มข้อมูลข่าวสำเร็จ</span>',
    confirmButtonColor: '#198754',
    showConfirmButton: true,
    confirmButtonText: 'ตกลง',
  })
  localStorage.setItem("getinsertnews",0);
}
