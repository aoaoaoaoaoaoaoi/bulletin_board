var showSerch = function(button) {

    var obj = document.getElementById('thread-search');
    if(obj.style.display == "block"){
      obj.style.display = "none";
    }else{
      obj.style.display = "block";
    }
}

var search = function(button){

  var title = document.getElementById('title').value;
  var tag = document.getElementById('tag').value;
  var startDateStart = document.getElementById('start-date-start').value;
  var startDateEnd = document.getElementById('start-date-end').value;
  var endDateStart = document.getElementById('end-date-start').value;
  var endDateEnd = document.getElementById('end-date-end').value;

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
    var result = JSON.parse(re);
    var table = document.getElementById("thread_table");

    var rowCount = table.rows.length;
    var columnCount = table.rows[0].cells.length;
    
    var loopCount = Math.min(rowCount - 1, result.rength);
    for(let i = 1; i <= loopCount; ++i){
      for(let j = 0; j< columnCount; ++j){
        table.rows[i].cells[j].innerHTML = result[i - 1]['updatedAt'];
        table.rows[i].cells[j].innerHTML = result[i - 1]['title'];
        table.rows[i].cells[j].innerHTML = result[i - 1]['wave'];
        table.rows[i].cells[j].innerHTML = result[i - 1]['groupName'];
        var id = "thread-index-" + (i - 1);
        var link = document.getElementById(id);
        var newLink = "./thread?threadId=" + result[i - 1]['id'];
        link.href = newLink;
      }
    }
    
    //行の追加
    if(rowCount - 1 < result.length){
      for(let i = rowCount; i < resultCount; ++i){
        var row = table.insertRow(-1);
        var cell = row.insertCell(0);
        cell.innerHTML = result[i]['updatedAt'];
        
        var cell = row.insertCell(1);
        cell.innerHTML = result[i]['title'];
        var link = document.createElement('a');
        var id = "thread-index-" + (i);
        var newLink = "./thread?threadId=" + result[i]['id'];
        link.href = newLink;
        document.cell.appendChild(link);

        var cell = row.insertCell(2);
        cell.innerHTML = result[i]['wave'];
        var cell = row.insertCell(3);
        cell.innerHTML = result[i]['groupName'];
      }
    }else if(result.length < rowCount - 1){
      for(let i = rowCount - 1; result.length < i; --i){
        table.deleteRow(i);
      }
    }
  });
}