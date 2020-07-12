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

/**
 * 検索窓を出し入れする
 * @param {*} button 
 */
var showSerch = function(button, id) {

  var obj = document.getElementById(id);
  if(obj.style.display == "block"){
    obj.style.display = "none";
  }else{
    obj.style.display = "block";
  }
}