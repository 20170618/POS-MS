// Edit
$(document).on('click', '.archive_user', function (e) {
    e.preventDefault();
    var u_id = $(this).val();
    $('#archiveModal').modal('show');
    $.ajax({
      type: "GET",
      url: "userManagement/archive-user/"+u_id,
      success: function (response) {
        if(response.status == 404) {
          $('#pizza_message').html("");
          $('#pizza_message').addClass('alert alert-danger');
          $('#pizza_message').text(response.message);
        }else {
          $('#archive_UserName').val(response.user.UserName);
          $('#archive_FirstName').val(response.user.FirstName);
          $('#archive_LastName').val(response.user.LastName);
          $('#archive_u_id').val(u_id);
        }
      }
    });
  });
  
  // Update
  $(document).on('click', '.archive_user_btn', function (e) {
    e.preventDefault();
    var u_id = $('#archive_u_id').val();
    var data = {
      'UserType' : $('#archive_UserType').val(),
    }
    console.log(u_id);
    console.log(data);
    
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  
    $.ajax({
      type: "PUT",
      url: "userManagement/archive-user/"+u_id,
      data: data,
      dataType: "json",
      success: function (response) {
        if(response.status == 400){
            $('#updateform_errList').html("");
            $('#updateform_errList').addClass('alert alert-danger');
            $.each(response.errors, function(key, err_values){
              $('updateform_errList').append('<li>'+err_values+'</li>');
            });
  
        }else if(response.status == 404){
            $('#updateform_errList').html("");
            $('#pizza_message').addClass('alert alert-info');
            $('#pizza_message').text(response.message);
  
        }else{
            $('#updateform_errList').html("");
            $('#pizza_message').html("");
            $('#pizza_message').addClass('alert alert-info');
            $('#pizza_message').text(response.message);
  
            $('#archiveModal').modal('hide');
            
            window.location = window.location;
        }
      }
    });
  });