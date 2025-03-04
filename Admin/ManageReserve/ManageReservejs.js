$('.calendarMd').pignoseCalendar({
		format: 'YYYY-MM-DD',
    // theme: 'blue',
    lang: 'th',
    default: false,
    buttons:true,
    modal: true, // date format string. (2017-02-02)
    apply: function(date, context) {
      if (date[0] !== null) {
        var monthNamesThai = ["ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.",
        "ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];

        var dayNames = ["อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์"];
        let searchdate = date[0].format("YYYY-MM-DD");

        $("#show_status_reserve").load("Admin/ManageReserve/SelectStatusReserve.php",{search:searchdate});
      }else if (date[0] === null && date[1] == null) {

      }
    }
  });


let showstatuspage = 3;

$( document ).ready(function() {
  let status = showstatuspage;
  // alert(status);
    $("#show_status_reserve").load("Admin/ManageReserve/SelectStatusReserve.php",{status:status});
});

function formeditreserve(id) {
  let reserve_id = $('#reserve_id'+id).val();
  let reserve_status = $('#re_edit_status'+id).val();
	let reserve_date = $('#dateupdatereserve'+id).val();
	let reserve_time = $('#timeupdatereserve'+id).val();
  $.ajax({
    url: "Admin/ManageReserve/EditReserve.php",
    type: "POST",
    data: {'reserve_status':reserve_status,'reserve_id':reserve_id,'reserve_date':reserve_date,'reserve_time':reserve_time},
    datatype: 'html',
    cache: false,
    success: function(data){
      if (data == 0) {

      }else if (data == 1) {
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
        title: 'แก้ไขข้อมูลสำเร็จ',
      })
        $('#modaleditdatareserve'+id).modal('hide');
        $("#show_status_reserve").load("Admin/ManageReserve/SelectStatusReserve.php",{status:showstatuspage});
      }
    }
  })
}


function modaleditdatareserve(id) {
let getidstatus = $('#getidstatus'+id).val();
  if (getidstatus == 'รอการอนุมัติ') {
    $('#re_edit_status'+id).val('รอการอนุมัติ');
  }else if (getidstatus == 'อนุมัติแล้ว') {
    $('#re_edit_status'+id).val('อนุมัติแล้ว');
  }else if (getidstatus == 'ไม่ได้รับบริการ') {
    $('#re_edit_status'+id).val('ไม่ได้รับบริการ');
  }
  $('#modaleditdatareserve'+id).modal('show');
}


$("#search_reserve").keyup(function(){
  if ($(this).val() !=='') {
    $("#show_status_reserve").load("Admin/ManageReserve/SelectStatusReserve.php",{search: $("#search_reserve").val()});
  }else {
      $("#show_status_reserve").load("Admin/ManageReserve/SelectStatusReserve.php",{status:showstatuspage});
  }

});


function slstatus(status) {
  if (status == 0) {
  $("#btnshowstatus").text('รอการอนุมัติ');
  showstatuspage = 0 ;
}else if (status == 1) {
  $("#btnshowstatus").text('รับบริการเเล้ว');
  showstatuspage = 1 ;
}else if (status == 2) {
  $("#btnshowstatus").text('ไม่ได้รับบริการ');
  showstatuspage = 2 ;
}else if (status == 3) {
  $("#btnshowstatus").text('ทั้งหมด');
  showstatuspage = 3 ;
}else if (status == 4) {
  $("#btnshowstatus").text('อนุมัติแล้ว');
  showstatuspage = 4 ;
}
  $("#show_status_reserve").load("Admin/ManageReserve/SelectStatusReserve.php",{status:status});
}
