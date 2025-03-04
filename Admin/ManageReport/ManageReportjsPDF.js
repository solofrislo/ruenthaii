let apexchartsearchallPDF ='';
let apexchartsexPDF ='';
let apexchartstmPDF ='';

function downloadrepostPDFsearch() {
  colors = ['#03a9f4', '#FEB019'];
  var options = {
    series: [{
    data: [1,2]
  }],
    chart: {
    height: 400,
    width: 750,
    type: 'bar',
    animations:{
      enabled:false
    },
    events: {
      click: function(chart, w, e) {
        // console.log(chart, w, e)
      }
    }
  },
  colors: colors,
  title: {
    // text: 'กราฟเเสดงค่าจากการค้นหา',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  undefined,
      color:  '#263238'
    },
},
  plotOptions: {
    bar: {
      columnWidth: '30%',
      distributed: true,
    }
  },
  dataLabels: {
    enabled: true
  },
  legend: {
    show: true,
    position: 'top',
    horizontalAlign: 'left',
  },
  xaxis: {
    categories: [
      ['ข้อมูลที่ค้นหา'],
      ['ข้อมูลส่วนต่าง'],

    ],
    labels: {
      style: {
        colors: colors,
        fontSize: '12px'
      }
    }
  }
  };
  $('.hiddenchartPDF').show();
  $('#apexchartsearchallPDF').html('');
  $('.hiddenchartPDF').css('visibility','hidden');
  var chart = new ApexCharts(document.querySelector("#apexchartsearchallPDF"), options);
  chart.render().then(() => {
      chart.dataURI().then(({ imgURI, blob }) => {
          var pdf = new jsPDF();
          pdf.addImage(imgURI, 'PNG', 0, 0);
          pdf.save("รายงานสรุปผลที่ค้นหาคลินิกการเเพทย์แผนไทย.pdf");
      })
  })
  $('.hiddenchartPDF').hide();

}

