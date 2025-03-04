let comment ='';
let datesl ='';
let countswtime = 0;
let statustime = 0;
let datapacklimit =[];

$( document ).ready(function() {

  $('#editdatetime,#editdatetimest').hide();
  $('#dateoff').show();

  $.ajax({
    url: "Admin/ManageDateTime/SelectDateLimit.php",
    type: "POST",
    data: {'datalimit':0},
    datatype: 'html',
    cache: false,
    success: function(data){

      datapack = data.split('|');
      $('#editdatelimit').text(datapack[0]);
      $('#editlimitround').text(datapack[1]);
      callblackdatelimit(datapack);
      callblackdatalimit(datapack[0]);
    }
  })
});

function confirmformmodaleditlimitround() {
  var form = $("#formmodaleditlimitround")
  if (form[0].checkValidity() === false) {
    event.preventDefault()
    event.stopPropagation()
  }else {
      $(function(){
        let inputroundlimit = $('#inputroundlimit').val()
        $.ajax({
          url: "Admin/ManageDateTime/UpdateDateLimit.php",
          type: "POST",
          data: {'inputroundlimit':inputroundlimit},
          datatype: 'html',
          cache: false,
          success: function(data){
              if (data == 1) {
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
                location.reload();
              }, 500);
              }else if (data == 0) {
                  setTimeout(function() {
                  location.reload();
                }, 500);
              }
          }
        })
      });
  }
 form.addClass('was-validated');
}

function confirmformmodaleditdatelimit() {
  var form = $("#formmodaleditdatelimit")
  if (form[0].checkValidity() === false) {
    event.preventDefault()
    event.stopPropagation()
  }else {
      $(function(){
        let inputdatelimit = $('#inputdatelimit').val()
        $.ajax({
          url: "Admin/ManageDateTime/UpdateDateLimit.php",
          type: "POST",
          data: {'inputdatelimit':inputdatelimit},
          datatype: 'html',
          cache: false,
          success: function(data){
              if (data == 1) {
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
                location.reload();
              }, 500);
              }else if (data == 0) {
                  setTimeout(function() {
                  location.reload();
                }, 500);
              }
          }
        })
      });
  }
 form.addClass('was-validated');
}

function callblackdatelimit(data) {
  datapacklimit = data ;
}

function editdatelimit() {
$('#inputdatelimit').val(datapacklimit[0]);
$('#modaleditdatelimit').modal('show');
};

function editlimitround() {
$('#inputroundlimit').val(datapacklimit[1]);
$('#modaleditlimitround').modal('show');
};

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
var vardateoff = [];
$("input[name='dateoff']").each(function() {
    vardateoff.push($(this).val());
});


