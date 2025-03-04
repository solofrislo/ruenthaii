//ค้นหาผู้ใช้
$("#search_user").keyup(function(){
	$("#show_user").load("Admin/ManageUser/SelectUser.php",
	{
	search: $("#search_user").val()
	});
});
// $("#btn_search_user").click(function(){
// 	$("#show_user").load("Admin/ManageUser/SelectUser.php",
// 	{
// 	search: $("#search_user").val()
// 	});
// });
function showmodaledituser(id) {
	let iduser=id;

	let getidsex = $('#getidsex'+iduser).val();
	if (getidsex == 'ชาย') {
		$('#ed_usersex'+iduser).val('ชาย');
	}else if (getidsex == 'หญิง') {
		$('#ed_usersex'+iduser).val('หญิง');
	}else {
		$('#ed_usersex'+iduser).val('');
	}

	let getidtype =$('#getidtype'+iduser).val();
	if (getidtype == 'ผู้ใช้งานทั่วไป') {
		$('#ed_typeuser'+iduser).val('ผู้ใช้งานทั่วไป');
	}else if (getidtype == 'ผู้ดูแลระบบ') {
		$('#ed_typeuser'+iduser).val('ผู้ดูแลระบบ');
	}else {
		$('#ed_typeuser'+iduser).val('');
	}

	let getidallow =$('#getidallow'+iduser).val();
	if (getidallow == 'อนุญาต') {
		$('#ed_allow'+iduser).val('อนุญาต');
	}else if (getidallow == 'ไม่อนุญาต') {
		$('#ed_allow'+iduser).val('ไม่อนุญาต');
	}else {
		$('#ed_allow'+iduser).val('');
	}

		let getidvaccine =$('#getidvaccine'+iduser).val();
		 if (getidvaccine == 'ยังไม่ฉีด') {
		  $('#ed_vaccine'+iduser).val('ยังไม่ฉีด');
		}else if (getidvaccine == 'ฉีด 1 เข็ม') {
		  $('#ed_vaccine'+iduser).val('ฉีด 1 เข็ม');
		}else if (getidvaccine == 'ฉีด 2 เข็ม') {
		  $('#ed_vaccine'+iduser).val('ฉีด 2 เข็ม');
		}else if (getidvaccine == 'ฉีดมากกว่า 2 เข็ม'){
		  $('#ed_vaccine'+iduser).val('ฉีดมากกว่า 2 เข็ม');
		}else {
		  $('#ed_vaccine'+iduser).val('');
		}

	$('#edituser'+iduser).modal('show');

}


function insertuser11() {
  var form = $("#forminsertusermodal")
  if (form[0].checkValidity() === false) {
    event.preventDefault()
    event.stopPropagation()
  }else {
   //ส่งข้อมูล
      $(function(){
        var prefixname = $("#prefixname").val();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var usersex = $("#usersex").val();
        var userage = $("#userage").val();
        var card_id = $("#card_id").val();
        var tel = $("#tel").val();
        var useraddress = $("#useraddress").val();
        var typeuser = $("#typeuser").val();
        var user_cd = $("#user_cd").val();
        var user_da = $("#user_da").val();
        var vaccine = $("#vaccine").val();
      //   alert('prefixname'+prefixname+'fname'+fname+'lname'+lname+'usersex'
      //   +usersex+'userage'+userage+'card_id'+card_id+'tel'+tel+'useraddress'+useraddress+
      // 'typeuser'+typeuser);
        $.ajax({
          url: "Admin/ManageUser/InsertUser.php",
          type: "POST",
          data: {'prefixname':prefixname,'fname':fname,
          'lname':lname,'usersex':usersex,'userage':userage,'card_id':card_id,
          'tel':tel,'useraddress':useraddress,'typeuser':typeuser,'user_cd':user_cd,
          'user_da':user_da,'vaccine':vaccine},
          datatype: 'html',
          cache: false,
          success: function(data){
            // alert(data);
            if (data == 0) {
              Swal.fire({
                title: "<span class='Tc03a9f4'>" + "คำเตือน!" + "</span>",
                text: "หมายเลขบัตรประชาชน "+card_id+" นี้ ได้ถูกลงทะเบียนเเล้ว",
                confirmButtonColor: '#03a9f4',
                confirmButtonText: 'ตกลง'
              })
            }else {
              if (data == 1){
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 500,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })
                Toast.fire({
                  icon: 'success',
                  title: 'เพิ่มบัญชีสำเร็จ'
                })
                setTimeout(function() {window.location.replace("Admin.php?action=User");}, 500);
              }
            }
          }
        });
      });
}
 form.addClass('was-validated');

}

function formEditusermodal(id) {
  let iduser=id;
  var form = $("#formEditusermodal"+iduser)
  if (form[0].checkValidity() === false) {
    event.preventDefault()
    event.stopPropagation()
  }else {
   //ส่งข้อมูล
      $(function(){
        var prefixname = $("#ed_prefixname"+iduser).val();
        var fname = $("#ed_fname"+iduser).val();
        var lname = $("#ed_lname"+iduser).val();
        var usersex = $("#ed_usersex"+iduser).val();
        var userage = $("#ed_userage"+iduser).val();
        var card_id = $("#ed_card_id"+iduser).val();
        var tel = $("#ed_tel"+iduser).val();
        var useraddress = $("#ed_useraddress"+iduser).val();
        var typeuser = $("#ed_typeuser"+iduser).val();
        var allow = $("#ed_allow"+iduser).val();
        var user_cd = $("#ed_user_cd"+iduser).val();
        var user_da = $("#ed_user_da"+iduser).val();
        var user_vaccine = $("#ed_vaccine"+iduser).val();
        // alert(userid+prefixname+fname+lname+usersex+uerage+card_id+tel+useraddress+typeuser);
        $.ajax({
          url: "Admin/ManageUser/EditUser.php",
          type: "POST",
          data: {'userid':iduser,'prefixname':prefixname,'fname':fname,
          'lname':lname,'usersex':usersex,'userage':userage,'card_id':card_id,
          'tel':tel,'useraddress':useraddress,'typeuser':typeuser,'allow':allow,
          'user_cd':user_cd,'user_da':user_da,'user_vaccine':user_vaccine},
          datatype: 'html',
          cache: false,
          success: function(data){
            if (data == 0) {
              Swal.fire({
                title: "<span class='Tc03a9f4'>" + "คำเตือน!" + "</span>",
                text: "แก้ไขข้อมูลไม่สำเร็จ",
                confirmButtonColor: '#03a9f4',
                confirmButtonText: 'ตกลง'
              })
            }else {
              if (data == 1){
                const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 500,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                })
                Toast.fire({
                  icon: 'success',
                  title: 'แก้ไขข้อมูลสำเร็จ'
                })
                setTimeout(function() {
                  $("#show_user").load("Admin/ManageUser/SelectUser.php",{search: card_id});
								}, 500);
                $('#edituser'+iduser).modal('hide');
              }
            }
          }
        });
      });
}
 form.addClass('was-validated');

}
