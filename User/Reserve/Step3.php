<div class="col-12 my-5">
  <div class="row">
    <div class="col-xl-6 col-lg-6 col-sm-5 col-12 pt-4">
      <div class="row justify-content-center">
        <div class="txt01 h5 fw-bold text-center">เลือกวันที่</div>
      </div>
        <div class="calendar-light"></div>
      <input type="hidden" name="" value="" id="datehidden">
    </div>
    <div class="col-xl-6 col-lg-6 col-sm-5 col-12 px-xl-4 px-lg-4 px-sm-4 px-2 pt-4">
      <div class="text-center txt01 h5 fw-bold">เลือกเวลา</div>
      <div class="row justify-content-center" id="rowdetailssredatetime">
        <div class="card col-12 bg02" id="detailsredatetime">
          <div class="card-body py-2">
            <div class="text-center h6 fw-bold text-white">
              วันเวลาที่เลือก
            </div>
            <div class="d-flex justify-content-center">
              <span id="datedetailsshow"></span><span class="ms-1"id="timedetailsshow"></span>
            </div>
          </div>
        </div>
      </div>
      <form class="needs-validation" novalidate id="formstep3">
        <div class="row justify-content-start mt-2"id="step3_1">
          <div class="text-start txt01 h6 fw-bold pb-1" id="round1">ช่วงเช้า</div>
          <div class="col-xl-6 col-lg-6 col-sm-6 col-6 px-1 pb-2 timeround1" id="T-08-30">
            <input type="radio" class="btn-check clicktime" value="08:30" name="re_time" id="reradiobtnstm1" autocomplete="off" required>
            <label class="checkedtime txt01 btn btn-outline-danger border-red txt14 form-control clicktime shadow-none border" for="reradiobtnstm1">08.30 น.</label>
          </div>
          <div class="col-xl-6 col-lg-6 col-sm-6 col-6 px-1 pb-2 timeround1" id="T-10-30">
            <input type="radio" class="btn-check clicktime" value="10:30" name="re_time" id="reradiobtnstm2" autocomplete="off" required>
            <label class="checkedtime txt01 btn btn-outline-danger border-red txt14 form-control clicktime shadow-none border" for="reradiobtnstm2">10.30 น</label>
          </div>
          <div class="text-start txt01 h6 fw-bold pt-3 pb-1" id="round2">ช่วงบ่าย</div>
          <div class="col-xl-6 col-lg-6 col-sm-6 col-6 px-1 pb-2 timeround2" id="T-13-00">
            <input type="radio" class="btn-check clicktime" value="13:00" name="re_time" id="reradiobtnstm3" autocomplete="off" required>
            <label class="checkedtime txt01 btn btn-outline-danger border-red txt14 form-control clicktime shadow-none border" for="reradiobtnstm3">13.00 น.</label>
          </div>
          <div class="col-xl-6 col-lg-6 col-sm-6 col-6 px-1 pb-2 timeround2" id="T-14-00">
            <input type="radio" class="btn-check clicktime" value="14:00" name="re_time" id="reradiobtnstm4" autocomplete="off" required>
            <label class="checkedtime txt01 btn btn-outline-danger border-red txt14 form-control clicktime shadow-none border" for="reradiobtnstm4">14.00 น</label>
          </div>
          <div class="text-start txt01 h6 fw-bold pt-3 pb-1" id="round3">นอกเวลาราชการ</div>
          <div class="col-xl-6 col-lg-6 col-sm-6 col-6 px-1 pb-2 timeround3" id="T-16-00">
            <input type="radio" class="btn-check clicktime" value="16:00" name="re_time" id="reradiobtnstm5" autocomplete="off" required>
            <label class="checkedtime txt01 btn btn-outline-danger border-red txt14 form-control clicktime shadow-none border" for="reradiobtnstm5">16.00 น</label>
          </div>
          <div class="col-xl-6 col-lg-6 col-sm-6 col-6 px-1 pb-2 timeround3" id="T-18-00">
            <input type="radio" class="btn-check clicktime" value="18:00" name="re_time" id="reradiobtnstm6" autocomplete="off" required>
            <label class="checkedtime txt01 btn btn-outline-danger border-red txt14 form-control clicktime shadow-none border" for="reradiobtnstm6">18.00 น</label>
          </div>
        </div>
        <div class="row justify-content-start mt-2" id="step3_2">
          <div class="text-start txt01 h6 fw-bold pt-3 pb-1" id="round4">นอกเวลาราชการ</div>
          <div class="col-xl-6 col-lg-6 col-sm-6 col-6 px-1 pb-2 timeround4" id="T-08-00">
            <input type="radio" class="btn-check clicktime" value="08:00" name="re_time" id="reradiobtnstm7" autocomplete="off" required>
            <label class="checkedtime txt01 btn btn-outline-danger border-red txt14 form-control clicktime shadow-none border" for="reradiobtnstm7">08.00 น</label>
          </div>
          <div class="col-xl-6 col-lg-6 col-sm-6 col-6 px-1 pb-2 timeround4" id="T-10-00">
            <input type="radio" class="btn-check clicktime" value="10:00" name="re_time" id="reradiobtnstm8" autocomplete="off" required>
            <label class="checkedtime txt01 btn btn-outline-danger border-red txt14 form-control clicktime shadow-none border" for="reradiobtnstm8">10.00 น</label>
          </div>
        </div>

        <div class="row justify-content-center" id="step3_3">
          <div class="card py-0 col-12 border-0">
            <div class="card-body">
              <div class="txt01 txt12 fw-bold">หมายเหตุ</div>
              <div class="row mt-2">
                <div class="col-auto text-start my-auto pe-1 txt12"><div class="rounded-circle border border-1 border-dark" style="background-color:#ffffff;height:15px; width:15px;"></div></div>
                <div class="col-auto text-start ps-0 my-auto txt12"> เปิดให้บริการ</div>
              </div>
              <div class="txt12 ps-4">ในเวลาราชการ</div>
              <li class="txt12 ps-4">วันจันทร์ - ศุกร์  เวลา 08.00 - 16.00 น.</li>
              <div class="txt12 mt-1 ps-4">นอกเวลาราชการ</div>
              <li class="txt12 ps-4">วันจันทร์ - ศุกร์  เวลา 16.00 - 20.00 น.</li>
              <div class="row mt-2">
                <div class="col-auto text-start my-auto pe-1 txt12"><div class="rounded-circle border border-1 border-dark" style="background-color:#efefef;height:15px; width:15px;"></div></div>
                <div class="col-auto text-start ps-0 my-auto txt12"> ปิดบริการ</div>
              </div>
              <li class="txt12 ps-4">วันอาทิตย์ และวันหยุดนักขัตฤกษ์</li>
            </div>
          </div>
          <div class="col-10 text-center">
            <img src="Img/ImgWeb/7880.png" class="col-12 mt-4"/>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>

