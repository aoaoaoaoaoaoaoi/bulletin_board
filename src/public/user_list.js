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
var setLinkData = function(link, title/*, threadId*/){
  link.textContent = title;
  //var newLink = "./thread?threadId=" + threadId;
  //link.href = newLink;
  return link;
}


var setUserData = function(groupId){

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
$.ajax({
    type: 'POST',
    url : '/search_user',
    data: {
      'groupId' : groupId,
    },
  }).fail(function(){

  }).done(function(re){
    currentPage = 1;

    var result = JSON.parse(re);
    listData = result;

    //ページ数
    var pageCount = Math.floor((result.length + 19) / 20);
    makePager(pageCount, 'pager_table_user');

    //スレッド
    var newUserData = getCurrentList();
    setUsers(newUserData);
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
  var newUserData = getCurrentList();
  //データを入れる
  setUsers(newUserData);
  currentPage = nextPage;
}

/**
 * スレッドをセットする
 * @param {*} threads 
 */
var setUsers = function(users){
  var table = document.getElementById("user_table");

  var rowCount = table.rows.length - 1;
  var columnCount = table.rows[0].cells.length;
  
  var loopCount = Math.min(rowCount, users.length);
  for(let i = 1; i <= loopCount; ++i){
      table.rows[i].cells[0].children('img').src = users[i - 1]['resource'];
      table.rows[i].cells[2].innerHTML = users[i - 1]['name'];
      table.rows[i].cells[3].innerHTML = users[i - 1]['profile'];

      var link = table.rows[i].cells[1].children[0];
      setLinkData(link, users[i-1]['name'], users[i - 1]['id']);
      table.rows[i].cells[1].appendChild(link);
  }

  //行の追加
  if(rowCount < users.length){
    for(let i = rowCount; i < users.length; ++i){
      var row = table.insertRow(-1);
      var cell = row.insertCell(0);
      var image = document.createElement('img');
      image.src = users[i]['resource'];
      image.setAttribute("id", "icon-image");
      cell.appendChild(image);
      
      var cell = row.insertCell(1);
      var link = document.createElement('a');
      setLinkData(link, users[i]['name']/*, users[i]['id']*/);
      cell.classList.add("cell-link");
      cell.appendChild(link);

      var cell = row.insertCell(2);
      cell.innerHTML = users[i]['profile'];
      var cell = row.insertCell(3);
      cell.innerHTML = users[i]['lastLoginAt'];
    }
  }
  //行の削除
  else if(users.length < rowCount){
    for(let i = rowCount; users.length < i; --i){
      table.deleteRow(i);
    }
  }

  var obj = document.getElementById('loading-message-user');
  obj.style.display = "none";
}