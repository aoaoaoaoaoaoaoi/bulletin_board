$(function() {
    /*クリックイベント*/
    $('.tab-menu').on('click', function() {
      $('.tab-item').removeClass('is-active-item');
      $($(this).attr("href")).addClass('is-active-item');
      $('.tab-menu').removeClass('is-active-btn');
      $(this).addClass('is-active-btn');
      return false;
    });
  });

/**
 * 読み込み時の処理
 */
window.onload = function(){
  let param = location.search;
  let userId = param.replace("?userId=", "");
  setThreadData(groupId, null, null, null, null, null, null, false);
  setGroupData(groupName);
}