function downloadrepostPDFall() {

if (search_PDF!='' && search_PDF!= null) {
  colors = ['#03a9f4', '#FEB019'];
  var options = {
    series: [{
    data: [1,2]
  }],
    chart: {
    height: 400,
    width: 750,
    type: 'bar',
    animations:{
      enabled:false
    },
    events: {
      click: function(chart, w, e) {
        // console.log(chart, w, e)
      }
    }
  },
  colors: colors,
  title: {
    // text: 'กราฟเเสดงค่าจากการค้นหา',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  undefined,
      color:  '#263238'
    },
},
  plotOptions: {
    bar: {
      columnWidth: '30%',
      distributed: true,
    }
  },
  dataLabels: {
    enabled: true
  },
  legend: {
    show: true,
    position: 'top',
    horizontalAlign: 'left',
  },
  xaxis: {
    categories: [
      ['ข้อมูลที่พบ'],
      ['ข้อมูลส่วนต่าง'],

    ],
    labels: {
      style: {
        colors: colors,
        fontSize: '12px'
      }
    }
  }
  };
  $('.hiddenchartPDF').show();
  $('#apexchartsearchallPDF').html('');
  $('.hiddenchartPDF').css('visibility','hidden');
  var chart = new ApexCharts(document.querySelector("#apexchartsearchallPDF"), options);
  chart.render().then(() => {
      chart.dataURI().then(({ imgURI, blob }) => {
        apexchartsearchallPDF = imgURI;
      })
  })
  $('.hiddenchartPDF').hide();

}



  // ...................................กราฟเพศ........................................
  $.ajax({
    url: "Admin/ManageReport/ReportSex.php",
    type: "POST",
    datatype: 'html',
    cache: false,
    success: function(data){
      let sex_counts =[];
      let datapack = data.split('|');
      $('#chartsex_male').html(datapack[0]);
      $('#chartsex_female').html(datapack[1]);
      for (var i = 0; i < datapack.length; i++) {
        sex_counts.push(parseInt(datapack[i]));
      }
      callbacksexPDF(sex_counts);
    }
  })

  function callbacksexPDF(sex_counts) {
    colors = ['#008FFB', '#FF4560'];
    var options = {
      series: [{
      data: sex_counts
    }],
      chart: {
      height: 400,
      width: 750,
      type: 'bar',
      animations:{
        enabled:false
      },
      events: {
        click: function(chart, w, e) {
          // console.log(chart, w, e)
        }
      }
    },
    colors: colors,
    title: {
      text: 'กราฟเเสดงค่าเปรียบเทียบเพศ',
      align: 'left',
      margin: 10,
      offsetX: 0,
      offsetY: 0,
      floating: false,
      style: {
        fontSize:  '14px',
        fontWeight:  'bold',
        fontFamily:  undefined,
        color:  '#263238'
      },
  },
    plotOptions: {
      bar: {
        columnWidth: '30%',
        distributed: true,
      }
    },
    dataLabels: {
      enabled: true
    },
    legend: {
      show: true,
      position: 'top',
      horizontalAlign: 'left',
    },
    xaxis: {
      categories: [
        ['เพศชาย'],
        ['เพศหญิง'],

      ],
      labels: {
        style: {
          colors: colors,
          fontSize: '12px'
        }
      }
    }
    };
    $('.hiddenchartPDF').show();
    $('#apexchartsexPDF').html('');
    $('.hiddenchartPDF').css('visibility','hidden');
    var chart = new ApexCharts(document.querySelector("#apexchartsexPDF"), options);
    chart.render().then(() => {
        chart.dataURI().then(({ imgURI, blob }) => {
          apexchartsexPDF = imgURI;
        })
    })
    $('.hiddenchartPDF').hide();
  }

  // ..................................กราฟอาการ...............................................
  $.ajax({
    url: "Admin/ManageReport/ReportStm.php",
    type: "POST",
    datatype: 'html',
    cache: false,
    success: function(data){
      let stm_counts = [];
      let datapack = data.split('|');
      $('#chart_stm1').html(datapack[0]);
      $('#chart_stm2').html(datapack[1]);
      $('#chart_stm3').html(datapack[2]);
      $('#chart_stm4').html(datapack[3]);
      $('#chart_stm5').html(datapack[4]);
      $('#chart_stm6').html(datapack[5]);
      $('#chart_stm7').html(datapack[6]);
      $('#chart_stm8').html(datapack[7]);
      $('#chart_stm9').html(datapack[8]);
      $('#chart_stm10').html(datapack[9]);

      if (datapack[9] < 1) {
      $('#chart_stm10details').hide();
    }else {
      $('#chart_stm10details').show();
    }

      for (var i = 0; i < datapack.length; i++) {
        stm_counts.push(parseInt(datapack[i]));
      }
      callbackstmPDF(stm_counts);
    }
  })

  function callbackstmPDF(stm_counts) {
    colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0' ,'#3f51b5', '#03a9f4', '#4caf50', '#f9ce1d', '#FF9800'];
    var options = {
      series: [{
      data: stm_counts
    }],
      chart: {
      height: 400,
      width: 750,
      type: 'bar',
      animations:{
        enabled:false
      },
      events: {
        click: function(chart, w, e) {
          // console.log(chart, w, e)
        }
      }
    },
    colors: colors,
    title: {
      text: 'กราฟเเสดงค่าเปรียบเทียบอาการ',
      align: 'left',
      margin: 10,
      offsetX: 0,
      offsetY: 0,
      floating: false,
      style: {
        fontSize:  '14px',
        fontWeight:  'bold',
        fontFamily:  undefined,
        color:  '#263238'
      },
  },
    plotOptions: {
      bar: {
        columnWidth: '70%',
        distributed: true,
      }
    },
    dataLabels: {
      enabled: true
    },
    legend: {
      show: true,
      position: 'top',
      horizontalAlign: 'left',
    },
    xaxis: {
      categories: [
        ['ปวดคอ บ่า ไหล่'],
        ['ปวดหลัง'],
        ['ปวดแขน'],
        ['ปวดสะโพก'],
        ['ไหล่ติด'],
        ['ปวดขา'],
        ['ปวดเข่า'],
        ['ปวดเท้า/รองช้ำ'],
        ['อัมพฤกษ์ อัมพาต'],
        ['อาการอื่น ๆ'],

      ],
      labels: {
        style: {
          colors: colors,
          fontSize: '12px'
        }
      }
    }
    };
    $('.hiddenchartPDF').show();
    $('#apexchartstmPDF').html('');
    $('.hiddenchartPDF').css('visibility','hidden');
    var chart = new ApexCharts(document.querySelector("#apexchartstmPDF"), options);
    chart.render().then(() => {
        chart.dataURI().then(({ imgURI, blob }) => {
          apexchartstmPDF = imgURI;
        })
    })
    $('.hiddenchartPDF').hide();
  }

