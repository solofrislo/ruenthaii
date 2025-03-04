
let search_PDF ='';
function callbacksearchallPDF(data) {
  search_PDF = data;
}

$( document ).ready(function() {
  $('#apexchartsearchallshow').hide();
});

let sex ='';
let age ='';
let stm ='';
let day ='';
let month ='';
let year ='';

let txtsex ='';
let txtage ='';
let txtstm ='';
let txtday ='';
let txtmonth ='';
let txtyear ='';

let totalsearch ='';

let cntsex = 0;
let cntage = 0;
let cntstm = 0;
let cntday = 0;
let cntmonth = 0;
let cntyear = 0;


$('.changesearchreport').change(function() {
  let id =$(this).attr('id');
if (id == 'sexsearchreport') {
  sex = $(this).val();
  txtsex =$('#sexsearchreport option:selected').text();
  cntsex = 1;
}else if (id == 'agesearchreport') {
  age = $(this).val();
  txtage =$('#agesearchreport option:selected').text();
  cntage = 1;
}else if (id =='stmsearchreport') {
  stm = $(this).val();
  txtstm =$('#stmsearchreport option:selected').text();
  cntstm = 1;
}else if (id =='daysearchreport') {
  day = $(this).val();
  txtday =$('#daysearchreport option:selected').text();
  cntday = 1;
}else if (id =='monthsearchreport') {
  month = $(this).val();
  txtmonth =$('#monthsearchreport option:selected').text();
  cntmonth = 1;
}else if (id =='yearsearchreport') {
  year = $(this).val();
  txtyear =$('#yearsearchreport option:selected').text();
  cntyear = 1;
}

let andtxt1 ='';
let andtxt2 ='';
let andtxt3 ='';
let andtxt4 ='';
let andtxt5 ='';


if (txtage !='') {
  if (txtsex !='') {
    andtxt1 =' &raquo; ';
  }else {
    andtxt1 ='';
  }
}else {
andtxt1 ='';
}

if (txtstm !='') {
  if (txtsex !='' || txtage !='') {
    andtxt2 =' &raquo; ';
  }else {
    andtxt2 ='';
  }
}else {
andtxt2 ='';
}

if (txtday !='') {
  if (txtsex !='' || txtage !='' || txtstm !='') {
    andtxt3 =' &raquo; ';
  }else {
    andtxt3 ='';
  }
}else {
andtxt3 ='';
}

if (txtmonth !='') {
  if (txtsex !='' || txtage !='' || txtstm !='' || txtday !='') {
    andtxt4 =' &raquo; ';
  }else {
    andtxt4 ='';
  }
}else {
andtxt4 ='';
}

if (txtyear !='') {
  if (txtsex !='' || txtage !='' || txtstm !='' || txtday !='' || txtmonth !='') {
    andtxt5 =' &raquo; ';
  }else {
    andtxt5 ='';
  }
}else {
andtxt5 ='';
}
// ..................................step PDF......................................................
let andtxtPDF1 ='';
let andtxtPDF2 ='';
let andtxtPDF3 ='';
let andtxtPDF4 ='';
let andtxtPDF5 ='';


if (txtage !='') {
  if (txtsex !='') {
    andtxtPDF1 =' / ';
  }else {
    andtxtPDF1 ='';
  }
}else {
andtxtPDF1 ='';
}

if (txtstm !='') {
  if (txtsex !='' || txtage !='') {
    andtxtPDF2 =' / ';
  }else {
    andtxtPDF2 ='';
  }
}else {
andtxtPDF2 ='';
}

if (txtday !='') {
  if (txtsex !='' || txtage !='' || txtstm !='') {
    andtxtPDF3 =' / ';
  }else {
    andtxtPDF3 ='';
  }
}else {
andtxtPDF3 ='';
}

if (txtmonth !='') {
  if (txtsex !='' || txtage !='' || txtstm !='' || txtday !='') {
    andtxtPDF4 =' / ';
  }else {
    andtxtPDF4 ='';
  }
}else {
andtxtPDF4 ='';
}

if (txtyear !='') {
  if (txtsex !='' || txtage !='' || txtstm !='' || txtday !='' || txtmonth !='') {
    andtxtPDF5 =' / ';
  }else {
    andtxtPDF5 ='';
  }
}else {
andtxtPDF5 ='';
}
totalsearchstepPDF = txtsex+andtxtPDF1+txtage+andtxtPDF2+txtstm+andtxtPDF3+txtday+andtxtPDF4+txtmonth+andtxtPDF5+txtyear;
// ...........................................................................................

let and1 ='';
let and2 ='';
let and3 ='';
let and4 ='';
let and5 ='';

if (cntage == 1) {
  if (cntsex == 1) {
    and1 =' AND ';
  }else {
    and1 ='';
  }
}else{
  and1 ='';
}

if (cntstm == 1) {
  if (cntsex == 1 ||cntage == 1) {
    and2 =' AND ';
  }else {
    and2 ='';
  }
}else{
  and2 ='';
}

if (cntday == 1) {
  if (cntsex == 1 || cntage == 1 ||cntstm == 1) {
    and3 =' AND ';
  }else {
    and3 ='';
  }
}else{
  and3 ='';
}

if (cntmonth == 1) {
  if (cntsex == 1 || cntage == 1 || cntstm == 1 ||cntday == 1) {
    and4 =' AND ';
  }else {
    and4 ='';
  }
}else{
  and4 ='';
}

if (cntyear == 1) {
  if (cntsex == 1 || cntage == 1 || cntstm == 1 ||cntday == 1 || cntmonth == 1 ) {
    and5 =' AND ';
  }else {
    and5 ='';
  }
}else{
  and5 ='';
}
totalsearch = sex+and1+age+and2+stm+and3+day+and4+month+and5+year;
totalsearchstep = txtsex+andtxt1+txtage+andtxt2+txtstm+andtxt3+txtday+andtxt4+txtmonth+andtxt5+txtyear;


//...................................................กราฟค้นหา.....................................................
$.ajax({
  url: "Admin/ManageReport/SearchReport.php",
  type: "POST",
  data: {'search':totalsearch},
  datatype: 'html',
  cache: false,
  success: function(data){
    $('#apexchartsearchallshow').show();
    $('#dtreportall').html(totalsearchstep);
    let searchall =[];
    let datapack = data.split('|');
    $('#dt_report_cnt_success').text(datapack[0]);
    $('#dt_report_cnt_unsuccess').text(datapack[1]);
    for (var i = 0; i < datapack.length; i++) {
      searchall.push(parseInt(datapack[i]));
    }
    callbacksearchall(searchall);
    callbacksearchallPDF(searchall);
  }
})

function callbacksearchall(searchall) {
  colors = ['#03a9f4', '#FEB019'];
  var options = {
    series: [{
    data: searchall
  }],
    chart: {
    height: 290,
    type: 'bar',
    events: {
      click: function(chart, w, e) {
        // console.log(chart, w, e)
      }
    }
  },
  colors: colors,
  title: {
    text: 'กราฟเเสดงค่าจากการค้นหา',
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
  $('#apexchartsearchall').html('');
  var chart = new ApexCharts(document.querySelector("#apexchartsearchall"), options);
  chart.render();
}

});


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
    callbacksex(sex_counts);
  }
})

