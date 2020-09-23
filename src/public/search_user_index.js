/**
 * 読み込み時の処理
 */
window.onload = function(){
  searchUserData(null, null, null);
}

/**
 * スレッドを検索する
 * @param {*} button 
 */
var search = function(button){

  var groupId = document.getElementById('groupId').value;
  var title = document.getElementById('title').value;
  var tag = document.getElementById('tag').value;

  searchUserData(groupId, title, tag);
}
