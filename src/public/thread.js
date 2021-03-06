//定数
var good = 1;
var greatGood = 2;

function send_message() {
  var formdata = new FormData($('#thread_form').get(0));
  var param = location.search;
  var threadId = param.replace("?threadId=", "");
  formdata.append('threadId', threadId);
  if(formdata['sendMessage'] == "" && fileCount <= 0){
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
      data: formdata,
      processData: false,
      contentType : false,
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

let fileCount = 0;
const fileMaxCount = 3;

$('#message-file').change(function(){

  if(fileMaxCount < fileCount + this.files.length){
   alert("添付は3つまでです"); 
   return;
  }

  for(let i = 0; i < this.files.length; ++i){
    // 選択されたファイル情報を取得
    let file = this.files[i];
    
    let reader = new FileReader();    
    reader.onload = function() {
      let image = $('<img>').attr('src', reader.result).addClass("message-image");
      $('#message-images').append(image);
    }
    reader.readAsDataURL(file);

    fileCount++;
  }
});