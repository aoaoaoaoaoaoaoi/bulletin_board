/*document.getElementById("group-detail-button").onclick = function() {

    document.getElementById("group-detail-name").innerHTML = "aaaaaa ";// + document.getElementById("name").value + " さん！";
}*/

var showInfo = function(button) {
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $.ajax({
    type: 'POST',
    url :'/show_group_info',
    data:{ 
      key:button.value,
    }
  }).fail(function(){
    //alert('error');
  }).done(function(re){
    //alert('success');
    var result = JSON.parse(re);
    document.getElementById("group-detail-name").innerHTML = result['name'];
    document.getElementById("group-detail-description").innerHTML = result['description'];
  });
}