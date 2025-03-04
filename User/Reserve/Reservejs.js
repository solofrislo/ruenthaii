let statustime = 0 ;

$(".checkedtime").click(function() {
$('.checkedtime').addClass('btn-outline-danger txt01').removeClass('bg02 text-white');
$(this).removeClass('btn-outline-danger txt01').addClass('bg02 text-white');
});

$(document).ready(function() {
$('#btnBack').hide();
$('#step3_2').hide();


  $('#txtwarningstm').hide();

  let sex = $('#reidsex').val();
  if (sex == 'ชาย') {
    $('#re_usersex').val('ชาย');
  }else if (sex == 'หญิง') {
    $('#re_usersex').val('หญิง');
  }else {
    $('#re_usersex').val('');
  }

let recv_19 = $('#recv_19').val();
if (recv_19 == 'ยังไม่ฉีด') {
$('#re_usercv_19').val('ยังไม่ฉีด');
}else if (recv_19 == 'ฉีด 1 เข็ม') {
$('#re_usercv_19').val('ฉีด 1 เข็ม');
}else if (recv_19 == 'ฉีด 2 เข็ม') {
$('#re_usercv_19').val('ฉีด 2 เข็ม');
}else if (recv_19 == 'ฉีดมากกว่า 2 เข็ม') {
$('#re_usercv_19').val('ฉีดมากกว่า 2 เข็ม');
}else {
  $('#re_usercv_19').val('');
}

   title = $('#getidtitle').val();
  if (title == 1) {
    $('#user_title').val('1');
  }else if (title == 2) {
    $('#user_title').val('2');
  }else if (title == 3) {
    $('#user_title').val('3');
  }else if (title == 4) {
    $('#user_title').val('4');
  }else if (title == 5) {
    $('#user_title').val('5');
  }else {
    $('#user_title').val('');
  }

  $('#activebaricon1').addClass('bg02').removeClass('bg-white');
  $('#stepnumberreserve1').addClass('text-white').removeClass('txt01');
  $('#step1,#step2,#step3,#step4').hide(); //เเสดงทุก step
  $('#step1').show();
});
let countBtn = 1;
$('.btnReserve').on('click', function() {
   id = $(this).attr("id");
  if (id == 'btnNext') {
    countBtn = countBtn + 1 ;
    if (countBtn == 5){
      countBtn = 4;
    }
  }else if (id == 'btnBack') {
    countBtn = countBtn - 1 ;
    if (countBtn == 0){
      countBtn = 1;
    }
  }
  if (countBtn == 1) {
    $('#btnBack').hide();
    $('#btnNext').removeClass('bg-success').addClass('bg-Primary').html('ถัดไป'+' '+'<i class="fa fa-chevron-right" aria-hidden="true"></i>');
    $('#activebaricon2,#activebaricon3,#activebaricon4').removeClass('bg02').addClass('bg-white');
    $('#activebaricon1').addClass('bg02').removeClass('bg-white');
    $('#stepnumberreserve2,#stepnumberreserve3,#stepnumberreserve4').addClass('txt01').removeClass('text-white');
    $('#stepnumberreserve1').addClass('text-white').removeClass('txt01');
    $('#step1,#step2,#step3,#step4').hide();
    $('#step1').show();
  }else if (countBtn == 2) {
    $('#txtwarningstm').hide();
    $('#btnBack').show();
    $('#btnNext').removeClass('bg-success').addClass('bg-Primary').html('ถัดไป'+' '+'<i class="fa fa-chevron-right" aria-hidden="true"></i>');
    let form = $("#formstep1");
    if (form[0].checkValidity() === false) {
      event.preventDefault()
      event.stopPropagation()
      countBtn = 1;
      $('#btnBack').hide();
    }else {
      $('#activebaricon1,#activebaricon3,#activebaricon4').removeClass('bg02').addClass('bg-white');
      $('#activebaricon2').addClass('bg02').removeClass('bg-white');
      $('#stepnumberreserve1,#stepnumberreserve3,#stepnumberreserve4').addClass('txt01').removeClass('text-white');
      $('#stepnumberreserve2').addClass('text-white').removeClass('txt01');
      $('#step1,#step2,#step3,#step4').hide();
      $('#step2').show();
    } form.addClass('was-validated');
  }else if (countBtn == 3) {
    $('#btnBack').show();
    $('#btnNext').addClass('bg-success').removeClass('bg-Primary').html('<i class="fa fa-check-circle" aria-hidden="true"></i>'+' '+'จองคิวรักษา');
    let form = $("#formstep2");
    if (form[0].checkValidity() === false) {
      event.preventDefault()
      event.stopPropagation()
      if ($('.clickstm').is(':checked')) {
      $('#txtwarningstm').hide();
    }else {
      $('#txtwarningstm').show();
    }
      countBtn = 2;
      $('#btnNext').removeClass('bg-success').addClass('bg-Primary').html('ถัดไป'+' '+'<i class="fa fa-chevron-right" aria-hidden="true"></i>');
    }else {
      $('#activebaricon1,#activebaricon2,#activebaricon4').removeClass('bg02').addClass('bg-white');
      $('#activebaricon3').addClass('bg02').removeClass('bg-white');
      $('#stepnumberreserve1,#stepnumberreserve2,#stepnumberreserve4').addClass('txt01').removeClass('text-white');
      $('#stepnumberreserve3').addClass('text-white').removeClass('txt01');
      $('#step1,#step2,#step3,#step4').hide();
      $('#step3').show();
    } form.addClass('was-validated');
  }else if (countBtn == 4) {
    if (statusdate == 0 ) {
      Swal.fire({
      title: '<p class="h4 text-dark fw-bold">โปรดเลือกวันที่เข้ารับการรักษา</p>'+
            '<span class="h6">กรุณาเลือกวันที่ให้ชัดเจนก่อนการเข้ารับบริการ</span>',
      icon: 'warning',
      iconColor:'#ffc107',
      confirmButtonColor: '#ffc107',
      showConfirmButton: true,
      confirmButtonText: 'ตกลง',
    })
      countBtn = 3 ;
    }else if (statustime == 0) {
      Swal.fire({
      title: '<p class="h4 text-dark fw-bold">โปรดเลือกเวลาเข้ารับการรักษา</p>'+
      '<span class="h6">กรุณาเลือกเวลาให้ชัดเจนก่อนการเข้ารับบริการ</span>',
      icon: 'warning',
      confirmButtonColor: '#ffc107',
      showConfirmButton: true,
      confirmButtonText: 'ตกลง',
    })
      countBtn = 3 ;
    }else {
      Swal.fire({
      title: '<p class="h4 text-dark fw-bold">ยืนยันการจองคิวรักษาหรือไม่</p>'+
      '<span class="h6">โปรดตรวจสอบความเรียบร้อยของข้อมูล</span>',
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: 'ยืนยัน',
      cancelButtonText: 'ยกเลิก',
      }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
      let re_prefixname = $('#re_prefixname').val();
      let re_fname = $('#re_fname').val();
      let re_lname = $('#re_lname').val();
      let re_card_id = $('#re_card_id').val();
      let re_tel = $('#re_tel').val();
      let re_userage = $('#re_userage').val();
      let re_usersex = $('#re_usersex').val();
      let re_vaccine = $('#re_usercv_19').val();
      let re_useraddress = $('#re_useraddress').val();
      let re_user_cd = $('#re_user_cd').val();
      let re_user_da = $('#re_user_da').val();
      let re_stm = [];
            $.each($("input[name='re_stm_checkbox']:checked"), function(){
                re_stm.push($(this).val());
            });
      let re_stm_other = $('#re_stm_other').val();
      let re_date = $('#datehidden').val();
      let re_time = $('input[name=re_time]:checked', '#formstep3').val();
      $.ajax({
        url: "User/Reserve/InsertReserve.php",
        type: "POST",
        data: { 're_prefixname':re_prefixname,
                're_fname':re_fname,
                're_lname':re_lname,
                're_card_id':re_card_id,
                're_tel':re_tel,
                're_userage':re_userage,
                're_usersex':re_usersex,
                're_vaccine':re_vaccine,
                're_useraddress':re_useraddress,
                're_user_cd':re_user_cd,
                're_user_da':re_user_da,
                're_stm':re_stm,
                're_stm_other':re_stm_other,
                're_date':re_date,
                're_time':re_time
              },
        datatype: 'html',
        cache: false,
        success: function(data){
           let fulldate = moment(re_date).format('DD/MM/YYYY');
          // let d = re_date.getData();
          // let m =  re_date.getMonth();
          // let y =  re_date.getYear();
          $('#details_re_fullname').html(re_prefixname+re_fname+' '+re_lname);
          $('#details_re_card_id').html(re_card_id);
          $('#details_re_tel').html(re_tel);
          $('#details_re_date').html(fulldate);
          $('#details_re_time').html(re_time);

          if (re_stm !='' && re_stm_other !='') {
            re_stm_other =','+re_stm_other;
          }
          $('#details_stm').html(re_stm+re_stm_other);
          if (re_user_cd == '') {
            re_user_cd ='-';
          }
          if (re_user_da == '') {
            re_user_da ='-';
          }
          $('#details_re_cd').html(re_user_cd);
          $('#details_re_da').html(re_user_da);
          $('#details_re_va').html(re_vaccine);

          let datapack = data.split('|');

          if (parseInt(datapack[0])==0) {

            countBtn = 3 ;
            Swal.fire({
            title: '<p class="h4 text-dark fw-bold">หมายเลขบัตรประชาชน '+re_card_id+' นี้ มีรายการจองคิวกำลังดำเนินการอยู่</p>'+
                  '<span class="h6">โปรดรอจนกว่าการให้บริการจะดำเนินการเสร็จสิ้น จึงจะสามารถทำรายการใหม่ได้ หรือ </span>'+
                  '<span class="h6">หากต้องการยกเลิกรายการจองคิว กรุณาติดต่อ</span><br>'+
                  '<a href="tel:044235972" class="text-secondary text-decoration-none h6"><i class="fas fa-phone-alt"></i> 044-235972</a>',
            icon: 'warning',
            confirmButtonColor: '#ffc107',
            showConfirmButton: true,
            confirmButtonText: 'ยืนยัน',
          }).then((result) => {
            countBtn = 3 ;
          })

        }else if (parseInt(datapack[0])==1) {
            callblacknamesession(datapack[1]);
            Swal.fire({
            icon: 'success',
            title: '<p class="h4 text-dark fw-bold">การทำรายการจองคิวรักษาสำเร็จ</p>'+
            '<span class="h6">โปรดรอเจ้าหน้าที่ติดต่อกลับภายหลัง</span>',

            confirmButtonColor: '#198754',
            showConfirmButton: true,
            confirmButtonText: 'ตกลง',
          })
            $('#btnNext,#btnBack').hide();
            $('#activebaricon1,#activebaricon2,#activebaricon3').removeClass('bg02').addClass('bg-white');
            $('#activebaricon4').addClass('bg02').removeClass('bg-white');
            $('#stepnumberreserve1,#stepnumberreserve2,#stepnumberreserve3').addClass('txt01').removeClass('text-white');
            $('#stepnumberreserve4').addClass('text-white').removeClass('txt01');
            $('#step1,#step2,#step3,#step4').hide();
            $('#step4').show();
          }
        }
      })
    }
  })
    }
  }
});


$('.clickstm').on('click', function() {
if ($('.clickstm').is(':checked')) {
  $(".clickstm").prop('required',false);
  $('#txtwarningstm').hide();
  $('#re_stm_other').prop('required',false);
}else {
  let valstmorder =$('#re_stm_other').val().trim().length;
  if (valstmorder > 0) {
    $(".clickstm").prop('required',false);
    $('#txtwarningstm').hide();
  }else {
    $(".clickstm").prop('required',true);
    $('#re_stm_other').prop('required',true);
  }
}
})

$( "#re_stm_other" ).keyup(function() {
let valstmorder =$('#re_stm_other').val().trim().length;
if (valstmorder == 0) {
  if ($('.clickstm').is(':checked')) {
      $(".clickstm").prop('required',false);
      $('#txtwarningstm').hide();
  }else {
    $(".clickstm").prop('required',true);
    $("#re_stm_other").prop('required',true);
    $('#txtwarningstm').show();
  }
}else {
  $(".clickstm").prop('required',false);
  $('#txtwarningstm').hide();
}
});
