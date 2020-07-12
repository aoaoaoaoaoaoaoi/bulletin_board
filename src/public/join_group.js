//グローバル変数
var currentPage = 1;
var threadData;

/**
 * 読み込み時の処理
 */
window.onload = function(){
  setThreadData(null);
}

/**
 * スレッドのデータを取得する
 * @param {*} title 
 * @param {*} tag 
 * @param {*} startDateStart 
 * @param {*} startDateEnd 
 * @param {*} endDateStart 
 * @param {*} endDateEnd 
 */
var setThreadData = function(groupName){

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
$.ajax({
    type: 'POST',
    url : '/search_group',
    data: {
      'groupName' : groupName,
    },
  }).fail(function(){

  }).done(function(re){
    currentPage = 1;

    var result = JSON.parse(re);
    threadData = result;

    //ページ数
    var pageCount = Math.floor((result.length + 19) / 20);
    makePager(pageCount);

    //グループ
    var newThreadData = getCurrentThreads();
    setGroups(newThreadData);
  });
}

/**
 * グループをセットする
 * @param {*} threads 
 */
var setGroups = function(threads){
  var table = document.getElementById("group_table");

  var rowCount = table.rows.length - 1;
  var columnCount = table.rows[0].cells.length;
  
  var loopCount = Math.min(rowCount, threads.length);
  for(let i = 1; i <= loopCount; ++i){
    for(let j = 0; j< columnCount; ++j){
      table.rows[i].cells[j].innerHTML = threads[i - 1]['updatedAt'];
      table.rows[i].cells[j].innerHTML = threads[i - 1]['title'];
      table.rows[i].cells[j].innerHTML = threads[i - 1]['wave'];
      table.rows[i].cells[j].innerHTML = threads[i - 1]['groupName'];
      var id = "thread-index-" + (i - 1);
      var link = document.getElementById(id);
      var newLink = "./thread?threadId=" + threads[i - 1]['id'];
      link.href = newLink;
    }
  }

  //行の追加
  if(rowCount < threads.length){
    for(let i = rowCount; i < threads.length; ++i){
      var row = table.insertRow(-1);
      var cell = row.insertCell(0);
      cell.innerHTML = threads[i]['updatedAt'];
      
      var cell = row.insertCell(1);
      var link = document.createElement('a');
      link.textContent = threads[i]['title'];
      var id = "thread-index-" + (i);
      var newLink = "./thread?threadId=" + threads[i]['id'];
      link.href = newLink;
      cell.classList.add("cell-link");
      cell.appendChild(link);

      var cell = row.insertCell(2);
      cell.innerHTML = threads[i]['wave'];
      var cell = row.insertCell(3);
      cell.innerHTML = threads[i]['groupName'];
    }
  }
  //行の削除
  else if(threads.length < rowCount){
    for(let i = rowCount; threads.length < i; --i){
      table.deleteRow(i);
    }
  }

  var obj = document.getElementById('loading-message');
  obj.style.display = "none";
}