function callbacksex(sex_counts) {
  colors = ['#008FFB', '#FF4560'];
  var options = {
    series: [{
    data: sex_counts
  }],
    chart: {
    height: 290,
    type: 'bar',
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

  var chart = new ApexCharts(document.querySelector("#apexchartsex"), options);
  chart.render();

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
    $('#chart_stm10detailsshow').hide();
  }else {
    $('#chart_stm10detailsshow').show();
  }

    for (var i = 0; i < datapack.length; i++) {
      stm_counts.push(parseInt(datapack[i]));
    }
    callbackstm(stm_counts);
  }
})

function callbackstm(stm_counts) {
  colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0' ,'#3f51b5', '#03a9f4', '#4caf50', '#f9ce1d', '#FF9800'];
  var options = {
    series: [{
    data: stm_counts
  }],
    chart: {
    height: 290,
    type: 'bar',
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

  var chart = new ApexCharts(document.querySelector("#apexchartstm"), options);
  chart.render();
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
    $('#chart_age1').html(datapack[0]);
    $('#chart_age2').html(datapack[1]);
    $('#chart_age3').html(datapack[2]);
    $('#chart_age4').html(datapack[3]);
    $('#chart_age5').html(datapack[4]);


    for (var i = 0; i < datapack.length; i++) {
      age_counts.push(parseInt(datapack[i]));
    }
    callbackage(age_counts);
  }
})

function callbackage(age_counts) {
  colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0' ,'#3f51b5', '#03a9f4', '#4caf50', '#f9ce1d', '#FF9800'];
  var options = {
    series: [{
    data: age_counts
  }],
    chart: {
    height: 290,
    type: 'bar',
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

  var chart = new ApexCharts(document.querySelector("#apexchartage"), options);
  chart.render();
}
