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

    //入力欄のvalue
    var userTags = document.getElementById("user-tag").value.split(' ');
    //背景用の要素
    var userTagBackParent = document.getElementById("user-tag-backs");
    var userTagBacks = userTagBackParent.children;
  
    //valueの変更
    var index = 0;
   for( ; index < userTags.length; index++){
     var tag = userTags[index];
     if(index < userTagBacks.length){
        userTagBacks[index].innerHTML = tag;
     }else{
        var newSpan = document.createElement('span');
        newSpan.className = 'user_tag_back';
        newSpan.innerHTML = tag;

        var userTagBackArea = document.getElementById('user-tag-backs');
        userTagBackArea.innerHTML += ' ';
        userTagBackArea.appendChild(newSpan);
     }
   }
  
   //余分なタグの削除
   for(var i = index; i < userTagBacks.length; ++i){
      var deleteTag = userTagBacks[i];
      userTagBackParent.removeChild(delteTag);
   }
}

var editProfile = function(button) {

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var name = document.getElementById("username").innerHTML;
  var bio = document.getElementById("bio").innerHTML;
  var tag = document.getElementById("user-tag").innerHTML;

$.ajax({
    type: 'POST',
    url :'/edit_profile_do',
    data:{ 
      username : name,
      bio : bio,
      usertag : tag,
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
      membersList += name + ' , ';
    });
    document.getElementById('group-detail-members').innerHTML = membersList;
  });
}