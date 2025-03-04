$("#search_doctor").keyup(function(){
  $("#show_doctor").load("Admin/ManageDoctor/SelectManageDoctor.php",{search: $("#search_doctor").val()});
});


function editdoctor(id) {
  let iddtr = id ;
  let getiddtrallow = $('#getiddtrallow'+iddtr).val();
  if (getiddtrallow == 'ไม่อนุญาต') {
    $('#ed_doctor_allow'+iddtr).val('ไม่อนุญาต')
  }else if (getiddtrallow == 'อนุญาต') {
    $('#ed_doctor_allow'+iddtr).val('อนุญาต')
  }else {
    $('#ed_doctor_allow'+iddtr).val('')
  }

  $('#editdoctor'+iddtr).modal('show');
}


function confirm_edit_doctor(id) {
  let iddtr = id ;
  var form = $("#formedittdoctormodal"+iddtr)
  if (form[0].checkValidity() === false) {
    event.preventDefault()
    event.stopPropagation()
    form.addClass('was-validated');
  }else {
   //ส่งข้อมูล
      $(function(){
      let doctor_prefix_name = $('#ed_doctor_prefix_name'+iddtr).val();
      let doctor_fname = $('#ed_doctor_fname'+iddtr).val();
      let doctor_lname = $('#ed_doctor_lname'+iddtr).val();
      let doctor_rank = $('#ed_doctor_rank'+iddtr).val();
      let doctor_professional_license = $('#ed_doctor_professional_license'+iddtr).val();
      let doctor_transcript = $('#ed_doctor_transcript'+iddtr).val();
      let doctor_allow = $('#ed_doctor_allow'+iddtr).val();
      let doctor_sort = $('#ed_doctor_sort'+iddtr).val();
        $.ajax({
          url: "Admin/ManageDoctor/EditDoctor.php",
          type: "POST",
          data: { 'iddtr':iddtr,
                  'doctor_prefix_name':doctor_prefix_name,
                  'doctor_fname':doctor_fname,
                  'doctor_lname':doctor_lname,
                  'doctor_rank':doctor_rank,
                  'doctor_professional_license':doctor_professional_license,
                  'doctor_transcript':doctor_transcript,
                  'doctor_allow':doctor_allow,
                  'doctor_sort':doctor_sort},
          datatype: 'html',
          cache: false,
          success: function(data){
            // alert(data);
            if (data == 0) {
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
                icon: 'error',
                title: 'แก้ไขข้อมูลไม่สำเร็จ'
              })
                setTimeout(function() {window.location.replace("Admin.php?action=ManageDoctor");}, 500);
            }else if (data==1){
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
                  $("#show_doctor").load("Admin/ManageDoctor/SelectManageDoctor.php",{search:doctor_fname });
								}, 500);
            }

            $('#editdoctor'+iddtr).modal('hide');
            location.reload();
          }
        });
      });
}
form.addClass('was-validated');
}


function confirm_insert_doctor() {
  var form = $("#forminsertdoctormodal")
  if (form[0].checkValidity() === false) {
    event.preventDefault()
    event.stopPropagation()
  }else {
   //ส่งข้อมูล
      $(function(){
        var insert_doctor_prefix_name = $("#insert_doctor_prefix_name").val();
        var insert_doctor_fname = $("#insert_doctor_fname").val();
        var insert_doctor_lname = $("#insert_doctor_lname").val();
        var insert_doctor_rank = $("#insert_doctor_rank").val();
        var insert_doctor_professional_license = $("#insert_doctor_professional_license").val();
        var insert_doctor_transcript = $("#insert_doctor_transcript").val();
        $.ajax({
          url: "Admin/ManageDoctor/InsertDoctor.php",
          type: "POST",
          data: {'insert_doctor_prefix_name':insert_doctor_prefix_name,
                  'insert_doctor_fname':insert_doctor_fname,
                  'insert_doctor_lname':insert_doctor_lname,
                  'insert_doctor_rank':insert_doctor_rank,
                  'insert_doctor_professional_license':insert_doctor_professional_license,
                  'insert_doctor_transcript':insert_doctor_transcript},
          datatype: 'html',
          cache: false,
          success: function(data){
            // alert(data);
            if (data == 0) {
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
                icon: 'error',
                title: 'เพิ่มข้อมูลไม่สำเร็จ'
              })
                setTimeout(function() {window.location.replace("Admin.php?action=ManageDoctor");}, 500);
            }else if (data==1){
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
                  title: 'เพิ่มข้อมูลสำเร็จ'
                })
                setTimeout(function() {window.location.replace("Admin.php?action=ManageDoctor");}, 500);
            }
          }
        });
      });
}
 form.addClass('was-validated');
}



function changeimgdtr(id) {
let iddtr = id ;
let fd = new FormData();
let files =$('#openuploadimgdtr'+iddtr)[0].files;
console.log(files);
if (files.length > 0) {
  fd.append('files',files[0]);
  fd.append('iddtr',iddtr);
  $.ajax({
    url: "Admin/ManageDoctor/ChangeImgDoctor.php",
    type: "POST",
    data: fd,
    contentType:false,
    processData:false,
    success: function(data){
      if (data==1) {
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
          title: 'เพิ่มข้อมูลสำเร็จ'
        })
        setTimeout(function() {window.location.replace("Admin.php?action=ManageDoctor");}, 500);
    }else {
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
        icon: 'error',
        title: 'เพิ่มข้อมูลไม่สำเร็จ'
      })
        setTimeout(function() {window.location.replace("Admin.php?action=ManageDoctor");}, 500);
    }
    location.reload();
    }

  })
}
}
