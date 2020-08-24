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
      let original = document.getElementById("pager-table-th-clone");
      for(let i = columnCount; i < pageCount; ++i){
        var cell = table.rows[0].insertCell(i);
  
        let clone = original.cloneNode(true);
        clone.textContent = i + 1;
        //let pager = $('<a>').attr('href', "#").css('style', 'block').text("i + 1").addClass("pager_table_th");
        cell.appendChild(clone);
        clone.style.display = "block";
      }
    }else if(pageCount < columnCount){
      for(let i = columnCount - 1; pageCount <= i; --i){
        var cell = table.rows[0].deleteCell(i);
      }
    }
  }

  /**
   * pagerのボタンを押した際の動作
   */
  $('#pager_table').on('click', 'button', function(){
    goNextPage($(this));
  });
