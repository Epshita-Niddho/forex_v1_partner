

$(function () {
  //showNoti();
  function showNoti() {
    var noti = document.getElementById('noti-body-ajax').innerHTML;
    if (noti != "") {
      document.getElementById('notification-ajax').css('display','block')
      setTimeout(closeNoti, 5000);
    }
  }

  function closeNoti() {
    document.getElementById('notification-ajax').css('display','none')
  }

  function closeNotiAjax() {
    document.getElementById('notification-ajax').css('display','none');
  }



})