function showmenuadmin(){
  $('#hiddenmenuadmin').toggleClass('d-none', 2000);
}

let active_menu = $('#active_menu').val();
if (active_menu == 'ManageReserve') {
  $('#active_menu_reserve').addClass('bg02 text-white');
}else if (active_menu == 'User') {
  $('#active_menu_user').addClass('bg02 text-white');
}else if (active_menu == 'ManageDoctor') {
  $('#active_menu_ManageDoctor').addClass('bg02 text-white');
}else if (active_menu == 'ManageDateTime') {
  $('#active_menu_ManageDateTime').addClass('bg02 text-white');
}else if (active_menu == 'ManageNews') {
  $('#active_menu_ManageNews').addClass('bg02 text-white');
}else if (active_menu == 'ManageReport') {
  $('#active_menu_ManageReport').addClass('bg02 text-white');
}else if (active_menu == 'ManageBanner') {
  $('#active_menu_ManageBanner').addClass('bg02 text-white');
}else if (active_menu == 'ManageVideo') {
  $('#active_menu_ManageVideo').addClass('bg02 text-white');
}else if (active_menu == 'ManageClinic') {
  $('#active_menu_ManageClinic').addClass('bg02 text-white');
}
