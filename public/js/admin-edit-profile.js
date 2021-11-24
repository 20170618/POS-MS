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
save.addEventListener('click', function(e){
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
      url: "profile/update-user/"+u_id,
      data: data,
      dataType: "json",
      success: function (response) {
        if(response.status == 400){
          console.log(u_id);
        }else if(response.status == 404){
          console.log(u_id);

        }else{            
            window.location = window.location;
            
        }
      }
    });
});



$('.changepassmodal').click(function (e) { 
  e.preventDefault();
  $('#changePassword').modal('show');
});