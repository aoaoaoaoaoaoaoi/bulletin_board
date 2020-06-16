//グローバル変数
var currentPage = 1;
var threadData;

/**
 * 検索窓を出し入れする
 * @param {*} button 
 */
var showSerch = function(button) {

    var obj = document.getElementById('thread-search');
    if(obj.style.display == "block"){
      obj.style.display = "none";
    }else{
      obj.style.display = "block";
    }
}

/**
 * 読み込み時の処理
 */
window.onload = function(){
  setThreadData(null, null, null, null, null, null);
}

/**
 * スレッドを検索する
 * @param {*} button 
 */
var search = function(button){

  var title = document.getElementById('title').value;
  var tag = document.getElementById('tag').value;
  var startDateStart = document.getElementById('start-date-start').value;
  var startDateEnd = document.getElementById('start-date-end').value;
  var endDateStart = document.getElementById('end-date-start').value;
  var endDateEnd = document.getElementById('end-date-end').value;

  setThreadData(title, tag, startDateStart, startDateEnd, endDateStart, endDateEnd);
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
var setThreadData = function(title, tag, startDateStart, startDateEnd, endDateStart, endDateEnd){

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
$.ajax({
    type: 'POST',
    url : '/search_thread',
    data: {
      'title' : title,
      'tag' : tag,
      'startDateStart' : startDateStart,
      'startDateEnd' : startDateEnd,
      'endDateStart' : endDateStart,
      'endDateEnd' : endDateEnd,
    },
  }).fail(function(){

  }).done(function(re){
    currentPage = 1;

    var result = JSON.parse(re);
    threadData = result;

    //ページ数
    var pageCount = Math.floor((result.length + 19) / 20);
    makePager(pageCount);

    //スレッド
    var newThreadData = getCurrentThreads();
    setThreads(newThreadData);
  });
}

/**
 * ページャーを作成する
 * @param {*} pageCount 
 */
var makePager = function(pageCount){
  var table = document.getElementById("pager_table");

  var rowCount = table.rows.length
  if(rowCount < 1){
    table.insertRow(-1);
  }
  var columnCount = table.rows[0].cells.length;
  if(columnCount < pageCount){
    for(let i = columnCount; i < pageCount; ++i){
      var cell = table.rows[0].insertCell(i);
      cell.innerHTML = i + 1;

      var button = document.createElement('button');
      button.type = 'button';
      button.classList.add("no-decoration-button");
      button.setAttribute("onClick","goNextPage");
    }
  }else if(pageCount < columnCount){
    for(let i = columnCount - 1; pageCount <= i; --i){
      var cell = table.rows[0].deleteCell(i);
    }
  }
}

/**
 * ページを切り替える
 * @param {*} button 
 */
var goNextPage = function(button){
  var nextPage = button.innerHTML;
  if(currentPage == nextPage){
    return;
  }
  var newThreadData = getCurrentThreads();
  //データを入れる
  setThreads(newThreadData);
  currentPage = nextPage;
}

/**
 * 表示するスレッドを取り出す
 */
var getCurrentThreads = function(){
  var startIndex = (currentPage - 1) * 20;
  var newThreadData = [];
  for(let i = startIndex; i < startIndex + 20; ++i){
    if(threadData.length <= i){
      break;
    }
    newThreadData.push(threadData[i]);
  }
  return newThreadData;
}

/**
 * スレッドをセットする
 * @param {*} threads 
 */
var setThreads = function(threads){
  var table = document.getElementById("thread_table");

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