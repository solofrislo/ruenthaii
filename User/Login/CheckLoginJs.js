let auto_card_id = localStorage.getItem('auto_card_id');
let auto_tel = localStorage.getItem('auto_tel');
$('#login_card_id').val(auto_card_id);
$('#login_tel').val(auto_tel);

function SmFormLogin() {
  var form = $("#SmFormLogin")
  if (form[0].checkValidity() === false) {
    event.preventDefault()
    event.stopPropagation()
  }else {
   //ส่งข้อมูล
      $(function(){
        var login_card_id = $("#login_card_id").val();
        var login_tel = $("#login_tel").val();
        $.ajax({
          url: "User/Login/CheckLogin.php",
          type: "POST",
          data: {'login_card_id':login_card_id,'login_tel':login_tel},
          datatype: 'html',
          cache: false,
          success: function(data){
            localStorage.setItem("auto_card_id",login_card_id);
            localStorage.setItem("auto_tel",login_tel);
            if (data == 0) {
              Swal.fire({
                title: "<span class='Tc03a9f4'>" + "คำเตือน!" + "</span>",
                text: "เลขบัตรประจำตัวประชาชน หรือ หมายเลขโทรศัพท์ ไม่ถูกต้อง",
                confirmButtonColor: '#03a9f4',
                confirmButtonText: 'ตกลง'
              })
            }else if (data == 3) {
              Swal.fire({
                title: "<span class='Tc03a9f4'>" + "คำเตือน!" + "</span>",
                text: "บัญชีนี้ถูกระงับการใช้งาน",
                confirmButtonColor: '#03a9f4',
                confirmButtonText: 'ตกลง'
              })
            }
            else {
              if (data == 1) {
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
                  title: 'เข้าสู่ระบบสำเร็จ'
                })
                setTimeout(function() {window.location.replace("Index.php");}, 1000);

              }else if (data == 2) {
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
                  title: 'เข้าสู่ระบบสำเร็จ'
                })
                setTimeout(function() {window.location.replace("Admin.php");}, 1000);

              }

            }
          }
        });
      });
}
 form.addClass('was-validated');

}
