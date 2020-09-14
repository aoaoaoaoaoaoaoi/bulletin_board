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
 * 読み込み時の処理
 */
window.onload = function(){
  setgroupData(null);
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
var setgroupData = function(groupName, userId){

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
      'userId' : userId,
    },
  }).fail(function(){

  }).done(function(re){
    currentPage = 1;

    var result = JSON.parse(re);
    listData = result;

    //ページ数
    var pageCount = Math.floor((result.length + 19) / 20);
    makePager(pageCount, 'pager_table');

    //グループ
    var newgroupData = getCurrentList();
    setGroups(newgroupData);
  });
}

/**
 * グループをセットする
 * @param {*} threads 
 */
var setGroups = function(groups){
  var table = document.getElementById("group_table");

  var rowCount = table.rows.length - 1;
  var columnCount = table.rows[0].cells.length;
  
  var loopCount = Math.min(rowCount, groups.length);
  for(let i = 1; i <= loopCount; ++i){
    for(let j = 0; j < columnCount; ++j){
      table.rows[i].cells[j].innerHTML = groups[i - 1]['name'];
      table.rows[i].cells[j].innerHTML = groups[i - 1]['joinCount'];
      table.rows[i].cells[j].innerHTML = groups[i - 1]['description'];
      table.rows[i].cells[j].innerHTML = groups[i - 1]['isJoin'];
      var id = "group-index-" + (i - 1);
      var link = document.getElementById(id);
      var newLink = "./group?groupId=" + groups[i - 1]['id'];
      link.href = newLink;
    }
  }

  //行の追加
  if(rowCount < groups.length){
    for(let i = rowCount; i < groups.length; ++i){
      var row = table.insertRow(-1);
      var cell = row.insertCell(0);
      var image = document.createElement('img');
      image.src = groups[i]['resource'];
      var id = "group-image-" + (i);
      
      image.setAttribute("id", "icon-image");
      cell.appendChild(image);
      
      var cell = row.insertCell(1);
      var link = document.createElement('a');
      link.textContent = groups[i]['name'];
      var id = "group-index-" + (i);
      var newLink = "./group?groupId=" + groups[i]['id'];
      link.href = newLink;
      cell.classList.add("cell-link");
      cell.appendChild(link);

      var cell = row.insertCell(2);
      cell.innerHTML = groups[i]['joinCount'];
      var cell = row.insertCell(3);
      cell.innerHTML = groups[i]['description'];
      
      var cell = row.insertCell(4);
      var button = document.createElement('button');
      button.type = 'button';
      button.value = groups[i]['id'];
      button.classList.add("btn");
      button.classList.add("btn-primary");
      button.classList.add("small-btn");
      if(groups[i]['isJoin']){
        button.innerHTML = "参加中";
      }else{
        button.classList.add("see-through-btn");
        button.innerHTML = "参加";
      }
      cell.appendChild(button);
    }
  }
  //行の削除
  else if(groups.length < rowCount){
    for(let i = rowCount; groups.length < i; --i){
      table.deleteRow(i);
    }
  }

  var obj = document.getElementById('loading-message');
  obj.style.display = "none";
}

$('#group_table').on('click', 'button', function(){
  ReverseParticipation($(this));
});

/**
 * グループへの参加を逆にする
 * @param {*} groupId 
 */
var ReverseParticipation = function(button){
  var groupId = button.val();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
$.ajax({
    type: 'POST',
    url : '/reverse_group_participation',
    data: {
      'groupId' : groupId,
    },
  }).fail(function(){

  }).done(function(re){
    var isJoin = JSON.parse(re);
    if(isJoin['isJoin']){
      button.innerHTML = "参加中";
      button.removeClass("see-through-btn");
    }else{
      button.innerHTML = "参加";
      button.addClass("see-through-btn");
    }
  });
}