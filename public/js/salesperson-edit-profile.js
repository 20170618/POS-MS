$(document).ready(function () {
  var fname = $('#FirstName').val();
  var lname = $('#LastName').val();
  var cnum = $('#ContactNo').val();
  var ecnum = $('#EmContactNo').val();
  console.log('fname'+ecnum)



  var cancel = document.getElementById('cancel');
  cancel.addEventListener('click', function(){
      document.getElementById('FirstName').disabled = true;
      document.getElementById('LastName').disabled = true;
  
      document.getElementById('ContactNo').disabled = true;
      document.getElementById('EmContactNo').disabled = true;
  
      document.getElementById('save').hidden = true;
      document.getElementById('cancel').hidden = true;
  
      document.getElementById('edit').hidden = false;
      document.getElementById('changepasswordbutton').hidden = false;
      
      $('#FirstName').val(fname);
      $('#LastName').val(lname);
      $('#ContactNo').val(cnum);
      $('#EmContactNo').val(ecnum);
  });


});

var edit = document.getElementById('edit');
edit.addEventListener('click', function(){
    document.getElementById('FirstName').disabled = false;
    document.getElementById('LastName').disabled = false;

    document.getElementById('ContactNo').disabled = false;
    document.getElementById('EmContactNo').disabled = false;

    document.getElementById('save').hidden = false;
    document.getElementById('cancel').hidden = false;

    document.getElementById('edit').hidden = true;
    document.getElementById('changepasswordbutton').hidden = true;
});

var save = document.getElementById('save');
save.addEventListener('click', function (e) {
  if ($('#FirstName').val() == "" || $('#LastName').val() == "" || $('#ContactNo').val() == "" || $('#EmContactNo').val() == "") {
      $('#message').html("");
      $('#message').addClass('alert alert-danger');
      $('#message').text("Please fill in all fields!");
  } else {
    document.getElementById('FirstName').disabled = true;
    document.getElementById('LastName').disabled = true;

    document.getElementById('ContactNo').disabled = true;
    document.getElementById('EmContactNo').disabled = true;

    document.getElementById('save').hidden = true;
    document.getElementById('cancel').hidden = true;

    document.getElementById('edit').hidden = false;
    document.getElementById('changepasswordbutton').hidden = false;
    e.preventDefault();
    var u_id = $('#UserID').val();
    var data = {
      'FirstName' : $('#FirstName').val(),
      'LastName' : $('#LastName').val(),
      'ContactNo' : $('#ContactNo').val(),
      'EmContactNo' : $('#EmContactNo').val()
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
      url: "update-user/"+u_id,
      data: data,
      dataType: "json",
      success: function (response) {
        if(response.status == 400){
          console.log(u_id);
          document.getElementById('FirstName').disabled = false;
          document.getElementById('LastName').disabled = false;

          document.getElementById('ContactNo').disabled = false;
          document.getElementById('EmContactNo').disabled = false;

          document.getElementById('save').hidden = false;
          document.getElementById('cancel').hidden = false;

          document.getElementById('edit').hidden = true;
          document.getElementById('changepasswordbutton').hidden = true;
          Swal.fire(
            'Error!',
            'First name and last name must only contain alphabetical character!',
            'error')
        }else if(response.status == 404){
          console.log(u_id);
        } else {
          Swal.fire(
            'Success!',
            'Profile successfully updated!',
            'success'
          ).then(() => {
            window.location = window.location;
          });  
        }
      }
    });
  }
});



$('.changepassmodal').click(function (e) { 
  e.preventDefault();
  $('#changePassword').modal('show');
});

$("#changePassword").on('hide.bs.modal', function(){
  $('#errorNotif').html("");
  $('#errorNotif').removeClass();
  $('#oldPassword').val("");
  $('#newPassword').val("");
  $('#confirmPassword').val("");
});


$(document).on('click', '.confirmOldPasswordBtn', function (e) {
  $('#errorNotif').html("");
  $('#errorNotif').removeClass();
  
  var lef = $('#newPassword').val();
  var passLength =lef.length;
  if ($('#oldPassword').val() == "" || $('#newPassword').val() == "" || $('#confirmPassword').val() == "") {
      $('#errorNotif').html("");
      $('#errorNotif').addClass('alert alert-danger');
      $('#errorNotif').text("Please fill in all fields!");
  } else if ($('#newPassword').val() != $('#confirmPassword').val()) {
      $('#errorNotif').html("");
      $('#errorNotif').addClass('alert alert-danger');
      $('#errorNotif').text("New Password and Confirm Password don't match!");
  }else if(passLength < 6 || passLength > 18){
      $('#errorNotif').html("");
      $('#errorNotif').addClass('alert alert-danger');
      $('#errorNotif').text("Password should be longer than 6 characters and less than 18 characters!");
  } else {
    var data = {
      'oldPassword': $('#oldPassword').val(),
      'password': $('#newPassword').val(),
    };
    console.log($('#UserID').val());
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $id = $('#UserID').val();
    $.ajax({
        type: "GET",
        url: "oldPasswordCheck/"+$id,
        data: data,
        success: function(response) {
            if (response.status == 200) {
              $('#changePassword').modal('hide');
              Swal.fire(
                  "Success!",
                  "Password has been successfully updated!",
                  "success"
              ).then(() => {
                window.location = window.location;
              });  
            } else if (response.status == 212121) {
                $('#errorNotif').html("");
                $('#errorNotif').addClass('alert alert-danger');
                $('#errorNotif').text("Error! Old password incorrect!");
            } else if (response.status == 2002021) {
                $('#errorNotif').html("");
                $('#errorNotif').addClass('alert alert-danger');
                $('#errorNotif').text("Password format incorrect! Please make sure to use a combination of numbers, symbols and lowercase or uppercase characters!");
            }
        }
    });
  }
});