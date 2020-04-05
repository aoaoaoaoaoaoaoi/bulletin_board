var sendMessage = function(button) {
  
  var message = document.getElementById("messageText").value;
  var threadId = <?php echo json_encode($data['thread_id']); ?>;

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

    }).done(function(re){
      var result = JSON.parse(re);
    }
}