function callblacknamesession(namesession) {
$('#namesession').text(namesession);
$('#menuregisterlogin').html(
  '<li class="mt-xl-0 mt-lg-0 mt-1 hover-red-bg"><a class="text-decoration-none px-3 my-1 hover-txt-red-to-white txt13 col-12" href="Index.php?action=DataUser"><i class="fa fa-id-card-o" aria-hidden="true"></i> บัญชีผู้ใช้งาน</a></li>'+
  '<li class="mt-xl-0 mt-lg-0 mt-1 hover-red-bg"><a class="text-decoration-none px-3 my-1 hover-txt-red-to-white txt13 col-12" href="Index.php?action=HistoryReserve"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> ประวัติการจอง</a></li>'+
  '<li class="mt-xl-0 mt-lg-0 mt-1 hover-red-bg"><a class="text-decoration-none px-3 my-1 hover-txt-red-to-white txt13 col-12" data-bs-toggle="modal" data-bs-target="#modallogout"><i class="fas fa-power-off"></i> ออกจากระบบ</a></li>'
  )
}
