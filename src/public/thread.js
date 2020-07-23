//定数
var good = 1;
var greatGood = 2;

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

$('.good-button').on('click', function(){
  console.log("aaaa");
  ReverseReaction($(this), good);
});

$('.great-good-button').on('click', function(){
  ReverseReaction($(this), greatGood);
});

var ReverseReaction = function(button, reactionType){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
      type: 'POST',
      url :'/reverse_reaction',
      data:{ 
        threadMessageId : button.val(),
        reactionType : reactionType,
      }
    }).fail(function(){

    }).done(function(re){
      var isReaction = JSON.parse(re);
      var changeClass = (reactionType == good) ? "good-button-color" : "great-good-button-color";
      if(isReaction['isReaction']){
          button.addClass(changeClass);
      }else{
          button.removeClass(changeClass);
      }
    });
}