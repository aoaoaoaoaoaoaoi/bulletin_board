$('#icon-file').change(function(){
  if (this.files.length > 0) {
    // 選択されたファイル情報を取得
    var file = this.files[0];
    
    // readerのresultプロパティに、データURLとしてエンコードされたファイルデータを格納
    var reader = new FileReader();
    reader.readAsDataURL(file);
    
    reader.onload = function() {
      $('#icon-image').attr('src', reader.result );
    }
  }
});

var makeTag = function(button) {

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$.ajax({
    type: 'POST',
    url :'/make_tag',
    data:{ 
      key:button.value,
    }
  }).fail(function(){

  }).done(function(re){
 
  });
}