var sendMessage = function(button) {
  var param = location.search;
  var threadId = param.replace("?threadId=", "");
  console.log(threadId);
  var message = document.getElementById("messageText").value;
  if(message == ""){
    return;
  }
  
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
      type: 'POST',
      url :'/send_message',
      data:{ 
        threadId:threadId,
        message:message,
      }
    }).fail(function(){

    }).done(function(){
        location.reload();
    });
}