function callblackdatalimit(data) {
  var datenow = new Date();
  datenow.setDate(datenow.getDate() + parseInt(data));

 //add 6 days
// Blue theme type Calendar
$('.calendar-light').pignoseCalendar({
    theme: 'light', // light, dark, blue
    lang: 'th',
    // enabledDates:['2022-01-29'],
    //เริ่มต้นที่เดือน
    // date:moment(datenow),
    //วันหยุด
    disabledWeekdays:[0],
    disabledDates: vardateoff ,
    //หยุด วันเสาร์ - อาทิตย์
    // disabledWeekdays: [daywork0s,daywork1s,daywork2s,daywork3s,daywork4s,daywork5s,daywork6s], // SUN (0), SAT (6)
    minDate: datenow,
    select: function(date, context) {
      var monthNamesThai = ["ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.",
      "ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];

      var dayNames = ["อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์"];

      var d = new Date(date[0]);
       datesl = dayNames[d.getDay()]+', '+d.getDate()+" "+monthNamesThai[d.getMonth()]+"  "+(543+d.getFullYear());
        var $element = context.element;
        var $calendar = context.calendar;
        var text = '<span class="rounded-pill px-2" style="background-color:#b3e5fc;"><i class="far fa-calendar-alt"></i> ';

        if (date[0] !== null) { //เลือกวันที่

          let timest = d.getDay();
          if (timest == 6) { //เลือกวันเสาร์
            statustime = 1;
            $('#editdatetimest').show();
            $('#editdatetime').hide();
            $('#dateoff').hide();
            $('#showdatest').html(datesl);
          }else { //เลือกวันปกติ
            statustime = 2;
            $('#editdatetime').show();
            $('#editdatetimest').hide();
            $('#dateoff').hide();
            $('#showdate').html(datesl);
          }
          let dateclick = date[0].format('YYYY-MM-DD');
          $('#getdatehidden').val(dateclick);
          $('.swtime').prop('checked', false);

          $.ajax({
            url: "Admin/ManageDateTime/SelectTime.php",
            type: "POST",
            data: {'dateclick':dateclick},
            datatype: 'html',
            cache: false,
            success: function(data){
              if (data == 0 ) {
                $('.swtime').prop('checked', true);
                if (statustime == 1) {
                  let hiddentime =['T-08-30','T-10-30','T-13-00','T-14-00','T-16-00','T-18-00'];
                  for (var i = 0; i < hiddentime.length; i++) {
                    $('#'+hiddentime[i]).prop('checked',false);
                  }
                  countswtime = 2;
                }else {
                  let hiddentime =['T-08-00','T-10-00'];
                  for (var i = 0; i < hiddentime.length; i++) {
                    $('#'+hiddentime[i]).prop('checked',false);
                  }
                  countswtime = 6;
                }
              }else {
                var time = data.split(',');
                // console.log('time = ',time);
                countswtime = time.length;
                for (var i = 0; i < time.length; i++) {
                  var tempTime = time[i];
                  // console.log('time i ',i,' = ',tempTime.trim());
                  $('#'+tempTime.trim()).prop('checked', true);
                }
              }
            }
          })

        }else if (date[0] === null && date[1] == null) {
          $('#editdatetimest').hide();
          $('#editdatetime').hide();
          $('#dateoff').show();
        }
       }
    });
}


    $( ".swtime" ).change(function() {
      let primarydate = $('#getdatehidden').val();
      let timepack = [];
      $.each($("input[name='timeop']:checked"), function(){
         timepack.push($(this).val());
     });
     if ($(this).is(':checked')) {
       countswtime = countswtime + 1;
     }else {
       countswtime = countswtime - 1;
     }
      if (countswtime == 0) {
        Swal.fire({
        title: '<p class="h4 text-dark fw-bold">'+'เนื่องจากเวลาในวันนี้ถูกปิดหมด'+'<p>'+
                '<span class="h6">'+'ต้องการตั้ง '+datesl+' เป็นวันหยุด ใช่หรือไม่'+'</span>',
        icon: 'warning',
        iconColor:'#d33',
        input: 'text',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        inputPlaceholder: 'หมายเหตุ',
        inputValidator: (value) => {
        if (!value) {
            return 'โปรดระบุหมายเหตุ'
          }else {
            comment = value;
          }
        }
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "Admin/ManageDateTime/InsertDateOff.php",
            type: "POST",
            data: {'dateoff':primarydate,'comment':comment},
            datatype: 'html',
            cache: false,
            success: function(data){
              if (data == 1) {
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
                title: 'ตั้งเป็นวันหยุดสำเร็จ'
              }).then((result) => {
                location.reload();
              })
              }
            }
          })
        }else {
          countswtime = 1;
          $(this).prop('checked', true);
        }
      })
      }else {
        $.ajax({
          url: "Admin/ManageDateTime/editinserttime.php",
          type: "POST",
          data: {'primarydate':primarydate,'timepack':timepack},
          datatype: 'html',
          cache: false,
          success: function(data){
          }
        })
      }
});

function dateoff() {
  let dateoff = $('#getdatehidden').val();
  Swal.fire({
  title: '<p class="h4 text-dark fw-bold">'+datesl+'<p>'+
  '<span class="h6">ต้องการตั้งเป็นวันหยุด หรือ ไม่</span>',
  icon: 'question',
  iconColor: '#d33',
  showCancelButton: true,
  confirmButtonText: 'ยืนยัน',
  confirmButtonColor: 'rgb(48, 133, 214)',
  cancelButtonText: 'ยกเลิก',
  cancelButtonColor: '#dc3741',
  input: 'text',
  inputPlaceholder:'หมายเหตุ',
  inputValidator: (value) => {
  if (!value) {
      return 'โปรดระบุหมายเหตุ'
    }else {
      comment = value;
    }
  }
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    $.ajax({
      url: "Admin/ManageDateTime/InsertDateOff.php",
      type: "POST",
      data: {'dateoff':dateoff, 'comment':comment},
      datatype: 'html',
      cache: false,
      success: function(data){
        if (data == 1) {
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
          title: 'ตั้งเป็นวันหยุดสำเร็จ'
        }).then((result) => {
          location.reload();
        })
        }
      }
    })
  }
})

}
function btndeletedateoff(id) {
let dateoffshowcancel = $('#dateoffshowcancel'+id).val();
let dateoff_id = id;
  Swal.fire({
    title: '<p class="h4 fw-bold">ยกเลิกเป็นวันหยุด</p>'+
    '<span class="h6">ต้องการยกเลิกวัน <span class="txt01">'+dateoffshowcancel+'</span> เป็นวันหยุด ใช่หรือไม่</span>',
    showCancelButton: true,
    confirmButtonText: 'ยืนยัน',
    cancelButtonText: 'ยกเลิก',
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      $.ajax({
        url: "Admin/ManageDateTime/DeleteDateOff.php",
        type: "POST",
        data: {'dateoff_id':dateoff_id},
        datatype: 'html',
        cache: false,
        success: function(data){
          if (data == 1) {
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
            title: 'ยกเลิกเป็นวันหยุดสำเร็จ'
          }).then((result) => {
            location.reload();
          })
          }
        }
      })
    }
  })
}


// input เฉพาะ ตัวเลข.
function isNumber(evt) {
  var iKeyCode = (evt.which) ? evt.which : evt.keyCode
  if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
      return false;
  return true;
}
