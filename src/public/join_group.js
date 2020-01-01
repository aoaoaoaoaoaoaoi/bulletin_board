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

  }).done(function(re){
    var result = JSON.parse(re);
    document.getElementById("group-detail-name").innerHTML = result['name'];
    document.getElementById("group-detail-description").innerHTML = result['description'];
    $("#group-detail-members").empty();
    var members = document.getElementById('group-detail-members');
    var membersList='';
    result['members'].forEach(member => {
      var name = member.name;
      membersList += '<tr><td class="member-name">'+ name + '</tr>';
    });
    document.getElementById('group-detail-members').innerHTML = membersList;
  });
}