let statusdate = 0;
let datapack =[];
$( document ).ready(function() {
$('#step3_1,#step3_2,#datedetailsshow').hide();
$('#step3_3').show();
  $.ajax({
    url: "User/Reserve/SelectDataLimit.php",
    type: "POST",
    data: {'datalimit':0},
    datatype: 'html',
    cache: false,
    success: function(data){
      datapack = data.split('|');
      cb_datalimit(datapack);
    }
  })
});

function cb_datalimit(datelimit) {
  $('.clicktime').click(function() {
    $('#timedetailsshow').html('<span class="text-secondary px-2 bg-white rounded-pill fw-bold txt12">'+$(this).val()+' น.</span>');
     if($('.clicktime').is(':checked')) {
       statustime = 1 ;
      }
  });

  var vardateoff = [];
  $("input[name='dateoff']").each(function() {
      vardateoff.push($(this).val());
  });
  //<![CDATA[
  $(function () {

      $('#wrapper .version strong').text('v' + $.fn.pignoseCalendar.version);

      function onSelectHandler(date, context) {
        var monthNamesThai = ["ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.",
        "ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];

        var dayNames = ["อาทิตย์","จันทร์","อังคาร","พุทธ","พฤหัสบดี","ศุกร์","เสาร์"];

        var d = new Date(date[0]);
          let datesl = dayNames[d.getDay()]+', '+d.getDate()+" "+monthNamesThai[d.getMonth()]+"  "+(543+d.getFullYear());
          var $element = context.element;
          var $calendar = context.calendar;
          var text = '<span class="rounded-pill px-2" style="background-color:#b3e5fc;"><i class="far fa-calendar-alt"></i> ';

          if (date[0] !== null) {
          $('.checkedtime').addClass('btn-outline-danger txt01').removeClass('bg02 text-white');
          $('#datedetailsshow').show();
          $('#sorry_fulltime').remove();
          $('#datedetailsshow').html('<span class="text-secondary px-2 bg-white rounded-pill fw-bold txt12">'+datesl+'</span>');
          $('#timedetailsshow').html('');
          $('#rowdetailssredatetime').show();
          $('#step3_3').hide();
          $('.clicktime').prop('checked',false);
          $('#datehidden').val(date[0]);
          statusdate = 1 ;
          let dateclick = date[0].format('YYYY-MM-DD');
          let idtimesh =['T-08-30','T-10-30','T-13-00','T-14-00','T-16-00','T-18-00','T-08-00','T-10-00'];
          for (var i = 0; i < idtimesh.length; i++) {
            $('#'+idtimesh[i]).hide();
          }
          $.ajax({
            url: "User/Reserve/SelectTimeOff.php",
            type: "POST",
            data: {'dateclick':dateclick},
            datatype: 'html',
            cache: false,
            success: function(data){
              if (data == 0) {
                let idtimesh =['T-08-30','T-10-30','T-13-00','T-14-00','T-16-00','T-18-00','T-08-00','T-10-00'];
                for (var i = 0; i < idtimesh.length; i++) {
                  $('#'+idtimesh[i]).show();
                }
              }else {
                var timeoff = data.split(',');
                // console.log('time = ',time);
                for (var i = 0; i < timeoff.length; i++) {
                  var temptimeoff = timeoff[i];
                  // console.log('time i ',i,' = ',tempTime.trim());
                  $('#'+temptimeoff.trim()).show();
                }
              }
              let timehideots1 = $('.timeround1:not([style*="display: none"])').length;
              let timehideots2 = $('.timeround2:not([style*="display: none"])').length;
              let timehideots3 = $('.timeround3:not([style*="display: none"])').length;
              let timehideots4 = $('.timeround4:not([style*="display: none"])').length;

              if (timehideots1 == 0) {
                $('#round1').hide();
              }else {
                $('#round1').show();
              }
              if (timehideots2 == 0) {
                $('#round2').hide();
              }else {
                $('#round2').show();
              }
              if (timehideots3 == 0) {
                $('#round3').hide();
              }else {
                $('#round3').show();
              }
              if (timehideots4 == 0) {
                $('#round4').hide();
              }else {
                $('#round4').show();
              }
              checkdaycancle();
            }
          })
  function checkdaycancle() {
    let day = d.getDay();
    if (day == 6) {
      statustime = 0 ;
      let normal_day = 0;
      let timecancle = date[0].format('YYYY-MM-DD');
      $.ajax({
        url: "User/Reserve/SelectTimecancle.php",
        type: "POST",
        data: {'timecancle':timecancle,'normal_day':normal_day},
        datatype: 'html',
        cache: false,
        success: function(data){
          if (data !=0 ) {
            let datapack = data.split('|');
            let cnt_day_cancle1 = 0 ;
            let cnt_day_cancle2 = 0 ;
            if (parseInt(datelimit[1]) == 0) {
              $('#T-08-00').hide();
              $('#T-10-00').hide();
              $('#round4').hide();
              $('#step3_2').append(
                '<div class="col-12 text-center" id="sorry_fulltime">'+
                  '<div class="txt13 txt01 mt-3">จำนวนการรับจองคิวเต็มแล้ว</div>'+
                  '<div class="txt13 text-secondary mb-4">ขออภัยในความไม่สะดวก กรุณาเลือกวันและเวลาที่สะดวกในครั้งถัดไป</div>'+
                  '  <img src="Img/ImgWeb/3255339.png" class="col-11"/>'+
                '</div>'
              );
            }else if (parseInt(datelimit[1]) > 0) {
              if (datapack[0]>=parseInt(datelimit[1])) {
                $('#T-08-00').hide();
                cnt_day_cancle1 = 1 ;
              }

              if (datapack[1]>=parseInt(datelimit[1])) {
                $('#T-10-00').hide();
                cnt_day_cancle2 = 1 ;
              }

              if (cnt_day_cancle1==1 && cnt_day_cancle2==1) {
                $('#round4').hide();
                $('#step3_2').append(
                  '<div class="col-12 text-center" id="sorry_fulltime">'+
                    '<div class="txt13 txt01 mt-3">จำนวนการรับจองคิวเต็มแล้ว</div>'+
                    '<div class="txt13 text-secondary mb-4">ขออภัยในความไม่สะดวก กรุณาเลือกวันและเวลาที่สะดวกในครั้งถัดไป</div>'+
                    '  <img src="Img/ImgWeb/3255339.png" class="col-11"/>'+
                  '</div>'
                );
              }
            }

          }else if (data == 0) {

          }
        }
      })
      $('#step3_2').show();
      $('#step3_1').hide();
    }else {
      statustime = 0 ;
      let normal_day =1;
      let timecancle = date[0].format('YYYY-MM-DD');
      $.ajax({
        url: "User/Reserve/SelectTimecancle.php",
        type: "POST",
        data: {'timecancle':timecancle,'normal_day':normal_day},
        datatype: 'html',
        cache: false,
        success: function(data){
          if (data !=0) {
            let datapack = data.split('|');
            let cnt_day_cancle1 = 0 ;
            let cnt_day_cancle2 = 0 ;
            let cnt_day_cancle3 = 0 ;
            let cnt_day_cancle4 = 0 ;
            let cnt_day_cancle5 = 0 ;
            let cnt_day_cancle6 = 0 ;

            if (parseInt(datelimit[1]) == 0) {
                $('#T-08-30').hide();
                $('#T-10-30').hide();
                $('#T-13-00').hide();
                $('#T-14-00').hide();
                $('#T-16-00').hide();
                $('#T-18-00').hide();
                $('#round1').hide();
                $('#round2').hide();
                $('#round3').hide();
                $('#step3_1').append(
                  '<div class="col-12 text-center" id="sorry_fulltime">'+
                    '<div class="txt13 txt01 mt-3">จำนวนการรับจองคิวเต็มแล้ว</div>'+
                    '<div class="txt13 text-secondary mb-4">ขออภัยในความไม่สะดวก กรุณาเลือกวันและเวลาที่สะดวกในครั้งถัดไป</div>'+
                    '<img src="Img/ImgWeb/3255339.png" class="col-11"/>'+
                  '</div>'
                );
            }else if (parseInt(datelimit[1]) > 0) {
              //ทำเป็นชุดเเบบนี้
              //*************************************
              if (datapack[0]>= parseInt(datelimit[1])) {
                $('#T-08-30').hide();
                cnt_day_cancle1 = 1 ;
              }
              if (datapack[1]>= parseInt(datelimit[1])) {
                $('#T-10-30').hide();
                cnt_day_cancle2 = 1 ;
              }
              if (cnt_day_cancle1 == 1 && cnt_day_cancle2 == 1) {
                $('#round1').hide();
              }else {
                $('#round1').show();
              }
              //***************************************
              if (datapack[2]>= parseInt(datelimit[1])) {
                $('#T-13-00').hide();
                cnt_day_cancle3 = 1 ;
              }
              if (datapack[3]>= parseInt(datelimit[1])) {
                $('#T-14-00').hide();
                cnt_day_cancle4 = 1 ;
              }
              if (cnt_day_cancle3 == 1 && cnt_day_cancle4 == 1) {
                $('#round2').hide();
              }else {
                $('#round2').show();
              }

              //*****************************************
              if (datapack[4]>= parseInt(datelimit[1])) {
                $('#T-16-00').hide();
                cnt_day_cancle5 = 1 ;
              }
              if (datapack[5]>= numstopround) {
                $('#T-18-00').hide();
                cnt_day_cancle6 = 1 ;
              }
              if (cnt_day_cancle5 == 1 && cnt_day_cancle6 == 1) {
                $('#round3').hide();
              }else {
                $('#round3').show();
              }



              if (cnt_day_cancle1 == 1 && cnt_day_cancle2 == 1 && cnt_day_cancle3 == 1 && cnt_day_cancle4 == 1 && cnt_day_cancle5 == 1 && cnt_day_cancle6 == 1) {
                $('#step3_1').append(
                  '<div class="col-12 text-center" id="sorry_fulltime">'+
                    '<div class="txt13 txt01 mt-3">จำนวนการรับจองคิวเต็มแล้ว</div>'+
                    '<div class="txt13 text-secondary mb-4">ขออภัยในความไม่สะดวก กรุณาเลือกวันและเวลาที่สะดวกในครั้งถัดไป</div>'+
                    '<img src="Img/ImgWeb/3255339.png" class="col-11"/>'+
                  '</div>'
                );
              }
            }

          }else if (data == 0) {

          }
        }
      })
      $('#step3_2').hide();
      $('#step3_1').show();
    }
  }


        }else if (date[0] === null && date[1] == null) {
          $('.checkedtime').addClass('btn-outline-danger txt01').removeClass('bg02 text-white');
          $('#datedetailsshow').hide();
          $('#sorry_fulltime').remove();
          let idtimesh =['T-08-30','T-10-30','T-13-00','T-14-00','T-16-00','T-18-00','T-08-00','T-10-00'];
          for (var i = 0; i < idtimesh.length; i++) {
            $('#'+idtimesh[i]).hide();
          }
          statusdate = 0;
          $('#timedetailsshow').html('');
          $('.clicktime').prop('checked',false);
          $('#step3_3').show();
          $('#step3_1,#step3_2').hide();
        }
      }

      function onApplyHandler(date, context) {
          var $element = context.element;
          var $calendar = context.calendar;
          var text = 'You applied date ';

          if (date[0] !== null) {
              text += date[0].format('YYYY-MM-DD');
          }

          if (date[0] !== null && date[1] !== null) {
              text += ' ~ ';
          }
          else if (date[0] === null && date[1] == null) {
              text += 'nothing';
          }

          if (date[1] !== null) {
              text += date[1].format('YYYY-MM-DD');
          }

      }
      // Calendar modal
      var $btn = $('.btn-calendar').pignoseCalendar({
          apply: onApplyHandler,
          modal: true, // It means modal will be showed when you click the target button.
          buttons: true
      });

      var datenow = new Date();
      datenow.setDate(datenow.getDate() + parseInt(datelimit[0])); //add 6 days กำหนดวันที่จะบล็อค
      // Blue theme type Calendar
      $('.calendar-light').pignoseCalendar({
          theme: 'light', // light, dark, blue
          lang: 'th',
          //วันหยุด
          disabledDates: vardateoff,
          //หยุด วันเสาร์ - อาทิตย์
          disabledWeekdays: [0], // SUN (0), SAT (6)
          minDate: datenow,
          select: onSelectHandler
      });

      // This use for DEMO page tab component.
      $('.menu .item').tab();
  });
}

</script>
