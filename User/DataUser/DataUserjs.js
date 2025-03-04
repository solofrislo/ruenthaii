$(document).ready(function() {
  $('#cancleeduser').hide();
  $('#eddatausershowsubmit').hide();

  let sex = $('#getidsex').val();
  if (sex == 'ชาย') {
    $('#eddbus_usersex').val('ชาย');
  }else if (sex == 'หญิง') {
    $('#eddbus_usersex').val('หญิง');
  }else {
    $('#eddbus_usersex').val('');
  }
  let cv_19 = $('#geteddbuscv_19').val();
  if (cv_19 == 'ยังไม่ฉีด') {
    $('#eddbuscv_19').val('ยังไม่ฉีด');
  }else if (cv_19 == 'ฉีด 1 เข็ม') {
    $('#eddbuscv_19').val('ฉีด 1 เข็ม');
  }else if (cv_19 == 'ฉีด 2 เข็ม') {
    $('#eddbuscv_19').val('ฉีด 2 เข็ม');
  }else if (cv_19 == 'ฉีดมากกว่า 2 เข็ม') {
    $('#eddbuscv_19').val('ฉีดมากกว่า 2 เข็ม');
  }else {
    $('#eddbuscv_19').val('');
  }
});

function btncancleeduser() {
  $('#cancleeduser').hide();
  $('#eddatausershowsubmit').hide();
  $('#eddatausershow').show();
    $(".removedisabled").prop('disabled',true);
}

function btneddatausershow(){
  $('#cancleeduser').show();
  $(".removedisabled").prop('disabled',false);
  $('#eddatausershow').hide();
  $('#eddatausershowsubmit').show();
}


function modalformdatauseredit() {
  var form = $("#formdatauseredit")
  if (form[0].checkValidity() === false) {
    event.preventDefault()
    event.stopPropagation()
  }else {
    Swal.fire({
  position: 'center',
  html: '<span class="txt20 ">ยืนยันการแก้ไขข้อมูลหรือไม่</span>',
  showCancelButton: true,
  showConfirmButton: true,
  cancelButtonText: 'ยกเลิก',
  confirmButtonText: 'ยืนยัน',
  confirmButtonColor: '#198754',
  cancelButtonColor: '#dc3545',
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    $(function(){
         //ส่งข้อมูล
      var eddbus_userid = $("#eddbus_userid").val();
      var eddbus_prefixname = $("#eddbus_prefixname").val();
      var eddbus_fname = $("#eddbus_fname").val();
      var eddbus_lname = $("#eddbus_lname").val();
      var eddbus_userage = $("#eddbus_userage").val();
      var eddbus_usersex = $("#eddbus_usersex").val();
      var eddbuscv_19 = $('#eddbuscv_19').val();
      var eddbus_card_id = $("#eddbus_card_id").val();
      var eddbus_tel = $("#eddbus_tel").val();
      var eddbus_useraddress = $("#eddbus_useraddress").val();
      var eddbus_cd = $("#eddbus_cd").val();
      var eddbus_da = $("#eddbus_da").val();

      $.ajax({
        url: "User/DataUser/EditDataUser.php",
        type: "POST",
        data: { 'eddbus_userid':eddbus_userid,
                'eddbus_prefixname':eddbus_prefixname,
                'eddbus_fname':eddbus_fname,
                'eddbus_lname':eddbus_lname,
                'eddbus_userage':eddbus_userage,
                'eddbus_usersex':eddbus_usersex,
                'eddbuscv_19':eddbuscv_19,
                'eddbus_card_id':eddbus_card_id,
                'eddbus_tel':eddbus_tel,
                'eddbus_useraddress':eddbus_useraddress,
                'eddbus_cd':eddbus_cd,
                'eddbus_da':eddbus_da
              },
        datatype: 'html',
        cache: false,
        success: function(data){
          if (data == 0) {
            Swal.fire({
              title: "<span class='Tc03a9f4'>" + "คำเตือน!" + "</span>",
              text: "เลขบัตรประจำตัวประชาชน หรือ หมายเลขโทรศัพท์ ไม่ถูกต้อง",
              confirmButtonColor: '#03a9f4',
              confirmButtonText: 'ตกลง'
            })
          }else if (data == 1) {
              const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              Toast.fire({
                icon: 'success',
                title: 'แก้ไข้สำเร็จ'
              })
              setTimeout(function() {window.location.replace("Index.php?action=DataUser");}, 1000);
            }
        }
      });
    });
  }
})

}
 form.addClass('was-validated');

}
