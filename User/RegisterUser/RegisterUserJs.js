
function SmFormRegister() {
  var form = $("#formRegisterusermodal")
  if (form[0].checkValidity() === false) {
    event.preventDefault()
    event.stopPropagation()
  }else {
   //ส่งข้อมูล
      $(function(){
        var prefixname = $("#prefixname").val();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var card_id = $("#card_id").val();
        var tel = $("#tel").val();
        $.ajax({
          url: "User/RegisterUser/InsertRegisterUser.php",
          type: "POST",
          data: {'prefixname':prefixname,'fname':fname,'lname':lname,'card_id':card_id,'tel':tel},
          datatype: 'html',
          cache: false,
          success: function(data){
            if (data == 0) {
              Swal.fire({
                title: "<span class='Tc03a9f4'>" + "คำเตือน!" + "</span>",
                text: "หมายเลขบัตรประชาชน "+card_id+" นี้ ได้ถูกลงทะเบียนเเล้ว",
                confirmButtonColor: '#03a9f4',
                confirmButtonText: 'ตกลง'
              })
            }else {
              if (data == 1){
                localStorage.setItem("auto_card_id",card_id);
                localStorage.setItem("auto_tel",tel);
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
                  title: 'สมัครสมาชิกบัญชีสำเร็จ'
                })
                setTimeout(function() {window.location.replace("Index.php");}, 1000);
              }
            }
          }
        });
      });
}
 form.addClass('was-validated');

}
