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