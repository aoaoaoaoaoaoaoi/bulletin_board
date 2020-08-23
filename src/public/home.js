/**
 * 読み込み時の処理
 */
window.onload = function(){
  setThreadData(null, null, null, null, null, null, null, false);
}

/**
 * スレッドを検索する
 * @param {*} button 
 */
var search = function(button){

  var groupId = document.getElementById('groupId').value;
  var title = document.getElementById('title').value;
  var tag = document.getElementById('tag').value;
  var startDateStart = document.getElementById('start-date-start').value;
  var startDateEnd = document.getElementById('start-date-end').value;
  var endDateStart = document.getElementById('end-date-start').value;
  var endDateEnd = document.getElementById('end-date-end').value;
  var isOnlyOwner = document.getElementById('is-only-owner').checked;

  setThreadData(groupId, title, tag, startDateStart, startDateEnd, endDateStart, endDateEnd, isOnlyOwner);
}
