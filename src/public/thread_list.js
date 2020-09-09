//グローバル変数
var currentPage = 1;
var listData;

  /**
 * 表示するリストを取り出す
 */
var getCurrentList = function(){
  var startIndex = (currentPage - 1) * 20;
  var newListData = [];
  for(let i = startIndex; i < startIndex + 20; ++i){
    if(listData.length <= i){
      break;
    }
    newListData.push(listData[i]);
  }
  return newListData;
}

/**
 * リンクをセットする
 * @param {*} link 
 * @param {*} title 
 * @param {*} threadId 
 */
var setLinkData = function(link, title, threadId){
  link.textContent = title;
  var newLink = "./thread?threadId=" + threadId;
  link.href = newLink;
  return link;
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
var setThreadData = function(groupId, title, tag, startDateStart, startDateEnd, endDateStart, endDateEnd, isOnlyOwner, involvedUserId){

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
$.ajax({
    type: 'POST',
    url : '/search_thread',
    data: {
      'groupId' : groupId,
      'title' : title,
      'tag' : tag,
      'startDateStart' : startDateStart,
      'startDateEnd' : startDateEnd,
      'endDateStart' : endDateStart,
      'endDateEnd' : endDateEnd,
      'isOnlyOwner' : isOnlyOwner,
      'involvedUserId' : involvedUserId,
    },
  }).fail(function(){

  }).done(function(re){
    currentPage = 1;

    var result = JSON.parse(re);
    listData = result;

    //ページ数
    var pageCount = Math.floor((result.length + 19) / 20);
    makePager(pageCount, 'pager_table');

    //スレッド
    var newThreadData = getCurrentList();
    setThreads(newThreadData);
  });
}

/**
 * ページを切り替える
 * @param {*} button 
 */
var goNextPage = function(link){
  var nextPage = link.textContent;
  if(currentPage == nextPage){
    return;
  }
  var newThreadData = getCurrentList();
  //データを入れる
  setThreads(newThreadData);
  currentPage = nextPage;
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
      table.rows[i].cells[0].innerHTML = threads[i - 1]['updatedAt'];
      table.rows[i].cells[2].innerHTML = threads[i - 1]['wave'];
      table.rows[i].cells[3].innerHTML = threads[i - 1]['groupName'];

      var link = table.rows[i].cells[1].children[0];
      setLinkData(link, threads[i-1]['title'], threads[i - 1]['id']);
      table.rows[i].cells[1].appendChild(link);
  }

  //行の追加
  if(rowCount < threads.length){
    for(let i = rowCount; i < threads.length; ++i){
      var row = table.insertRow(-1);
      var cell = row.insertCell(0);
      cell.innerHTML = threads[i]['updatedAt'];
      
      var cell = row.insertCell(1);
      var link = document.createElement('a');
      setLinkData(link, threads[i]['title'], threads[i]['id']);
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