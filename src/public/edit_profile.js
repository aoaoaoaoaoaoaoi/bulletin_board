function update_user_data(){
  var formdata = new FormData($('#edit_user_data_form').get(0));
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
$.ajax({
    type: 'POST',
    url : '/edit_profile_complete',
    processData: false,
    data: formdata,
    contentType : false,
  }).fail(function(){

  }).done(function(re){
    alert('complete!! yeah!')
  });
}