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

//ユーザータグの切り替え
const userTag = document.querySelector('#user-tag');
userTag.addEventListener('input', updateValue);
function updateValue(e) {

console.log("UPDDATTE");

    //入力欄のvalue
    var userTags = document.getElementById("user-tag").value.split(' ');
    //背景用の要素
    var userTagBackParent = document.getElementById("user-tag-backs");
    var userTagBacks = userTagBackParent.children;
  
    //valueの変更
    var index = 1;
    console.log("userTags");
    console.log(userTags.length);
    console.log("userTagBacks");
    console.log(userTagBacks.length);
   for( ; index < userTags.length; index++){
     var tag = userTags[index];
     console.log("targetTagName");
     console.log(tag);
     if(index <= userTagBacks.length){
        userTagBacks[index-1].innerHTML = tag;
     }else{
        var newSpan = document.createElement('span');
        newSpan.className = 'user_tag_back';
        newSpan.innerHTML = tag;
        document.getElementById('user-tag-backs').appendChild(newSpan);
     }
   }
  
   //余分なタグの削除
   for(var i = index-1; i < userTagBacks.length; ++i){
      var deleteTag = userTagBacks[i];
      userTagBackParent.removeChild(delteTag);
   }
}