// ..................................กราฟอายุ...............................................
$.ajax({
  url: "Admin/ManageReport/ReportAge.php",
  type: "POST",
  datatype: 'html',
  cache: false,
  success: function(data){
    let age_counts = [];
    let datapack = data.split('|');
    for (var i = 0; i < datapack.length; i++) {
      age_counts.push(parseInt(datapack[i]));
    }
    callbackagePDF(age_counts);
  }
})

function callbackagePDF(age_counts) {
  colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0' ,'#3f51b5', '#03a9f4', '#4caf50', '#f9ce1d', '#FF9800'];
  var options = {
    series: [{
    data: age_counts
  }],
    chart: {
    height: 400,
    width: 750,
    type: 'bar',
    animations:{
      enabled:false
    },
    events: {
      click: function(chart, w, e) {
        // console.log(chart, w, e)
      }
    }
  },
  colors: colors,
  title: {
    text: 'กราฟเเสดงค่าเปรียบเทียบอายุ',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  undefined,
      color:  '#263238'
    },
},
  plotOptions: {
    bar: {
      columnWidth: '50%',
      distributed: true,
    }
  },
  dataLabels: {
    enabled: true
  },
  legend: {
    show: true,
    position: 'top',
    horizontalAlign: 'left',
  },
  xaxis: {
    categories: [
      ['ต่ำกว่า 20 ปี'],
      ['20-30 ปี'],
      ['31-40 ปี'],
      ['41-50 ปี'],
      ['มากกว่า 50 ปี'],

    ],
    labels: {
      style: {
        colors: colors,
        fontSize: '12px'
      }
    }
  }
  };
  $('.hiddenchartPDF').show();
  $('#apexchartagePDF').html('');
  $('.hiddenchartPDF').css('visibility','hidden');
  var chart = new ApexCharts(document.querySelector("#apexchartagePDF"), options);
  chart.render().then(() => {
    setTimeout(function() {
      chart.dataURI().then(({ imgURI, blob }) => {
        let searchseccess = $('#dt_report_cnt_success').text().trim();
        let searchunsuccess = $('#dt_report_cnt_unsuccess').text().trim();
        let cntsexpdf1 = $('#chartsex_male').text().trim();
        let cntsexpdf2 = $('#chartsex_female').text().trim();
        let cnt_row_reerve_all = $('#cnt_row_reerve_all').text().trim();
        let cnt_row_reerve_status1 = $('#cnt_row_reerve_status1').text().trim();
        let cnt_row_reerve_status2 = $('#cnt_row_reerve_status2').text().trim();
        let cnt_row_reerve_status2_1 = $('#cnt_row_reerve_status2_1').text().trim();
        let cnt_row_reerve_status3 = $('#cnt_row_reerve_status3').text().trim();
        let cnt_stm1 = $('#chart_stm1').text().trim();
        let cnt_stm2 = $('#chart_stm2').text().trim();
        let cnt_stm3 = $('#chart_stm3').text().trim();
        let cnt_stm4 = $('#chart_stm4').text().trim();
        let cnt_stm5 = $('#chart_stm5').text().trim();
        let cnt_stm6 = $('#chart_stm6').text().trim();
        let cnt_stm7 = $('#chart_stm7').text().trim();
        let cnt_stm8 = $('#chart_stm8').text().trim();
        let cnt_stm9 = $('#chart_stm9').text().trim();
        let cnt_stm10 = $('#chart_stm10').text().trim();
        let chart_stm10details = $('#chart_stm10details').text().trim();
        let chart_age1 = $('#chart_age1').text().trim();
        let chart_age2 = $('#chart_age2').text().trim();
        let chart_age3 = $('#chart_age3').text().trim();
        let chart_age4 = $('#chart_age4').text().trim();
        let chart_age5 = $('#chart_age5').text().trim();

          var pdf = new jsPDF();
          pdf.addFont('THSarabunPSK.ttf', 'THSarabunPSK', 'normal');
              pdf.setFont('THSarabunPSK');

              pdf.addImage(imgLogo, 'JPEG', 93, 10, 25, 25)
              pdf.setFontSize(16)
              pdf.text(10, 45, 'รายงานผลกาารวิเคราะห์ข้อมูลผู้ใช้งานจากการจองคิวรักษาของ คลินิกการเเพทย์แผนไทย โรงพยาบาลมหาราชนครราชสีมา');
              pdf.setFontSize(16)
              pdf.text(10, 52, 'รายละเอียด'
                +'\n- รายการจองคิวทั้งหมด '+cnt_row_reerve_all+' ครั้ง'
                +'\n- รายการรอการอนุมัติ '+cnt_row_reerve_status1+' ครั้ง'
                +'\n- รายการอนุมัติเเล้ว '+cnt_row_reerve_status2+' ครั้ง'
                +'\n- รายการรับบริการเเล้ว '+cnt_row_reerve_status2_1+' ครั้ง'
                +'\n- รายการไม่ได้รับบริการ '+cnt_row_reerve_status3+' ครั้ง');

                pdf.addPage();
          if (search_PDF!='' && search_PDF!= null) {
              pdf.addImage(apexchartsearchallPDF, 'PNG', 5,10);
              pdf.setFontSize(14)
              pdf.text(10, 125, 'ข้อมูลการค้นหา'
              +'\n- ค้นหาจาก: '+totalsearchstepPDF
              +'\n- ข้อมูลที่พบ '+searchseccess+' ครั้ง'
              +'\n- ข้อมูลส่วนต่าง '+searchunsuccess+' ครั้ง'
              +'\n- ทั้งหมด '+cnt_row_reerve_all+' ครั้ง')
              pdf.addPage();
              }
              pdf.addImage(apexchartsexPDF, 'PNG', 5,10);
              pdf.setFontSize(14)
              pdf.text(10, 125, 'ข้อมูลเพศ'
              +'\n- ชาย '+cntsexpdf1+' ครั้ง'
              +'\n- หญิง '+cntsexpdf2+' ครั้ง'
              +'\n- ทั้งหมด '+cnt_row_reerve_all+' ครั้ง');
              pdf.addPage();

              pdf.addImage(apexchartstmPDF, 'PNG', 5,10);
              pdf.setFontSize(14)
              pdf.text(10, 125, 'ข้อมูลอากาศ'
              +'\n- ปวดคอ บ่า ไหล่ '+cnt_stm1+' ครั้ง'
              +'\n- ปวดหลัง '+cnt_stm2+' ครั้ง'
              +'\n- ปวดแขน '+cnt_stm3+' ครั้ง'
              +'\n- ปวดสะโพก '+cnt_stm4+' ครั้ง'
              +'\n- ไหล่ติด '+cnt_stm5+' ครั้ง'
              +'\n- ปวดขา '+cnt_stm6+' ครั้ง'
              +'\n- ปวดเข่า '+cnt_stm7+' ครั้ง'
              +'\n- ปวดเท้า/รองช้ำ '+cnt_stm8+' ครั้ง'
              +'\n- อัมพฤกษ์ อัมพาต '+cnt_stm9+' ครั้ง'
              +'\n- อาการอื่น ๆ '+cnt_stm10+' ครั้ง');

              if (cnt_stm10 !='0') {
                pdf.text(10, 188, '  ได้แก่ '+chart_stm10details);
              }
              pdf.addPage();

              pdf.addImage(imgURI, 'PNG', 5,10);
              pdf.setFontSize(14)
              pdf.text(10, 125, 'ข้อมูลอายุ'
              +'\n- ต่ำกว่า 20 ปี '+chart_age1+' ครั้ง'
              +'\n- 20-30 ปี '+chart_age2+' ครั้ง'
              +'\n- 31-40 ปี '+chart_age3+' ครั้ง'
              +'\n- 41-50 ปี '+chart_age4+' ครั้ง'
              +'\n- มากกว่า 50 ปี '+chart_age5+' ครั้ง'
              +'\n- ทั้งหมด '+cnt_row_reerve_all+' ครั้ง');

              pdf.save("รายงานสรุปผลทั้งหมดคลินิกการเเพทย์แผนไทย.pdf");
      })
    },100);
  })
  $('.hiddenchartPDF').hide();
}

}
