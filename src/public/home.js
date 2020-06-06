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
  var tags = document.getElementById('tag').value;
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
    processData: false,
    data: {
      title : title,
      tag : tags,
      startDateStart : startDateStart,
      startDateEnd : startDateEnd,
      endDateStart : endDateStart,
      endDateEnd : endDateEnd,
    },
    contentType : false,
  }).fail(function(){

  }).done(function(re){
    alert('complete!! yeah!')
  });
}